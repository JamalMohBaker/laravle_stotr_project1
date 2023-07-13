<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable , SoftDeletes;

    const TYPE_USER = 'user';
    const TYPE_ADMIN = 'admin';
    const TYPE_SUPER_ADMIN = 'super-admin';
    const STATUS_OPTIONS1 = 'active';
    const STATUS_OPTIONS2 = 'inactive';
    const STATUS_OPTIONS3 = 'blocked';
    public static function typesOptions()
    {
       return [
            self::TYPE_USER => 'user',
            self::TYPE_ADMIN => 'admin',
            self::TYPE_SUPER_ADMIN => 'super-admin',
       ];
    }
    public static function statusOptions()
    {
       return [
            self::STATUS_OPTIONS1 => 'active',
            self::STATUS_OPTIONS2 => 'inactive',
            self::STATUS_OPTIONS3 => 'blocked',
       ];
    }
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'status',
        'type',
        // 'confirmpassword',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        // 'confirmpassword',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function profile()
    {
        return $this->hasOne(profile::class)->withDefault([
            'first_name' => 'No Name',
        ]);
    }
    public function product()
    {
        return $this->hasMany(Product::class);
    }
    // User has many products in the cart
    public function cart()
    {
        return $this->belongsToMany(
            Product::class , // Related model (products) ** return of relation
             'carts' ,      // pivot table (default = product_user)
             'user_id',     // Fk current model in pivot table
             'product_id'   // Fk current model in pivot table

                //carts name Median table جدول الوسيط
                // 'user_id', 'product_id' => forigen key in table and orderBy accending
            )
            ->withPivot(['quantity']) // return quantity field حقل
            ->withTimestamps() // return Timestamps field
            ->using(Cart::class) // Model cart
            // last three are optional
            ;
    }
}
