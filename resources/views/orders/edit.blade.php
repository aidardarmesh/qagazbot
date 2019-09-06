@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-default">
                <div class="panel-heading">Edit order</div>

                <div class="panel-body">
                    <form method="POST" action="/orders/{{ $order->id }}/editPost">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <p>
                                <input type="hidden" name="id" value="{{ $order->id }}">
                                <label for="client_id">Client Id*</label>
                                <input id="client_id" type="text" name="client_id" class="form-control" required="on" value="{{ $order->client_id }}" placeholder="86234301">
                            </p>
                            <p>
                                <label for="filename">Filename*</label>
                                <input id="filename" type="text" name="filename" class="form-control" required="on" value="{{ $order->filename }}" placeholder="buhta.pdf">
                            </p>
                            <p>
                                <label for="url">URL*</label>
                                <textarea id="url" name="url" class="form-control" required="on" placeholder="url">{{ $order->url }}</textarea>
                            </p>
                            <p>
                                <label for="pages">Pages*</label>
                                <input id="pages" type="text" name="pages" class="form-control" required="on" placeholder="1" value="{{ $order->pages }}">
                            </p>
                            <p>
                                <label for="size">Size (Mb)*</label>
                                <input id="size" type="text" name="size" class="form-control" required="on" placeholder="0.27" value="{{ $order->size }}">
                            </p>
                            <p>
                                <label for="auth_code">Auth code</label>
                                <input id="auth_code" type="text" name="auth_code" class="form-control" placeholder="1818" value="{{ $order->auth_code }}">
                            </p>
                            <p>
                                <label for="terminal_id">Terminal Id</label>
                                <input id="terminal_id" type="text" name="terminal_id" class="form-control" placeholder="2391" value="{{ $order->terminal_id }}">
                            </p>
                            <p>
                                <label for="printed_at">Printed At</label>
                                <input id="printed_at" type="text" name="printed_at" class="form-control" placeholder="2018-02-20 13:53:02" value="{{ $order->printed_at }}">
                            </p>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
