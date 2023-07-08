<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class profile extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name','last_name','gender','birthday','address',
        'city','postal_code','province','country_code',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
