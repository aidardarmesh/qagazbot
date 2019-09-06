<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

use App\Client;
use App\Order;

class HandleVkMessage implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $object;

    public function __construct($object)
    {

        $this->object = $object;

    }

    public function handle()
    {
        
        // Если клиента нет в системе, регистрируем клиента
        $client = Client::find($this->object->user_id);

        if( $client === null )
        {

            $client = new Client();
            $client->signUp($this->object->user_id);

        }

        // Предупреждаю клиента
        $client->wait();

        // Проверяем, существуют ли вложенности
        if( property_exists($this->object, "attachments") )
        {

            // Считаю кол-во элементов во вложенности
            $elems_numb = count($this->object->attachments);

            // Мне нужен только 1 элемент
            if( $elems_numb == 1 )
            {

                // Сделаем отдельный объект doc для удобства ссылания
                $doc = $this->object->attachments[0];

                // Делаю проверку на тип вложенности этого элемента мне нужен только doc
                if( property_exists($doc, "doc") )
                {

                    // Проверяю тип документа, беру только pdf
                    if( $doc->doc->ext == "pdf" )
                    {

                        // Ищу уникальный order_id
                        do{

                            $numb = rand(100000, 999999);
                            $order = Order::find($numb);

                        } while( $order !== null );

                        // Оформление заказа
                        $order = new Order();
                        $order->create( 
                                        $numb,
                                        $client->id,
                                        $doc->doc->title,
                                        $doc->doc->url,
                                        $doc->doc->size
                                    );

                    } else {

                        $client->send("PDF мой любимый формат ❤");

                    }

                } else {

                    $client->send("Мы же документ будем печатать? 📰");

                }

            } else {

                $client->send("Я же просил только один PDF 😆");

            }

        } else {

            $client->send("Присылай один файл PDF 😉");

        }

    }
}
