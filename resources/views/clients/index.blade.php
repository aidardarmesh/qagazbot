@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Clients <a href="/clients/addGet" class="btn btn-success">add</a></div>

                <div class="panel-body">
                    @if( sizeof($clients) === 0)
                        <p>You don't have clients yet!</p>
                    @else
                        <table class="table table-striped table-bordered">
                            <tr>
                                <th>id</th>
                                <th>first</th>
                                <th>last</th>
                                <th>username</th>
                                <th>actions</th>
                            </tr>
                            @foreach($clients as $client)
                                <tr>
                                    <td>
                                        <a href="/clients/{{ $client->id }}">{{ $client->id }}</a>
                                    </td>
                                    <td>{{ $client->first }}</td>
                                    <td>{{ $client->last }}</td>
                                    <td>{{ $client->username }}</td>
                                    <td>
                                        <a href="/clients/{{ $client->id }}/editGet" class="btn btn-info">edit</a>
                                        <a href="/clients/{{ $client->id }}/delete" class="btn btn-danger">del</a>
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
