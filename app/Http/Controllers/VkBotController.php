<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Jobs\HandleVkMessage;

class VkBotController extends Controller
{
    
	public function messageNew(Request $request)
	{

		// Получаем и декодируем уведомление
		$data = json_decode($request->getContent());

		switch($data->type)
		{
			case "confirmation":
				// Отвечаем ВК API
				return config('vk.confkey');

			case "message_new":
				// Чтобы запросы мне мог делать только ВК
        		if( $data->secret === config("vk.secret") )
        		{

					// Передаем задание в очередь
					dispatch(new HandleVkMessage($data->object));

				} else {

					echo "wrong secret";

				}

				return "ok";

			default:
				return "ok";
		}

	}

}
