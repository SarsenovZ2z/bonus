<?php

namespace App\Models;

use App\Services\Auth\AuthenticatableSite as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Site extends Authenticatable
{
    use HasFactory;

    protected $fillable = [
        'key',
        'password',
        'is_active',
        'name',
        'url',
    ];

    protected $hidden = [
        'password',
    ];

    protected $casts = [
        'is_active' => 'boolean'
    ];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function wallets()
    {
        return $this->hasMany(Wallet::class);
    }

    public function clients()
    {
        return $this->belongsToMany(Client::class, 'wallets')->as('wallet')->withPivot('id', 'available', 'frozen');
    }

    public function transactions()
    {
        return $this->hasManyThrough(Transaction::class, Wallet::class);
    }

    public function actions()
    {
        return $this->morphMany(Action::class, 'responsible');
    }

}
