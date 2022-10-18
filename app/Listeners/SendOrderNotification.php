<?php

namespace App\Listeners;

use App\Events\OrderCreate;
use App\Models\User;
use App\Notifications\OrderCreatedNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification;

class SendOrderNotification
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
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
        $user = User::where('store_id', '=', $order->store_id)->first();
        if ($user) {
            $user->notify(new OrderCreatedNotification($order));
        }

    }
}
