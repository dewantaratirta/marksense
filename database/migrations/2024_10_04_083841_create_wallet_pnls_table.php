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
        Schema::create('wallet_pnls', function (Blueprint $table) {
            $table->id();
            $table->ulid('ulid')->nullable();
            $table->decimal('wallet_pnl_amount')->nullable()->default(0);
            $table->decimal('wallet_pnl_percentage')->nullable()->default(0);
            $table->date('wallet_pnl_date')->nullable()->default(null);
            $table->string('wallet_pnl_symbol')->nullable();
            $table->string('wallet_pnl_view')->default('0');
            $table->string('wallet_proof_data')->nullable();
            $table->foreignId('wallet_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wallet_pnls');
    }
};
