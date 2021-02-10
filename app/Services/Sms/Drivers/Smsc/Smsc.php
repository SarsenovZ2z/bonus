<?php

namespace App\Services\Sms\Drivers\Smsc;

use App\Services\Sms\Contracts\SmsDriver;

use Http;

class Smsc implements SmsDriver
{

    protected $url;

    protected $login;
    protected $psw;

    protected $from;
    protected $time;

    public function __construct(array $config)
    {
        $this->url = $config['url'];

        $this->login = $config['login'];
        $this->psw = $config['password'];

        $this->from = $config['from'] ?? '';
        $this->time = $config['time'] ?? 0;
    }


    /**
     *
     * @return bool
     */
    public function send(string $phone, string $text) : bool
    {
        $response = Http::get($this->url, [
            'login' => $this->login,
            'psw' => $this->psw,
            'from' => $this->from,
            'time' => $this->time,

            'phones' => $phone,
            'mes' => $text,
        ]);

        return $response->ok();
    }

}
