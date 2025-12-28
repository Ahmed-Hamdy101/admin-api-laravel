<?php

namespace App\Http\Controllers;

use App\Http\Resources\OrderResource;
use App\Models\Order;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\Types\Collection;

class OrderController extends Controller
{
    public function index()
    {
        // list order with pagination
        $order = Order::paginate(10);
        return OrderResource::collection($order);
    }

    public function show($id)
    {
     //show id order
        return new OrderResource(Order::findOrFail($id));
    }

}
