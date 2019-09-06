@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-default">
                <div class="panel-heading">New terminal</div>

                <div class="panel-body">
                    <form method="POST" action="/terminals/addPost">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <p>
                                <label for="phone">Phone*</label>
                                <input id="phone" type="text" name="phone" class="form-control" required="on" placeholder="+77086273347">
                            </p>
                            <p>
                                <label for="traffic">Traffic*</label>
                                <input id="traffic" type="text" name="traffic" class="form-control" required="on" value="15360">
                            </p>
                            <p>
                                <label for="pages">Pages*</label>
                                <input id="pages" type="text" name="pages" class="form-control" required="on" value="500">
                            </p>
                            <p>
                                <label for="toner">Toner*</label>
                                <input id="toner" type="text" name="toner" class="form-control" required="on" value="3000">
                            </p>
                            <p>
                                <label for="addr">Address*</label>
                                <input id="addr" type="text" name="addr" class="form-control" required="on" value="МУИТ, 1 этаж, 107 каб, напротив Meeting Room">
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
