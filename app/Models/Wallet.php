<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Wallet extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'wallet_address',
        'wallet_name',
        'wallet_username',
        'wallet_view',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
    ];

    public function walletSettings(): HasMany
    {
        return $this->hasMany(WalletSettings::class);
    }

    public function walletPnls(): HasMany
    {
        return $this->hasMany(WalletPnl::class);
    }

    public function tradePnls(): HasMany
    {
        return $this->hasMany(TradePnl::class);
    }

    public function popularities(): MorphToMany
    {
        return $this->morphToMany(Popularity::class, 'popularityable');
    }
}
