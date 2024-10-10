<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class TradePnl extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'ulid',
        'trade_pnl_amount',
        'trade_pnl_percentage',
        'trade_pnl_date',
        'trade_pnl_view',
        'trade_proof_id',
        'trade_proof_data',
        'trade_pnl_trade_id',
        'trade_pnl_symbol',
        'wallet_id',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'trade_pnl_amount' => 'decimal:2',
        'trade_pnl_percentage' => 'decimal:2',
        'trade_pnl_date' => 'date',
        'wallet_id' => 'integer',
    ];

    public function getPublicData()
    {
        $this->makeHidden([
            'id',
            'trade_proof_id',
            'trade_proof_data',
            'wallet_id',
        ]);
        $this->human_date = Carbon::parse($this->trade_pnl_date)->format('d/m/Y');
        $this->image_url = $this->getImageUrl();
        return $this;
    }

    public function getImageUrl()
    {
        return $this->media()->first()->getFullUrl();
    }

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
