@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Orders <a href="/orders/addGet" class="btn btn-success">new</a></div>

                <div class="panel-body">
                    @if( sizeof($orders) === 0)
                        <p>You don't have orders yet!</p>
                    @else
                        <table class="table table-striped table-bordered">
                            <tr>
                                <th>id</th>
                                <th>filename</th>
                                <th>pages</th>
                                <th>size</th>
                                <th>status</th>
                                <th>actions</th>
                            </tr>
                            @foreach($orders as $order)
                                <tr>
                                    <td>
                                        <a href="/orders/{{ $order->id }}">{{ $order->id }}</a>
                                    </td>
                                    <td>{{ $order->filename }}</td>
                                    <td>{{ $order->pages }}</td>
                                    <td>{{ $order->size }}</td>
                                    <td>
                                        @if($order->auth_code !== null)
                                        <span class="label label-primary">paid</span>
                                        @endif
                                        @if($order->printed_at !== null)
                                        <span class="label label-success">printed</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="/orders/{{ $order->id }}/editGet" class="btn btn-info">edit</a>
                                        <a href="/orders/{{ $order->id }}/delete" class="btn btn-danger">del</a>
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
