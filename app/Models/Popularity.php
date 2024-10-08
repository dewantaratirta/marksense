<?php

namespace App\Models;

use App\Models\Trait\HasCustomUlid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Popularity extends Model
{
    use HasFactory, HasCustomUlid;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'ulid',
        'popularity_view',
        'popularity_date',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'popularity_date' => 'date',
    ];

    /**
     * RELATIONSHIP
     */

    public function wallets(): MorphToMany
    {
        return $this->morphedByMany(Wallet::class, 'popularityable');
    }

    public function walletPnls(): MorphToMany
    {
        return $this->morphedByMany(WalletPnl::class, 'popularityable');
    }

    public function tradePnls(): MorphToMany
    {
        return $this->morphedByMany(TradePnl::class, 'popularityable');
    }
}
