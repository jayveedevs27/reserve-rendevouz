<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id',
        'total_amount',
        'order_date',
        'status',
        'address',
        'delivery_person_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function deliveryPerson()
    {
        return $this->belongsTo(User::class, 'delivery_person_id');
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function deliveryDetails()
    {
        return $this->hasOne(DeliveryDetail::class);
    }
}
