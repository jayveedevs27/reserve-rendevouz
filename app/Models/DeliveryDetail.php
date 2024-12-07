<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DeliveryDetail extends Model
{
    protected $fillable = [
        'order_id',
        'delivery_person_id',
        'status',
        'delivery_time',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function deliveryPerson()
    {
        return $this->belongsTo(User::class, 'delivery_person_id');
    }
}
