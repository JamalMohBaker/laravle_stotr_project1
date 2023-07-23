<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use NumberFormatter;

class Product extends Model
{
    use HasFactory , SoftDeletes; // trait

    const STATUS_ACTIVE = 'active';
    const STATUS_DRAFT = 'draft';
    const STATUS_ARCHIVED = 'archived';

    protected $fillable = [
        'name','slug','category_id','description','short_description',
        'price','compare_price','image','status','user_id'
    ];

    public static function statusOptions()
    {
       return [
            self::STATUS_ACTIVE => 'Active',
            self::STATUS_DRAFT => 'Draft',
            self::STATUS_ARCHIVED => 'Archived',
       ];
    }


    // Attribute Accessors: image_url | $product->image_url
    public function getImageurlAttribute()
    {
        if ($this->image) {
            return Storage::disk('public')->url($this->image);
        }
        return 'https://placeholder.co/600x600';
    }
    protected static function booted()
    {
        static::addGlobalScope('owner',function(Builder $query){
            // $query->where('user_id','=', Auth::id());
        });
    }

    //invers relationship many to one
    public function category()
    {
        return $this->belongsTo(category::class , 'category_id')->withDefault([
            'name' => 'Uncategorized',
        ]);
    }
    // withot record video on youtube
    public function gallery()
    {
        return $this->hasMany(productImage::class);
    }
    // invers many to many
    public function cart()
    {
        return $this->belongsToMany(
            user::class , // Related model (user) ** return of relation
             'carts' ,      // pivot table (default = product_user)
             'product_id',     // Fk current model in pivot table
             'user_id'   // Fk current model in pivot table

                //carts name Median table جدول الوسيط
                // 'user_id', 'product_id' => forigen key in table and orderBy accending
            )
            ->withPivot(['quantity']) // return quantity field حقل
            ->withTimestamps() // return Timestamps field
            ->using(Cart::class) // Model cart
            // last three are optional
            ;
    }
    //local scope
    public function scopeActive(Builder $query){
        $query->where('status','=','active');
    }
    public function scopeSlug(Builder $query , $slug){
        $query->where('slug','=',$slug);
    }
    //local scope
    public function scopeStatus(Builder $query , $status){
        $query->where('status','=',$status);
    }
    public function getNameAttribute($value)
    {
        return ucwords($value);// return first letter upper case for all word
    }
    public function getPriceFormattedAttribute()
    {
        $formatter = new NumberFormatter ('en', NumberFormatter::CURRENCY);
        return $formatter->formatCurrency($this->price, 'ILS');
    }
    public function getComparePriceFormattedAttribute()
    {
        $formatter = new NumberFormatter ('en', NumberFormatter::CURRENCY);
        return $formatter->formatCurrency($this->compare_price, 'ILS');
    }

    public function scopeFilter($query,  $filters)
    {
        $query->when($filters['search'] ?? false , function($query, $value){
            //$query = $products // $value = $products
            $query->where(function($query) use ($value){
                $query->where('products.name','LIKE', "%{$value}%")
                ->orWhere('products.description','LIKE', "%{$value}%");
            });
        })
        ->when($filters['status'] ?? false , function($query, $value){
            //$query = $products // $value = $products
            $query->where('products.status','LIKE', "%{$value}%");
        })
        ->when($filters['category_id'] ?? false , function($query, $value){
            $query->where('products.category_id','>=', $value);
        })
        ->when($filters['price_min'] ?? false , function($query, $value){
            $query->where('products.price','>=', $value);
        })
        ->when( $filters['price_max'] ?? false , function($query, $value){
            $query->where('products.price','<=', $value);
        });
    }
}
