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
        'wallet_avatar',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
    ];

    public function getAvatarUrl()
    {
        return 'https://avatar.iran.liara.run/public/' . $this->wallet_avatar;
    }


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

    function addAvatar($id_avatar)
    {
        $this->wallet_avatar = $id_avatar;
        $this->save();
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
