<?php

namespace App\Models;

use App\Models\Enum\GenderEnum;
use App\Models\Trait\HasCustomUlid;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Spatie\Image\Enums\CropPosition;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Permission\Traits\HasRoles;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class User extends Authenticatable implements HasMedia
{
    use HasFactory, Notifiable, HasRoles, HasCustomUlid, InteractsWithMedia;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
        'gender',
        'phone',
        'nik',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public static function boot()
    {
        parent::boot();
    }

    /**
     * Generate a hashed password.
     *
     * @param string $password The password to be hashed.
     * @return string The hashed password.
     */
    public static function generatePassword(string $password): string
    {
        $password = (string) Hash::make($password);
        return $password;
    }

    protected function gender(): Attribute
    {
        return Attribute::make(
            get: fn($value) => $value,
        );
    }

    public function avatarUrl($modifier = NULL)
    {
        if ($this->getMedia('avatar')->count() == 0) return null;
        $media =  $this->getMedia('avatar')->first();

        if ($modifier) {
            return $media->getUrl($modifier);
        }
        return $media->getUrl();
    }

    public function getAvatar($modifier = NULL)
    {
        $avatar = $this->avatarUrl($modifier);
        if ($avatar) return $avatar;
        return 'https://ui-avatars.com/api/?color=fff&background=666cff&name=' . urlencode($this->name);
    }


    public function registerMediaConversions(?Media $media = null): void
    {
        $this->addMediaConversion('thumb')
            ->width(100)
            ->height(100)
            ->crop(100, 100, CropPosition::Center);
    }

    /**
     * RELATIONSHIP
     */
}
