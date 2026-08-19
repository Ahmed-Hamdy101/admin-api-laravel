<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Http\Resources\ChartResources;

class DashboardController extends Controller
{
      public function chart(Request $request)
    {
        // show chart data for the last 7 days
        $order= Order::query()
        ->join('order_items', 'orders.id', '=', 'order_items.order_id')
        ->selectRaw("DATE(orders.created_at) as date, SUM(order_items.price * order_items.quantity) as sum")
            ->groupBy('date')
            ->where('orders.created_at', '>=', now()->subDays(7))
            ->get();

        return ChartResources::collection($order);
    }
}
