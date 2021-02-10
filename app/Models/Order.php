<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'total',
        'cashback',
        'used',
        'extras'
    ];

    protected $casts = [
        'extras' => 'array'
    ];

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

}
