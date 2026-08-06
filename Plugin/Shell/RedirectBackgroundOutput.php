<?php

namespace Graycore\StdLogging\Plugin\Shell;

use Magento\Framework\Shell\CommandRendererBackground;

/**
 * Magento detaches background commands (cron workers, queue consumers) with
 * "2>/dev/null >/dev/null &", discarding their output — including uncatchable
 * PHP fatals that never reach Monolog. This plugin redirects that output to
 * PID 1's stdout so the container runtime collects it. It must not redirect to
 * the parent's own stdout: Shell::execute() uses exec(), which would block
 * until the detached child exited.
 */
class RedirectBackgroundOutput
{
    public const DISCARD_OUTPUT = '2>/dev/null >/dev/null &';

    public const CONTAINER_STDOUT = '/proc/1/fd/1';

    /**
     * @var string
     */
    private $containerStdout;

    /**
     * @param string $containerStdout
     */
    public function __construct($containerStdout = self::CONTAINER_STDOUT)
    {
        $this->containerStdout = $containerStdout;
    }

    /**
     * @param CommandRendererBackground $subject
     * @param string $result
     * @return string
     */
    public function afterRender(CommandRendererBackground $subject, $result)
    {
        if (!is_string($result) || strpos($result, self::DISCARD_OUTPUT) === false) {
            return $result;
        }

        if (!$this->isCollectable()) {
            return $result;
        }

        // Append (>>) in case the target is a regular file rather than a pipe.
        return str_replace(
            self::DISCARD_OUTPUT,
            '>>' . $this->containerStdout . ' 2>&1 &',
            $result
        );
    }

    /**
     * False on hosts without /proc or when PID 1's descriptors are unreachable;
     * core behaviour is preserved in those cases.
     *
     * @return bool
     */
    private function isCollectable()
    {
        // PHP's stat cache may return a stale result here, but writability of
        // PID 1's stdout effectively never changes within a process lifetime.
        // phpcs:ignore Magento2.Functions.DiscouragedFunction
        return is_writable($this->containerStdout);
    }
}
