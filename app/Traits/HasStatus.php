<?php

namespace App\Traits;

trait HasStatus
{

    public static function isSuccessStatus($status) : bool
    {
        return $status == static::SUCCESS;
    }

    public static function isCanceledStatus($status) : bool
    {
        return $status == static::CANCELED;
    }

    public static function isPendingStatus($status) : bool
    {
        return $status == static::PENDING;
    }

    public static function isVerifiedStatus($status) : bool
    {
        return $status != static::NOT_VERIFIED;
    }



    public function isSuccess() : bool
    {
        return static::isSuccessStatus($this->status);
    }

    public function isCanceled() : bool
    {
        return static::isCanceledStatus($this->status);
    }

    public function isPending() : bool
    {
        return static::isPendingStatus($this->status);
    }

    public function isVerified() : bool
    {
        return static::isVerifiedStatus($this->status);
    }

}
