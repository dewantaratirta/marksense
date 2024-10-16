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
        'trade_pnl_is_minted',
        'trade_pnl_minted_at',
        'trade_pnl_minted_by',
        'trade_pnl_minted_txid',
        'trade_pnl_minted_txurl',
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
        'trade_pnl_is_minted' => 'boolean',
    ];

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'ulid';
    }

    public function getPublicData()
    {
        $this->makeHidden([
            'id',
            'trade_proof_id',
            'wallet_id',
        ]);
        $this->human_date = Carbon::parse($this->trade_pnl_date)->format('d/m/Y');
        $this->image_url = $this->getImageUrl();
        $this->api_proof_metadata_url = route('api.proof.futures_metadata', $this->ulid);
        return $this;
    }

    public function unserializedProofData(): self
    {
        $this->unserialized_proof = unserialize($this->trade_proof_data);
        return $this;
    }

    function addView()
    {
        $this->trade_pnl_view += 1;
        $this->save();
    }

    function addPopularities()
    {
        $count = $this->popularities()->where(
            'popularity_date',
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

    public function getImageUrl()
    {
        return $this->media->first()->getFullUrl();
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
