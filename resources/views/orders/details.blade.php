@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-default">
                <div class="panel-heading">Order {{ $order->id }} <a class="btn btn-info" href="/orders/{{ $order->id }}/editGet">edit</a></div>
                <div class="panel-body">
                    <p>Client: <a href="/clients/{{ $client->id }}">{{ $client->first }} {{ $client->last }}</a></p>
                    <p>Filename: {{ $order->filename }}</p>
                    <p>URL: <a href="{{ $order->url }}" target="_blank">url</a></p>
                    <p>Pages: {{ $order->pages }}</p>
                    <p>Size: {{ $order->size }} Mb</p>
                    <p>Auth code: {{ $order->auth_code }}</p>
                    <p>Printed: здесь должен быть адрес терминала</p>
                    <p>Printed at: {{ $order->printed_at }}</p>
                    <p>Created: {{ $order->created_at }}</p>
                    <p>Updated: {{ $order->updated_at }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection