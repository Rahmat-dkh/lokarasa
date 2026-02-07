<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WalletTransaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'vendor_wallet_id',
        'amount',
        'type', // credit, debit
        'reference_id',
        'description',
    ];

    public function wallet()
    {
        return $this->belongsTo(VendorWallet::class, 'vendor_wallet_id');
    }
}
