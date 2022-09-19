<?php

namespace App\Listeners;

use App\Events\OrderCreate;
use App\Facades\Cart;
use App\Models\Product;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\DB;
use Throwable;

class DeductProductQuantity
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Handle the event.
     *
     * @param object $event
     * @return void
     */
    public function handle(OrderCreate $event)
    {
        $order = $event->order;
        // UPDATE products SET quantity = quantity - 1
        foreach ($order->products as $product) {
            try {
                $product->decrement('quantity', $product->order_item->quantity);
            }catch (Throwable $e){

            }
        }
    }
}
