<?php

namespace Graycore\StdLogging\Handler;

use Monolog\Formatter\LineFormatter;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

use Magento\Framework\App\State;
use Magento\Config\Setup\ConfigOptionsList;
use Magento\Framework\App\DeploymentConfig;


class Stdout extends StreamHandler {

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
     * @param DeploymentConfig $deploymentConfig
     * @throws \Exception
     */
    public function __construct(DeploymentConfig $deploymentConfig) {
        $this->deploymentConfig = $deploymentConfig;

        if($this->deploymentConfig->isAvailable() && $this->isDebugLoggingEnabled()){
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
            $isEnabled = $this->deploymentConfig->get(State::PARAM_MODE) !== State::MODE_PRODUCTION;
        } else {
            $isEnabled = (bool)$configValue;
        }
        return $isEnabled;
    }
}