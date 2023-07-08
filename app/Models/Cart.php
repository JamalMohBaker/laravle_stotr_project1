<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class Cart extends Pivot
{
    use HasFactory;
    use HasUuids;

    // define table name because this is pivot can not define from model
    protected $table = 'carts';

    protected $fillable = [
        'cookie_id','user_id','product_id','quantity'
    ];

    public function user()
    {
        return $this->belongsTo(User::class)->withDefault();
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    //this function for columns in table that type is uuid
    // public function uniqueIds()  {
    //     return[
    //         'id','cookie_id'
    //     ];
    // }
}
