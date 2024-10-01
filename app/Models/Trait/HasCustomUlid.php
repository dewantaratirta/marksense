<?php

namespace App\Models\Trait;


trait HasCustomUlid
{
    protected static function bootHasCustomUlid()
    {
        static::creating(function ($model) {
            $model->ulid = \Illuminate\Support\Str::ulid();
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
}
