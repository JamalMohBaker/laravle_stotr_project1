<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class OrderLine extends Pivot
{
    use HasFactory;
    protected $table = 'order_lines';
    public $timestamps = false;
     protected $fillable = [
     'order_id','product_id','product_name','price','quantity',
   ];

   public function order()
   {
    return $this->belongsTo(Order::class);
   }
   public function product()
   {
    return $this->belongsTo(Product::class)->withDefault([
        'name' => $this->product_name,
        'price' => $this->price,
    ]);
   }
}
