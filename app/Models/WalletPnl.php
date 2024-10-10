<?php

namespace App\Models;

use App\Models\Trait\HasCustomUlid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Spatie\Image\Enums\CropPosition;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class WalletPnl extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected static function boot()
    {
        static::creating(function ($model) {
            if(empty($model->ulid)){
                $model->ulid = \Illuminate\Support\Str::ulid();
            }
        });
    }
    
    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'ulid';
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'ulid',
        'wallet_pnl_amount',
        'wallet_pnl_percentage',
        'wallet_pnl_date',
        'wallet_pnl_view',
        'wallet_proof_id',
        'wallet_proof_data',
        'wallet_id',
        'wallet_pnl_symbol',
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


    public function registerMediaConversions(?Media $media = null): void
    {
        $this->addMediaConversion('thumb')
            ->width(200)
            ->height(200)
            ->crop(100, 100, CropPosition::Center);
    }


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
