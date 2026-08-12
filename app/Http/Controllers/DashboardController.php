<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Http\Resources\ChartResources;

class DashboardController extends Controller
{
      public function chart(Request $request)
    {
        // 
        $order= Order::query()
        ->join('order_items', 'orders.id', '=', 'order_items.order_id')
        ->selectRaw("DATE(orders.created_at) as date, SUM(order_items.price * order_items.quantity) as sum")
            ->groupBy('date')
            ->get();

        return ChartResources::collection($order);
    }
}
