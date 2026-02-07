<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payout extends Model
{
    use HasFactory;

    protected $fillable = [
        'vendor_id',
        'amount',
        'status',
        'midtrans_payout_id',
    ];

    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }
}
