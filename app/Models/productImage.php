<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class productImage extends Model
{
    use HasFactory;
    protected $fillable = [
        'product_id','image',
    ];

    public function geturlAttribute()
    {
        return Storage::disk('public')->url($this->image);
    }
}
