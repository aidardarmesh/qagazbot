<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Client;
use App\Order;

class OrdersViewController extends Controller
{

	public function invoices(Order $order)
	{

		return $order->invoices;

	}
    
    public function index()
    {

    	return view('orders.index', [
    								'orders' => Order::all()
    								]);

    }

    public function addGet()
    {

    	return view('orders.add');

    }

    public function addPost(Request $request)
    {

    	$info = $request->all();

    	// Ищу уникальный id
        do{

            $id = rand(100000, 999999);
            $order = Order::find($id);

        } while( $order !== null );

        $order = new Order();
        $order->id = $id;
		$order->client_id = $info['client_id'];
		$order->filename = $info['filename'];
		$order->url = $info['url'];
		$order->pages = $info['pages'];
		$order->size = $info['size'];
		$order->save();

		return redirect('orders');

    }

    public function details(Order $order)
    {

    	return view('orders.details', [
    								'order' => $order,
    								'client' => $order->client
    								]);

    }

    public function editGet(Order $order)
	{

		return view('orders.edit', [
							'order' => $order
							]);

	}

	public function editPost(Request $request)
	{

		$info = $request->all();

		$order = Order::find($info['id']);
		$order->client_id = $info['client_id'];
		$order->filename = $info['filename'];
		$order->url = $info['url'];
		$order->pages = $info['pages'];
		$order->size = $info['size'];
		$order->auth_code = $info['auth_code'];
		$order->terminal_id = $info['terminal_id'];
		$order->printed_at = $info['printed_at'];
		$order->save();

		return redirect('orders/' . $order->id);

	}

    public function delete(Order $order)
	{

		$order->utilize();

		return redirect('orders');

	}

}
