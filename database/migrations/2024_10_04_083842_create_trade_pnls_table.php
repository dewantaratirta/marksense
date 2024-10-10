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
        Schema::create('trade_pnls', function (Blueprint $table) {
            $table->id();
            $table->ulid('ulid')->nullable();
            $table->string('trade_pnl_trade_id')->nullable();
            $table->decimal('trade_pnl_amount')->nullable()->default(0);
            $table->decimal('trade_pnl_percentage')->nullable()->default(0);
            $table->date('trade_pnl_date')->nullable()->default(null);
            $table->string('trade_pnl_symbol')->nullable()->default(null);
            $table->string('trade_pnl_view')->default('0');
            $table->string('trade_proof_id')->nullable();
            $table->text('trade_proof_data')->nullable();
            $table->foreignId('wallet_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trade_pnls');
    }
};
