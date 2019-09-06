<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderPrinted;

use App\Terminal;
use App\Order;
use App\Client;

class TerminalController extends Controller
{

	public function order($id)
	{	
		
		$order = Order::find($id);

		if($order !== null)
		{

			$order->client = $order->client;
			return $order;

		} else {

			return null;

		}

	}

	public function printed($terminal_id, Order $order)
	{

		$order->terminal_id = $terminal_id;
		$order->printed_at = date('Y-m-d H:i:s');
		$order->save();

		$terminal = Terminal::find($terminal_id);
		$terminal->pages -= $order->pages;
		// Сразу учитываю трафик на все запросы
		$terminal->traffic -= ($order->size + 0.5);
		$terminal->toner -= $order->pages;
		$terminal->done += $order->pages;
		$terminal->save();

		// Благодарность
		$order->client->send("Заказ " . $order->id . " распечатан👍");

		// Уведомление админу
		Mail::to('darmesh.aidar@gmail.com')->send(new OrderPrinted($order->client->about(), $terminal->about()));

	}

	public function info(Terminal $terminal)
	{

		return $terminal;

	}

}