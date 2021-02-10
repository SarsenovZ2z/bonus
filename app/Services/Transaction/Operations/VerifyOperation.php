<?php

namespace App\Services\Transaction\Operations;

use App\Models\Transaction;

use Hash;

trait VerifyOperation
{

    /**
     *
     *
     */
    public function sendVerification(Transaction $transaction)
    {
        $code = $this->setVerificationToken($transaction);

        // TODO: send sms
    }

    /**
     *
     *
     */
    public function verifyTransaction(Transaction $transaction, $code)
    {
        $this->checkVerificationCode($transaction, $code);

        $transaction->verification_token = null;
        $transaction->status = Transaction::PENDING;
        $transaction->save();
    }


    /**
     *
     * @return mixed
     */
    public function setVerificationToken(Transaction $transaction)
    {
        $code = $this->createVerificationCode($transaction);

        $transaction->verification_token = $this->getToken($code);
        $transaction->save();

        return $code;
    }

    /**
     *
     * @throws InvalidValidationCodeException
     * @return null
     */
    public function checkVerificationCode(Transaction $transaction, $code)
    {
        if ($transaction->verification_token != $this->getToken($code)) {
            throw new \Exception('Invalid code!');
        }
    }

    /**
     *
     * @return string
     */
    public function getToken($code) : string
    {
        return Hash::make($code);
    }

    /**
     *
     * @return mixed
     */
    public function createVerificationCode(Transaction $transaction)
    {
        return rand(1000, 9999);
    }

    /**
     *
     *
     * @return bool
     */
    public function needsVerification(Transaction $transaction) : bool
    {
        return $this->isExtracting($transaction);
    }
}
