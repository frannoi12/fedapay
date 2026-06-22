<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_name',
        'customer_email',
        'total_amount',
        'payment_status',
        'transaction_id',
    ];

    protected $casts = [
        'payment_status' => 'boolean',
        'total_amount' => 'decimal:2',
    ];

    public function items(){
        return $this->hasMany(OrderItem::class);
    }
}
