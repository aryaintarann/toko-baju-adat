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
            $table->string('status')->default('pending')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            // Note: reverting to an enum in SQLite might cause loss of constraint if not handled, 
            // but for simplicity we can leave it as string or attempt to revert.
            $table->enum('status', ['pending', 'processing', 'shipped', 'completed', 'cancelled', 'refunded'])->default('pending')->change();
        });
    }
};
