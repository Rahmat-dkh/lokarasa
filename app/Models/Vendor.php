<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'shop_name',
        'slug',
        'description',
        'flat_shipping_cost',
        'logo',
        'status',
        'bank_name',
        'bank_account_number',
        'bank_account_name',
        'address',
        'postal_code',
        'phone',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function wallet()
    {
        return $this->hasOne(VendorWallet::class);
    }

    public function payouts()
    {
        return $this->hasMany(Payout::class);
    }
}
