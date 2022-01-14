<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;


    public $table = 'customers';
    


    public $fillable = [
        'name',
        'phone',
        'serial_number',
    ];

        /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'name' => 'string',
        'phone' => 'string',
        'serial_number' => 'string'
    ];


    
}
