<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderCreated;

use App\Client;
use App\Invoice;
use App\Terminal;

class Order extends Model
{
    
	public $incrementing = false;

	public function client()
	{

		return $this->belongsTo('App\Client');

	}

	public function invoices()
	{

		return $this->hasMany('App\Invoice');

	}

	public function create($numb, $client_id, $filename, $url, $size)
	{

		// Находим заданного клиента
		$client = Client::find($client_id);

		$hash_name = $numb . ".pdf";

		// Получить сам файл на сервер
		copy($url, $hash_name);

		// Выполняю скрипт и делаю парсинг на то, что выйдет в консоли
        // Никаких знаков в Windows и обязательный ./ в Linux
        exec("./pdfinfo {$hash_name}", $output);

        // Бегаем по строкам
        $pages = 0;

        foreach($output as $op){
            // Вытаскиваем число
            if(preg_match("/Pages:\s*(\d+)/i", $op, $matches) === 1){
                // Кол-во страниц
                $pages = intval($matches[1]);
                break;
            }
        }

        // Удаляю файл, чтобы не занимать много места на сервере
		unlink($hash_name);

		// Нет ошибок в самом pdf
		if($pages !== 0)
		{

			// Проверка мощностей терминалов
			$able_to_print = false;

			foreach(Terminal::all() as $terminal)
			{

				if( $terminal->pages >= $pages )
				{

					$able_to_print = true;

				}

			}

			if($able_to_print)
			{

				// Оформление заказа
				$this->id = $numb;
				$this->client_id = $client_id;
				$this->filename = $filename;
				$this->url = $url;
				$this->pages= $pages;
				$this->size = $size / pow(1024, 2);

				// Если нормально сохранилось
				if( $this->save() )
				{

					$client->send( "Заказ {$numb}, {$pages} стр\n" . 
													"{$filename}\n" . 
													"Жми ссылку👇" );

					// Отправляю ссылку клиенту
					$client->send( url( "/invoice/" . $this->id ) );

					Mail::to('darmesh.aidar@gmail.com')->send(new OrderCreated($client->about(), $this->id));

				} else {

					$client->send("Ошибка при оформлении заказа");

				}
				
			} else {

				$client->send("Терминалы разряжены, попробуйте позже 🙏");

			}

		} else {

			$client->send("Нет доступа к файлу");

		}

	}

	public function utilize()
	{

		foreach($this->invoices as $invoice)
		{

			$invoice->delete();

		}

		$this->delete();

	}

}
