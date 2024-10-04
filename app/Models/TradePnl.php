<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class TradePnl extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'trade_pnl_ulid',
        'trade_pnl_amount',
        'trade_pnl_percentage',
        'trade_pnl_date',
        'trade_pnl_view',
        'trade_proof_id',
        'trade_proof_data',
        'wallet_id',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'trade_pnl_amount' => 'decimal',
        'trade_pnl_percentage' => 'decimal',
        'trade_pnl_date' => 'date',
        'wallet_id' => 'integer',
    ];

    public function exchanges(): HasOne
    {
        return $this->hasOne(Exchanges::class);
    }

    public function wallet(): BelongsTo
    {
        return $this->belongsTo(Wallet::class);
    }

    public function popularities(): MorphToMany
    {
        return $this->morphToMany(Popularity::class, 'popularityable');
    }
}
