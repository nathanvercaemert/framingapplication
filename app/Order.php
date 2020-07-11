<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException as ModelNotFoundException;

class Order extends Model
{
    public static function nextOrderNumber()
    {
        $user = auth()->user()->id;
        $userOrders = \DB::select(
            \DB::raw("
                SELECT * from orders
            ")
        );

        if (count($userOrders) == 0) {
            $maxOrder = 0;
        }

        return $maxOrder + 1;
    }

}
