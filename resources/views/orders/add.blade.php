@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-default">
                <div class="panel-heading">New order</div>

                <div class="panel-body">
                    <form method="POST" action="/orders/addPost">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <p>
                                <label for="client_id">Client Id*</label>
                                <input id="client_id" type="text" name="client_id" class="form-control" required="on" value="86234301" placeholder="86234301">
                            </p>
                            <p>
                                <label for="filename">Filename*</label>
                                <input id="filename" type="text" name="filename" class="form-control" required="on" value="buhta.pdf" placeholder="buhta.pdf">
                            </p>
                            <p>
                                <label for="url">URL*</label>
                                <textarea id="url" name="url" class="form-control" required="on" placeholder="url"></textarea>
                            </p>
                            <p>
                                <label for="pages">Pages*</label>
                                <input id="pages" type="text" name="pages" class="form-control" required="on" placeholder="1" value="1">
                            </p>
                            <p>
                                <label for="size">Size (Mb)*</label>
                                <input id="size" type="text" name="size" class="form-control" required="on" placeholder="0.27" value="0.27">
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
