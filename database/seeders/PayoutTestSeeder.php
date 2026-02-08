<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Vendor;
use App\Models\Payout;
use App\Models\VendorWallet;

class PayoutTestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $vendor = Vendor::first();

        if ($vendor) {
            // Ensure vendor has bank info
            $vendor->update([
                'bank_name' => 'BCA',
                'bank_account_number' => '1234567890',
                'bank_account_name' => $vendor->user->name
            ]);

            // Create a wallet if not exists
            $wallet = VendorWallet::firstOrCreate(
                ['vendor_id' => $vendor->id],
                ['balance' => 500000]
            );

            // Create a pending payout request
            Payout::create([
                'vendor_id' => $vendor->id,
                'amount' => 100000,
                'status' => 'pending',
            ]);
        }
    }
}
