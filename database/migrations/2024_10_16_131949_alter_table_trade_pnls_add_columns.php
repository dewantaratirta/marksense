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
        Schema::table('trade_pnls', function (Blueprint $table) {
            $table->boolean('trade_pnl_is_minted')->nullable()->default(false);
            $table->timestamp('trade_pnl_minted_at')->nullable()->default(null);
            $table->string('trade_pnl_minted_by')->nullable()->default(null);
            $table->string('trade_pnl_minted_txid')->nullable()->default(null);
            $table->string('trade_pnl_minted_txurl')->nullable()->default(null);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('trade_pnls', function (Blueprint $table) {
            $table->dropColumn('trade_pnl_is_minted');
            $table->dropColumn('trade_pnl_minted_at');
            $table->dropColumn('trade_pnl_minted_by');
            $table->dropColumn('trade_pnl_minted_txid');
            $table->dropColumn('trade_pnl_minted_txurl');
        });
    }
};
