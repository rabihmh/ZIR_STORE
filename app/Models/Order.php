<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'store_id', 'user_id', 'payment_methode', 'status', 'payment_status'
    ];

    public function store()
    {
        return $this->belongsTo(Store::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class)->withDefault([
            'name' => 'Guest Customer'
        ]);
    }

    public function products()
    {
        return $this->belongsToMany(
            Product::class,
            'order_items',
            'order_id',
            'product_id',
            'id',
            'id'
        )->using(OrderItem::class)->as('order_item')
            ->withPivot([
                'product_name', 'price', 'quantity', 'options'
            ]);
    }

    public function addresses()
    {
        return $this->hasMany(OrderAddress::class, 'order_id', 'id');
    }

    public function billingAddress()
    {
        return $this->hasOne(OrderAddress::class, 'order_id', 'id')->where('type', '=', 'billing');
    }

    public function shippingAddress()
    {
        return $this->hasOne(OrderAddress::class, 'order_id', 'id')->where('type', '=', 'shipping');
        //return $this->addresses()->where('type', '=', 'shipping'); it return collection
    }


    protected static function booted()
    {
        static::creating(function (Order $order) {
            //20220000;202200001
            $order->number = Order::getNextOrderNumber();
        });
    }

    public static function getNextOrderNumber()
    {
        //select MAX('number) FROM orders
        $year = Carbon::now()->year;
        $number = Order::whereYear('created_at', $year)->max('number');
        if ($number) {
            return $number + 1;
        }
        return $year . '0001';
    }
}
