<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderPaid;

use App\Order;
use App\Invoice;
use App\Client;
use App\Terminal;

require_once('paysys/kkb.utils.php');

class InvoiceController extends Controller
{
    
	protected $config_path = "paysys/config.txt";

	public function invoice(Order $order)
	{

		if( $order === null )
		{

			return "Такого заказа нет";

		} else {

			if( $order->terminal_id !== null )
			{

				return "Заказ уже был распечатан";

			} else {

				if( $order->auth_code !== null )
				{

					return "Заказ уже оплачен";

				} else {
					
					// Данные для оплаты
					$currency_id = "398";
					$config_path = "paysys/config.txt";
					$price = $order->pages * 10 + 20;

					// Создание инвойса
					$invoice = new Invoice();
					$invoice->order_id = $order->id;
					$invoice->price = $price;
					$invoice->save();

					$url = 'https://epay.kkb.kz/jsp/process/logon.jsp';
					$email = 'qagazbot@gmail.com';
					$lang = 'rus';
					$backlink = url('/backlink');
					$fail_backlink = url('/fail_backlink');
					$postlink = url('/postlink');
					$fail_postlink = url('/fail_postlink');

					// Подписываем заказ
					$signed_order = process_request($invoice->id, $currency_id, $price, $this->config_path);

					return view('invoice', [
											'url' => $url,
											'signed_order' => $signed_order,
											'email' => $email,
											'lang' => $lang,
											'backlink' => $backlink,
											'fail_backlink' => $fail_backlink,
											'postlink' => $postlink,
											'fail_postlink' => $fail_postlink,
											]);

				}
			
			}

		}

	}

	public function backlink()
	{

		return redirect("https://vk.me/qagazbot");

	}

	public function fail_backlink()
	{

		return "Вы не оплатили заказ";

	}

	public function postlink(Request $request)
	{

		// Получаю данные об авторизации средств клиента
		$response = $_POST['response'];

		// Расшифровка
		$result = process_response(stripslashes($response), $this->config_path);

		$error = $card = $amount = $currency = $response_code = $approval_code = $reference = null;

		$invoice_id = empty($result['ORDER_ORDER_ID']) ? null : (int)$result['ORDER_ORDER_ID'];

		if (is_array($result)) {

			if (in_array("ERROR", $result)) {

				$error = "TYPE: $result[ERROR_TYPE], CODE: $result[ERROR_CODE], DATA: $result[ERROR_CHARDATA], TIME: $result[ERROR_TIME]";

        		$time = $result['ERROR_TIME'];

			}

			if (in_array("DOCUMENT", $result)) {

	            $time = $result['RESULTS_TIMESTAMP'];

	            $card = $result['PAYMENT_CARD'];

	            $amount = $result['PAYMENT_AMOUNT'];

	            $currency = $result['ORDER_CURRENCY'];

	            $response_code = $result['PAYMENT_RESPONSE_CODE'];

	            $approval_code = $result['PAYMENT_APPROVAL_CODE'];

	            $reference = $result['PAYMENT_REFERENCE'];

	        }

		} else {

			$error = 'INVALID_RESULT_FORMAT';

		}

		if ($result['CHECKRESULT'] != '[SIGN_GOOD]') {

		        $error = $result['CHECKRESULT'];

		    }

	    // Обновляю БД
	    $invoice = Invoice::find($invoice_id);
	    $invoice->confirmed = date('Y-m-d H:i:s');
	    $invoice->error = $error;
	    $invoice->card = $card;
	    $invoice->amount = $amount;
	    $invoice->currency = $currency;
	    $invoice->response_code = $response_code;
	    $invoice->approval_code = $approval_code;
	    $invoice->reference = $reference;
	    $invoice->save();

		// Списываю средства
	    $xml = urlencode(process_complete($reference, $approval_code, $invoice_id, $currency, $amount, $this->config_path));

	    $response = file_get_contents("https://epay.kkb.kz/jsp/remote/control.jsp?$xml");

	    $result = process_response(stripslashes($response), $this->config_path);

	    $error = null;

	    $invoice_id = empty($result['PAYMENT_ORDERID']) ? null : $result['PAYMENT_ORDERID'];

	    $approved = false;

	    if (is_array($result)) {

	        if (in_array("ERROR", $result)) {

	            $error = "TYPE: $result[ERROR_TYPE], CODE: $result[ERROR_CODE], DATA: $result[ERROR_CHARDATA], TIME: $result[ERROR_TIME]";

	            $time = $result['ERROR_TIME'];

	        }
	        if (in_array("DOCUMENT", $result) && !empty($result['RESPONSE_MESSAGE'])
	            && strtolower($result['RESPONSE_MESSAGE']) == 'approved' && !empty($result['COMMAND_TYPE'])
	            && strtolower($result['COMMAND_TYPE']) == 'complete') {

	            $approved = true;

	        }
	    } else {

	        $error = 'INVALID_RESULT_FORMAT';

	    }

	    if ($result['CHECKRESULT'] != '[SIGN_GOOD]') {

	        $error = $result['CHECKRESULT'];

	    }

	    // Обновляю БД
	    $invoice->approved = date('Y-m-d H:i:s');
	    $invoice->approve_error = $error;
	    $invoice->save();

	    if($error === null)
	    {

			// Создаю код аутентификации и отправляю его клиенту
			$order = $invoice->order;
			$client = $order->client;
			$auth_code = rand(1000, 9999);
			$order->auth_code = $auth_code;
			$order->save();
			$client->send(
							"Заказ " . $order->id . " оплачен👏\n" . 
							"Код аутентификации: " . $auth_code . " \n" . 
							"Введи номер заказа и код в терминал 👉\n" . 
							"МУИТ, 1 этаж, холл"
						);

			Mail::to('darmesh.aidar@gmail.com')->send(new OrderPaid($client->about(), $order->id));

			echo '0';

	    }

	}

	public function after()
	{

		$reference = 729581329054;
		$approval_code = 377789;
		$invoice_id = 58;
		$currency = "398";
		$amount = 20;

		// Списываю средства
	    $xml = urlencode(process_complete($reference, $approval_code, $invoice_id, $currency, $amount, $this->config_path));

	    $response = file_get_contents("https://epay.kkb.kz/jsp/remote/control.jsp?$xml");

	    $result = process_response(stripslashes($response), $this->config_path);

	    $error = null;

	    $invoice_id = empty($result['PAYMENT_ORDERID']) ? null : $result['PAYMENT_ORDERID'];

	    $approved = false;

	    if (is_array($result)) {

	        if (in_array("ERROR", $result)) {

	            $error = "TYPE: $result[ERROR_TYPE], CODE: $result[ERROR_CODE], DATA: $result[ERROR_CHARDATA], TIME: $result[ERROR_TIME]";

	            $time = $result['ERROR_TIME'];

	        }
	        if (in_array("DOCUMENT", $result) && !empty($result['RESPONSE_MESSAGE'])
	            && strtolower($result['RESPONSE_MESSAGE']) == 'approved' && !empty($result['COMMAND_TYPE'])
	            && strtolower($result['COMMAND_TYPE']) == 'complete') {

	            $approved = true;

	        }
	    } else {

	        $error = 'INVALID_RESULT_FORMAT';

	    }

	    if ($result['CHECKRESULT'] != '[SIGN_GOOD]') {

	        $error = $result['CHECKRESULT'];

	    }

	}

	public function fail_postlink()
	{

		return  "Списание средств не удалось по следующим причинам:\n" . 
				"1) Разблокируйте карту\n" . 
				"2) Недостаточно средств";

	}

}
