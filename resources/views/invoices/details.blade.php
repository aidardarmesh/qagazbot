@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-default">
                <div class="panel-heading">Invoice {{ $invoice->id }}</div>
                <div class="panel-body">
                    <p>Order Id: <a href="/orders/{{ $invoice->order_id }}" target="_blank">{{ $invoice->order_id }}</a></p>
                    <p>Price: {{ $invoice->price }}</p>
                    <p>Confirmed: {{ $invoice->confirmed }}</p>
                    <p>Error: {{ $invoice->error }}</p>
                    <p>Card: {{ $invoice->card }}</p>
                    <p>Amount: {{ $invoice->amount }}</p>
                    <p>Currency: {{ $invoice->currency }}</p>
                    <p>Response Code: {{ $invoice->response_code }}</p>
                    <p>Aproval Code: {{ $invoice->approval_code }}</p>
                    <p>Reference: {{ $invoice->reference }}</p>
                    <p>Approved: {{ $invoice->approved }}</p>
                    <p>Approve Error: {{ $invoice->approve_error }}</p>
                    <p>Created: {{ $invoice->created_at }}</p>
                    <p>Updated: {{ $invoice->updated_at }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection