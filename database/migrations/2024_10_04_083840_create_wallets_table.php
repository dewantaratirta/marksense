<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('wallets', function (Blueprint $table) {
            $table->id();
            $table->string('wallet_address')->unique();
            $table->string('wallet_name');
            $table->string('wallet_username');
            $table->string('wallet_view')->default('0');
            $table->string('wallet_avatar')->nullable()->default(1);
            $table->string('wallet_binance_api_key')->nullable()->default(null);
            $table->string('wallet_binance_api_secret')->nullable()->default(null);
            $table->smallInteger('wallet_binance_api_status')->nullable()->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wallets');
    }
};
