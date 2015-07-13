<?php
/*
 * This file is part of the WNowicki\Generic package.
 *
 * (c) WNowicki <dev@wnowicki.com>
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace WNowicki\Generic\Logger;


use Psr\Log\LoggerInterface;
use Psr\Log\LogLevel;

/**
 * Psr Logger Trait
 *
 * @author WN
 * @package WNowicki\Generic\Logger
 */
trait PsrLoggerTrait
{
    /**
     * @return \Psr\Log\LoggerInterface|null
     */
    abstract protected function getLogger();

    /**
     * @author WN
     * @param string $message
     * @param array $context
     * @return null
     */
    public function logEmergency($message, array $context = [])
    {
        return $this->log(LogLevel::EMERGENCY, $message, $context);
    }

    /**
     * @author WN
     * @param string $message
     * @param array $context
     * @return null
     */
    public function logAlert($message, array $context = array())
    {
        return $this->log(LogLevel::ALERT, $message, $context);
    }

    /**
     * @author WN
     * @param string $message
     * @param array $context
     * @return null
     */
    public function critical($message, array $context = array())
    {
        return $this->log(LogLevel::CRITICAL, $message, $context);
    }

    /**
     * @author WN
     * @param string $message
     * @param array $context
     * @return null
     */
    public function error($message, array $context = array())
    {
        return $this->log(LogLevel::ERROR, $message, $context);
    }

    /**
     * @author WN
     * @param string $message
     * @param array $context
     * @return null
     */
    public function warning($message, array $context = array())
    {
        return $this->log(LogLevel::WARNING, $message, $context);
    }

    /**
     * @author WN
     * @param string $message
     * @param array $context
     * @return null
     */
    public function notice($message, array $context = array())
    {
        return $this->log(LogLevel::NOTICE, $message, $context);
    }

    /**
     * @author WN
     * @param string $message
     * @param array $context
     * @return null
     */
    public function info($message, array $context = array())
    {
        return $this->log(LogLevel::INFO, $message, $context);
    }

    /**
     * @author WN
     * @param string $message
     * @param array $context
     * @return null
     */
    public function debug($message, array $context = array())
    {
        return $this->log(LogLevel::DEBUG, $message, $context);
    }

    /**
     * @author WN
     * @param string $level
     * @param string $message
     * @param array $context
     * @return null
     */
    private function log($level, $message, $context)
    {
        if ($this->getLogger() instanceof LoggerInterface) {

            $this->getLogger()->log($level, $message, $context);
        }

        return null;
    }
}
