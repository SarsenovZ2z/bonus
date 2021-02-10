<?php

namespace App\Services\Sms;

use App\Services\Sms\Contracts\SmsDriver;

class SmsService
{

    protected $driver;

    protected $config;

    public function __construct(array $config)
    {
        $this->config = $config;
    }

    /**
     * @return SmsDriver
     */
    public function driver(string $driver) : SmsDriver
    {
        return $this->getDriverInstance($driver);
    }

    /**
     * @return SmsDriver
     */
    public function getDriver() : SmsDriver
    {
        if (!$this->driver) {
            $this->setDefaultDriver();
        }

        return $this->driver;
    }

    /**
     * @return SmsDriver
     */
    public function getDriverInstance(string $driver) : SmsDriver
    {
        if (!isset($this->config['drivers'][$driver])) {
            throw new \Exception("Unknown sms driver \"{$driver}\"!");
        }

        $driver_config = $this->config['drivers'][$driver];
        return new $driver_config['class']($driver_config);
    }

    /**
     * @return void
     */
    public function setDefaultDriver()
    {
        $this->setDriver($this->config['default_driver']);
    }


    /**
     * @return void
     */
    public function setDriver(string $driver)
    {
        $this->driver = $this->getDriverInstance($driver);
    }


    public function __call(string $method, array $args)
    {
        return call_user_func_array([$this->getDriver(), $method], $args);
    }

}
