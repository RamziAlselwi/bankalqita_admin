<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Relations\HasMany;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Emirate extends Model
{
    use HasFactory;

    public $table = 'emirates';
    


    public $fillable = [
        'name'
    ];

        /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'name' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required'
    ];


    public function cities(): HasMany
    {
        return $this->hasMany(\App\Models\City::class, 'emirate_id');
    }
}
