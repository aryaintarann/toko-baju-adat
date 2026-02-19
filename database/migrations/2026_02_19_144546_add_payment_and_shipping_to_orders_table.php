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
        Schema::table('orders', function (Blueprint $table) {
            $table->string('snap_token')->nullable()->after('status');
            $table->string('payment_status')->default('pending')->after('snap_token'); // pending, paid, expire, cancel
            $table->string('courier')->nullable()->after('customer_address');
            $table->string('shipping_service')->nullable()->after('courier');
            $table->decimal('shipping_cost', 10, 2)->default(0)->after('shipping_service');
            $table->string('province_id')->nullable()->after('shipping_cost');
            $table->string('city_id')->nullable()->after('province_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            //
        });
    }
};
