<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
    	$order = new Order();
    	$data=array();
    	$data['order'] = $order->getOrder($request->get('search'));
    	$data['request'] = $request;
        return view('dashboard.index',$data);
    }
}
