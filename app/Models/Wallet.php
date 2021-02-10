<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Wallet extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'site_id',
        'frozen',
        'available',
    ];

    protected $casts = [
        'is_active' => 'boolean'
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function site()
    {
        return $this->belongsTo(Site::class);
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    public function orders()
    {
        return $this->belongsToMany(Order::class, 'transactions')->as('transaction')->withPivot('id', 'status', 'amount');
    }

    public function actions()
    {
        return $this->hasManyThrough(Action::class, Transaction::class);
    }


}
