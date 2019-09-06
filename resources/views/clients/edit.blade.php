@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-default">
                <div class="panel-heading">Edit client</div>

                <div class="panel-body">
                    @if($client)
                    <form method="POST" action="/clients/{{ $client->id }}/editPost">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <p>
                                <input type="hidden" name="id" value="{{ $client->id }}">
                                <label for="first">First*</label>
                                <input id="first" type="text" name="first" class="form-control" required="on" value="{{ $client->first }}">
                            </p>
                            <p>
                                <label for="last">Last*</label>
                                <input id="last" type="text" name="last" class="form-control" required="on" value="{{ $client->last }}">
                            </p>
                            <p>
                                <label for="username">Username*</label>
                                <input id="username" type="text" name="username" class="form-control" required="on" value="{{ $client->username }}">
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
