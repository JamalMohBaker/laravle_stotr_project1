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

    //local scope
    public function scopeActive(Builder $query){
        $query->where('status','=','active');
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
}
