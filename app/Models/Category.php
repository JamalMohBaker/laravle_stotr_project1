<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory , SoftDeletes;

    protected $fillable = [
        'name', 'id'
    ];
    public function products(){
        //one to many relationship with product model
        return $this->hasMany(Product::class , 'category_id');
    }


    // this function for override the default route key name:
            public function getRouteKeyName()
        {
            return 'name';
        }

}
