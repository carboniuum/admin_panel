<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\OrderResource;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        return OrderResource::collection(Order::paginate());
    }

    public function show($id)
    {
        return new OrderResource(Order::find($id));
    }
}
