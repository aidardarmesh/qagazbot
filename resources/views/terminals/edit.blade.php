@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-default">
                <div class="panel-heading">Edit terminal</div>

                <div class="panel-body">
                    @if($terminal)
                    <form method="POST" action="/terminals/{{ $terminal->id }}/editPost">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <p>
                                <input type="hidden" name="id" value="{{ $terminal->id }}">
                                <label for="phone">Phone*</label>
                                <input id="phone" type="text" name="phone" class="form-control" required="on" placeholder="+77086273347" value="{{ $terminal->phone }}">
                            </p>
                            <p>
                                <label for="traffic">Traffic*</label>
                                <input id="traffic" type="text" name="traffic" class="form-control" required="on" value="{{ $terminal->traffic }}">
                            </p>
                            <p>
                                <label for="pages">Pages*</label>
                                <input id="pages" type="text" name="pages" class="form-control" required="on" value="{{ $terminal->pages }}">
                            </p>
                            <p>
                                <label for="toner">Toner*</label>
                                <input id="toner" type="text" name="toner" class="form-control" required="on" value="{{ $terminal->toner }}">
                            </p>
                            <p>
                                <label for="done">Done*</label>
                                <input id="done" type="text" name="done" class="form-control" required="on" value="{{ $terminal->done }}">
                            </p>
                            <p>
                                <label for="addr">Address*</label>
                                <input id="addr" type="text" name="addr" class="form-control" required="on" value="{{ $terminal->addr }}">
                            </p>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                    @else
                    <p>Nothing found</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
