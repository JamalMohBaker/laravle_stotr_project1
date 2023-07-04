<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    public function products(){
        //one to many relationship with product model
        return $this->hasMany(Product::class , 'category_id');
    }
}
