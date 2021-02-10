<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'phone',
    ];

    protected $casts = [
        'is_active' => 'boolean'
    ];

    public function wallets()
    {
        return $this->hasMany(Wallet::class);
    }

    public function sites()
    {
        return $this->belongsToMany(Site::class, 'wallets')->as('wallet')->withPivot('id', 'available', 'frozen');
    }

    public function transactions()
    {
        return $this->hasManyThrough(Transaction::class, Wallet::class);
    }

    public function scopePhone($query, $phone)
    {
        $query->where('phone', $phone);
    }

    public function scopeFindByPhoneOrFail($query, $phone)
    {
        return $query->phone($phone)->firstOrFail();
    }

}
