<?php

namespace App\Listeners;


use App\Category;
<<<<<<< HEAD
use App\Event;
=======
use App\Events\NewNotifEvent;
>>>>>>> event_broadcasting
use App\Notification;

use Illuminate\Database\Eloquent;

use App\Events\ProductQuantityChange;
use Carbon\Carbon;
use Illuminate\Support\Facades\Event;

/*
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
*/

class NotifyQuantity
{
    /**
     * Create the event listener.
     *
     *
     */
    public function __construct()
    {

    }

    /**
     * Handle the event.
     *
     * @param  ProductQuantityChange  $event
     * @return void
     */
    public function handle(ProductQuantityChange $event)
    {
        if($event->product['allow_notif'] == true){
            if($event->product['qty'] <= $event->product['min_qty']){
                $notif = new Notification([
<<<<<<< HEAD
                   'title' => 'La quantitée est en dessous du minimum',
                   'text' => 'Il reste actuellement : ' .  $event->product['qty'] . ' '
                       . $event->product['name'] . ' et le minumum est : '.  $event->product['min_qty'],
                   'viewed' => false,
                   'created_at' => Carbon::now(),
                   'updated_at' => Carbon::now()]);
               $notif->save();
               \event(new New)
=======
                    'title' => 'La quantitée est en dessous du minimum',
                    'text' => 'Il reste actuellement : ' .  $event->product['qty'] . ' '
                        . $event->product['name'] . ' , et le minumum est : '.  $event->product['min_qty'],
                    'viewed' => false,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                    'product_id' => $event->product['id']]);
                $notif->save();
                event(new NewNotifEvent());
>>>>>>> event_broadcasting
            }else{
                if($event->product['qty'] >= $event->product['max_qty']){
                    $notif = new Notification([
                        'title' => 'La quantitée est au dessus du maximum',
                        'text' => 'Il y as actuellement : ' .  $event->product['qty'] . ' '
<<<<<<< HEAD
                            . $event->product['name'] . ' et le maximum est : '.  $event->product['max_qty'],
=======
                            . $event->product['name'] . ' , et le maximum est : '.  $event->product['max_qty'],
>>>>>>> event_broadcasting
                        'viewed' => false,
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now(),
                        'product_id' => $event->product['id']]);
                    $notif->save();
                    event(new NewNotifEvent());

                }
            }
        }
    }
}
