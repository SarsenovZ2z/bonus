<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Events\TransactionCanceledEvent;
use App\Events\TransactionSucceedEvent;

use App\Traits\HasStatus;

class Transaction extends Model
{
    use HasFactory, HasStatus;

    const CANCELED = 0;
    const NOT_VERIFIED = 1;
    const PENDING = 2;
    const SUCCESS = 3;

    protected $dispatchesEvents = [
        'canceled'  => TransactionCanceledEvent::class,
        'succeed'   => TransactionSucceedEvent::class
    ];


    protected $fillable = [
        'status',
        'amount',
    ];

    public function wallet()
    {
        return $this->belongsTo(Wallet::class);
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function actions()
    {
        return $this->hasMany(Action::class);
    }


    public function fireSucceedEvent()
    {
        $this->fireModelEvent('succeed');
    }

    public function fireCanceledEvent()
    {
        $this->fireModelEvent('canceled');
    }


    public static function getStatusOptions() : array
    {
        return [
            static::CANCELED        => trans('admin.transaction.status.canceled'),
            static::NOT_VERIFIED    => trans('admin.transaction.status.not_verified'),
            static::PENDING         => trans('admin.transaction.status.pending'),
            static::SUCCESS         => trans('admin.transaction.status.success'),
        ];
    }
}
