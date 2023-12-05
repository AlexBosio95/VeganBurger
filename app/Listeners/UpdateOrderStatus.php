<?php

namespace App\Listeners;

use App\Events\OrderItemUpdated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class UpdateOrderStatus
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
     * @param  \App\Events\OrderItemUpdated  $event
     * @return void
     */
    public function handle(OrderItemUpdated $event)
    {
        $orderItem = $event->orderItem;
        $order = $orderItem->order;

        if ($order && $order->orderItems) {
            // Verifica lo stato degli elementi dell'ordine
            $allCompleted = $order->orderItems->every(function ($item) {
                return $item->completed;
            });

            // Aggiorna lo stato dell'ordine
            $order->status = $allCompleted ? 'completed' : 'incomplete';
            $order->save();
        }
    }
}
