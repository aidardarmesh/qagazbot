<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    
	public $incrementing = false;

	public function orders()
	{

		return $this->hasMany('App\Order');

	}

	public function signUp($user_id)
	{

		$about = json_decode(file_get_contents("https://api.vk.com/method/users.get?user_ids=" . $user_id . "&fields=domain" . "&v=" . config('vk.v')));

		$this->id = $user_id;
		$this->first = $about->response[0]->first_name;
		$this->last = $about->response[0]->last_name;
		$this->username = $about->response[0]->domain;

		$this->save();

	}

	public function send($message)
	{

		$request_params = array(
            "message" => $message,
            "user_id" => $this->id,
            "access_token" => config("vk.token"),
            "v" => config("vk.v")
        );

        $http_params = http_build_query($request_params);

        file_get_contents("https://api.vk.com/method/messages.send?" . $http_params);

	}

	public function wait()
	{

		$this->send("Подожди, я считаю 🤓");

	}

	public function about()
	{

		return $this->first . " " . $this->last;

	}

	public function url()
	{

		return "https://vk.com/id" . $this->id;

	}

}
