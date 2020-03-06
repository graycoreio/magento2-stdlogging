<?php

namespace Graycore\StdLogging\Handler;

use Monolog\Formatter\LineFormatter;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

use Magento\Framework\App\State;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Config\Setup\ConfigOptionsList;
use Magento\Framework\App\DeploymentConfig;


class Stdout extends StreamHandler {

    /**
     * @var State
     */
    private $state;
    /**
     * @var DeploymentConfig
     */
    private $deploymentConfig;
    
    /**
     * Log stack bubbling
     * See: https://github.com/Seldaek/monolog
     * 
     * We disable bubbling as this logger should be the only logger.
     */
    protected $bubble = false;

    /**
     * @var int
     */
    protected $loggerType = Logger::INFO;

    /**
     * @param State $state
     * @param ScopeConfigInterface $scopeConfig
     * @param DeploymentConfig $deploymentConfig
     * @throws \Exception
     */
    public function __construct(
        State $state,
        DeploymentConfig $deploymentConfig
    ) {
        $this->state = $state;
        $this->deploymentConfig = $deploymentConfig;

        if($this->isDebugLoggingEnabled()){
            $this->loggerType = Logger::DEBUG;
        }

        parent::__construct("php://stdout", $this->loggerType);
        $this->setFormatter(new LineFormatter(null, null, true));
    }

    /**
     * Check that logging functionality is enabled.
     *
     * @return bool
     */
    private function isDebugLoggingEnabled(): bool
    {
        $configValue = $this->deploymentConfig->get(ConfigOptionsList::CONFIG_PATH_DEBUG_LOGGING);
        if ($configValue === null) {
            $isEnabled = $this->state->getMode() !== State::MODE_PRODUCTION;
        } else {
            $isEnabled = (bool)$configValue;
        }
        return $isEnabled;
    }
}