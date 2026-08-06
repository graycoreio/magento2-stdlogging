<?php

namespace Graycore\StdLogging\Test\Unit\Plugin\Shell;

use Graycore\StdLogging\Plugin\Shell\RedirectBackgroundOutput;
use Magento\Framework\Shell\CommandRendererBackground;
use PHPUnit\Framework\TestCase;

class RedirectBackgroundOutputTest extends TestCase
{
    public const DETACHED_COMMAND = "php /app/bin/magento queue:consumers:start 'a.consumer' "
        . "'--single-thread' '--max-messages=100' 2>/dev/null >/dev/null &";

    /**
     * @var CommandRendererBackground
     */
    private $subject;

    /**
     * @var string
     */
    private $collectableStream;

    protected function setUp(): void
    {
        $this->subject = $this->createMock(CommandRendererBackground::class);
        $this->collectableStream = tempnam(sys_get_temp_dir(), 'stdlogging-fd1-');
    }

    protected function tearDown(): void
    {
        if ($this->collectableStream && file_exists($this->collectableStream)) {
            unlink($this->collectableStream);
        }
    }

    public function testItRedirectsDetachedOutputToTheContainerLogStream()
    {
        $plugin = new RedirectBackgroundOutput($this->collectableStream);

        $result = $plugin->afterRender($this->subject, self::DETACHED_COMMAND);

        $this->assertStringNotContainsString('/dev/null', $result);
        $this->assertStringContainsString($this->collectableStream, $result);
    }

    public function testItAppendsRatherThanTruncatingTheTarget()
    {
        $plugin = new RedirectBackgroundOutput($this->collectableStream);

        $result = $plugin->afterRender($this->subject, self::DETACHED_COMMAND);

        $this->assertStringContainsString('>>' . $this->collectableStream, $result);
    }

    public function testItSendsStderrToTheSameStream()
    {
        $plugin = new RedirectBackgroundOutput($this->collectableStream);

        $result = $plugin->afterRender($this->subject, self::DETACHED_COMMAND);

        $this->assertStringContainsString('2>&1', $result);
    }

    public function testItKeepsTheCommandDetached()
    {
        $plugin = new RedirectBackgroundOutput($this->collectableStream);

        $result = $plugin->afterRender($this->subject, self::DETACHED_COMMAND);

        $this->assertStringEndsWith('&', $result);
    }

    public function testItLeavesTheCommandItselfIntact()
    {
        $plugin = new RedirectBackgroundOutput($this->collectableStream);

        $result = $plugin->afterRender($this->subject, self::DETACHED_COMMAND);

        $this->assertStringStartsWith(
            "php /app/bin/magento queue:consumers:start 'a.consumer' "
            . "'--single-thread' '--max-messages=100' ",
            $result
        );
    }

    public function testItPreservesCoreBehaviourWhenTheStreamIsUnreachable()
    {
        $plugin = new RedirectBackgroundOutput('/proc/1/fd/does-not-exist');

        $result = $plugin->afterRender($this->subject, self::DETACHED_COMMAND);

        $this->assertSame(self::DETACHED_COMMAND, $result);
    }

    public function testItIgnoresCommandsThatDoNotDiscardTheirOutput()
    {
        $plugin = new RedirectBackgroundOutput($this->collectableStream);
        $windowsCommand = 'start /B "magento background task" php bin/magento cron:run 2>&1';

        $result = $plugin->afterRender($this->subject, $windowsCommand);

        $this->assertSame($windowsCommand, $result);
    }

    public function testItPassesThroughANonStringResult()
    {
        $plugin = new RedirectBackgroundOutput($this->collectableStream);

        $this->assertNull($plugin->afterRender($this->subject, null));
    }
}
