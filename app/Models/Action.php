<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Action extends Model
{
    use HasFactory;

    const CANCELED = 0;
    const CREATED = 1;
    const SUCCEED = 2;

    protected $fillable = [
        'action',
        'reason',
    ];

    public function transaction()
    {
        return $this->belongsTo(Transaction::class);
    }

    public function responsible()
    {
        return $this->morphTo();
    }

    public static function getActionOptions() : array
    {
        return [
            static::CREATED     => trans('admin.action.actions.created'),
            static::CANCELED    => trans('admin.action.actions.canceled'),
            static::SUCCEED     => trans('admin.action.actions.succeed')
        ];
    }

}
