<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
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
        'price','compare_price','image','status'
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

    public function getNameAttribute($value)
    {
        return ucwords($value);// return first letter upper case for all word
    }
    public function getPriceFormattedAttribute()
    {   
        $formatter = new NumberFormatter ('en', NumberFormatter::CURRENCY);
        return $formatter->formatCurrency($this->price, 'ILS');
    }
}
