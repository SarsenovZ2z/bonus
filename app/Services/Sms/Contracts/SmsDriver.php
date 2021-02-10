<?php

namespace App\Services\Sms\Contracts;

interface SmsDriver
{

    public function send(string $phone, string $text);

}
