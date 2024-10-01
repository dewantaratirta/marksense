<?php

namespace App\Models\Trait;

use App\Models\Address;
use Laravolt\Indonesia\Models\Province;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Laravolt\Indonesia\Models\City;
use Laravolt\Indonesia\Models\District;
use Laravolt\Indonesia\Models\Village;

trait HasAddressTrait
{
    protected $bootCreateAddress = true;

    /**
     * Foreign key to address model
     *
     * @var array
     */
    protected $addressForeignColumn = [];

    protected static function bootAddressTrait()
    {
        // static::creating(function ($model) {
        //     if (!$model->bootCreateAddress) return;
        //     foreach ($model->addressForeignColumn as $value) {
        //         $this
        //     }
        // });
    }

    // public function __get($key){
    //     if($this->hasAttribute($key)) return $this->getAttribute($key);
    // }

    // public function province(): BelongsTo
    // {
    //     return $this->belongsTo(Province::class, 'province_id', 'code');
    // }

    // public function city(): BelongsTo
    // {
    //     return $this->belongsTo(City::class, 'city_id', 'code');
    // }

    // public function district(): BelongsTo
    // {
    //     return $this->belongsTo(District::class, 'district_id', 'code');
    // }

    // public function village(): BelongsTo
    // {
    //     return $this->belongsTo(Village::class, 'village_id', 'code');
    // }
}
