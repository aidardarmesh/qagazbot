<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Invoice;
use App\Order;

class InvoicesViewController extends Controller
{
    
	public function index()
    {

    	return view('invoices.index', [
    								'invoices' => Invoice::all()
    								]);

    }

    public function details(Invoice $invoice)
    {

    	return view('invoices.details', [
    								'invoice' => $invoice
    								]);

    }

    public function delete(Invoice $invoice)
	{

		$invoice->delete();

		return redirect('invoices');

	}

}
