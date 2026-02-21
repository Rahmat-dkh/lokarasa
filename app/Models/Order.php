<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'vendor_id',
        'payment_reference',
        'total_amount',
        'status',
        'shipping_address',
        'service_fee',
        'shipping_cost',
        'shipping_courier',
        'shipping_service',
        'phone',
        'shipment_id',
        'tracking_number',
        'shipping_label',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }
}
