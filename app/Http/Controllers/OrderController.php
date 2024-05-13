<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function index()
    {
        return response()->json("OK");
    }

    public function raw()
    {
            $result = DB::table('order_product')
                ->join('products', 'order_product.product_id', '=', 'products.id')
                ->join('orders', 'order_product.order_id', '=', 'orders.id')
                ->groupBy('order_product.product_id')
                ->orderBy('total_sales', 'DESC')
                ->select(['order_product.product_id', DB::raw('SUM(order_product.quantity) as total_sales')])
                ->get();

        return response()->json($result);

    }

    public function withcache()
    {
        $result = Cache::remember('orders', 60, function() {
            $result = DB::table('order_product')
                ->join('products', 'order_product.product_id', '=', 'products.id')
                ->join('orders', 'order_product.order_id', '=', 'orders.id')
                ->groupBy('order_product.product_id')
                ->orderBy('total_sales', 'DESC')
                ->select(['order_product.product_id', DB::raw('SUM(order_product.quantity) as total_sales')])
                ->get();

            return $result;
        });

        return response()->json($result);

    }
}
