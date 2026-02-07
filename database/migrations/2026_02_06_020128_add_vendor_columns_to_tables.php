<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->foreignId('vendor_id')->nullable()->constrained()->onDelete('cascade');
        });

        Schema::table('orders', function (Blueprint $table) {
            $table->foreignId('vendor_id')->nullable()->constrained()->onDelete('cascade');
            $table->string('payment_reference')->nullable();
            $table->decimal('service_fee', 10, 2)->default(0);
            $table->string('shipping_courier')->nullable();
            $table->string('shipping_service')->nullable();
            $table->decimal('shipping_cost', 10, 2)->default(0);
        });

        Schema::table('order_items', function (Blueprint $table) {
            $table->foreignId('vendor_id')->nullable()->constrained()->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropForeign(['vendor_id']);
            $table->dropColumn('vendor_id');
        });

        Schema::table('orders', function (Blueprint $table) {
            $table->dropForeign(['vendor_id']);
            $table->dropColumn([
                'vendor_id',
                'payment_reference',
                'service_fee',
                'shipping_courier',
                'shipping_service',
                'shipping_cost'
            ]);
        });

        Schema::table('order_items', function (Blueprint $table) {
            $table->dropForeign(['vendor_id']);
            $table->dropColumn('vendor_id');
        });
    }
};
