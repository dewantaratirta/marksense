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


    function addView()
    {
        $this->wallet_view += 1;
        $this->save();
    }

    function addPopularities()
    {
        $count = $this->popularities()->where('popularity_date',
            now()->format('Y-m-d')
        )->get();

        if ($count->count() > 0) {
            $popularity = $count->first();
            $popularity->popularity_view += 1;
            $popularity->save();
            return;
        }

        $this->popularities()->create([
            'popularity_view' => 1,
            'popularity_date' => now(),
        ]);
    }

    /**
     * RELATIONSHIP
     */

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
