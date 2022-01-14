<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;

    public $table = 'cities';
    


    public $fillable = [
        'name',
        'emirate_id'
    ];

        /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'name' => 'string',
        'emirate_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required',
        'emirate_id' => 'required'
    ];


    /**
     * @return BelongsTo
     **/
    public function emirate(): BelongsTo
    {
        return $this->belongsTo(Emirate::class, 'emirate_id', 'id');
    }
}
