<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Foundation\Auth\User as Authenticatable;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\Models\Media;

class Store extends Authenticatable implements JWTSubject, HasMedia
{
    use HasFactory;


    use HasMediaTrait {
        getFirstMediaUrl as protected getFirstMediaUrlTrait;
    }

    public $table = 'stores';
    


    public $fillable = [
        'name',
        'phone',
        'password',
        'emirate_id',
        'city_id',
        'street',
    ];

        /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'name' => 'string',
        'phone' => 'string',
        'password' => 'string',
        'image' => 'string',
        'commercial_register' => 'string',
        'emirate_id' => 'integer',
        'city_id' => 'integer',
        'street' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required',
        'phone' => 'required|string|unique:users',
        'password' => 'required|min:6'
    ];

    /**
     * New Attributes
     *
     * @var array
     */
    protected $appends = [
        'has_media',
    ];


    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }


    /**
     * @param Media|null $media
     * @throws InvalidManipulation
     */
    public function registerMediaConversions(Media $media = null)
    {
        $this->addMediaConversion('thumb')
            ->width(60)
            ->height(60);
    }


    /**
     * Add Media to api results
     * @return bool
     */
    public function getHasMediaAttribute()
    {
        return $this->hasMedia('image') ? true : ($this->hasMedia('commercial_register') ? true : false);
    }


    /**
     * @return BelongsTo
     **/
    public function emirate(): BelongsTo
    {
        return $this->belongsTo(Emirate::class, 'emirate_id', 'id');
    }

    /**
     * @return BelongsTo
     **/
    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class, 'city_id', 'id');
    }


    
    public function orders(): HasMany
    {
        return $this->hasMany(\App\Models\Order::class, 'store_id');
    }


}
