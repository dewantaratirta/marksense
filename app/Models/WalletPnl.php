<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class WalletPnl extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'wallet_pnl_ulid',
        'wallet_pnl_amount',
        'wallet_pnl_percentage',
        'wallet_pnl_date',
        'wallet_pnl_view',
        'wallet_proof_id',
        'wallet_proof_data',
        'wallet_id',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'wallet_pnl_amount' => 'decimal',
        'wallet_pnl_percentage' => 'decimal',
        'wallet_pnl_date' => 'date',
        'wallet_id' => 'integer',
    ];

    public function wallet(): BelongsTo
    {
        return $this->belongsTo(Wallet::class);
    }

    public function exchanges(): HasOne
    {
        return $this->hasOne(Exchanges::class);
    }

    public function popularities(): MorphToMany
    {
        return $this->morphToMany(Popularity::class, 'popularityable');
    }
}
