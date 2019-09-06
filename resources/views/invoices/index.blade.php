@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Invoices</div>

                <div class="panel-body">
                    @if( sizeof($invoices) === 0)
                        <p>You don't have invoices yet!</p>
                    @else
                        <table class="table table-striped table-bordered">
                            <tr>
                                <th>id</th>
                                <th>order</th>
                                <th>card</th>
                                <th>amount</th>
                                <th>reference</th>
                                <th>approved</th>
                                <th>actions</th>
                            </tr>
                            @foreach($invoices as $invoice)
                                <tr>
                                    <td>
                                        <a href="/invoices/{{ $invoice->id }}">{{ $invoice->id }}</a>
                                    </td>
                                    <td><a href="/orders/{{ $invoice->order_id }}" target="_blank">{{ $invoice->order_id }}</a></td>
                                    <td>{{ $invoice->card }}</td>
                                    <td>{{ $invoice->amount }}</td>
                                    <td>{{ $invoice->reference }}</td>
                                    <td>{{ $invoice->approved }}</td>
                                    <td>
                                        <a href="/invoices/{{ $invoice->id }}/delete" class="btn btn-danger">del</a>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
