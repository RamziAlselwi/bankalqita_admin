<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    
    public $table = 'orders';
    


    public $fillable = [
        'store_id',
        'customer_id',
        'product_id',
        'quantity',
        'remaining_date',
        'end_date',
        'amended_at',
        'created_at',
        'category_id',
        'code',
        'cuases',
        'others'
    ];


    /**
     * @return BelongsTo
     **/
    public function store(): BelongsTo
    {
        return $this->belongsTo(Store::class, 'store_id', 'id');
    }


    /**
     * @return BelongsTo
     **/
    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class, 'customer_id', 'id');
    }


    /**
     * @return BelongsTo
     **/
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }

    /**
     * @return BelongsTo
     **/
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

}
