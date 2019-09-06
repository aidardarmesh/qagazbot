<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderCreated;

use App\Client;
use App\Order;

class ClientsViewController extends Controller
{

    public function index()
    {

    	$clients = Client::all();

    	return view('clients.index', [
    								'clients' => $clients
    								]);

    }

    public function addGet()
    {

    	return view('clients.add');

    }

    public function addPost(Request $request)
    {

    	$info = $request->all();

    	if( Client::find($info['id']) === null )
    	{

	        $client = new Client();
	        $client->id = $info['id'];
			$client->first = $info['first'];
			$client->last = $info['last'];
			$client->username = $info['username'];
			$client->save();

			return redirect('clients');

    	} else {

    		return "Клиент существует";

    	}

    }

    public function details(Client $client)
	{

		return view('clients.details', [
								'client' => $client,
								'orders' => $client->orders
								]);

	}

	public function editGet(Client $client)
	{

		return view('clients.edit', [
							'client' => $client
							]);

	}

	public function editPost(Request $request)
	{

		$info = $request->all();

		$client = Client::find($info['id']);
		$client->first = $info['first'];
		$client->last = $info['last'];
		$client->username = $info['username'];
		$client->save();

		return redirect('clients/' . $client->id);

	}

    public function delete(Client $client)
	{

		$client->delete();

		return redirect('clients');

	}
    
}
