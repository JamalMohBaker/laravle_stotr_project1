<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    const STATTUS1 = 'pending';
    const STATTUS2 = 'processing';
    const STATTUS3 = 'shipped';
    const STATTUS4 = 'completed';
    const STATTUS5 = 'cancelled';
    const STATTUS6 = 'refunded';
    const PAYMENT_STATTUS1 = 'pending';
    const PAYMENT_STATTUS2 = 'paid';
    const PAYMENT_STATTUS3 = 'failed';

    public static function statusOptions()
    {
       return [
            self::STATTUS1 => 'pending',
            self::STATTUS2 => 'processing',
            self::STATTUS3 => 'shipped',
            self::STATTUS4 => 'completed',
            self::STATTUS5 => 'cancelled',
            self::STATTUS6 => 'refunded',
       ];
    }

    public static function paymentStatus()
    {
       return [
            self::PAYMENT_STATTUS1 => 'pending',
            self::PAYMENT_STATTUS2 => 'paid',
            self::PAYMENT_STATTUS3 => 'failed',
       ];
    }


    protected $fillable = [
        'user_id',
        'customer_first_name',
        'customer_last_name',
        'customer_email',
        'customer_phone',
        'customer_address',
        'customer_city',
        'customer_postal_code',
        'customer_province',
        'customer_country_code',
        'status',
        'payment_status',
        'currency',
        'total',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function products()
    {
        return $this->belongsTo(Products::class , 'order_lines')
        ->withPivot(['quantity', 'product_name', 'price'])
        ->using(OrderLine::class);
    }
    public function lines()
    {
        return $this->hasMany(OrderLine::class);
    }
}
