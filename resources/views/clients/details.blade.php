@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-default">
                <div class="panel-heading">Client {{ $client->id }} <a class="btn btn-info" href="/clients/{{ $client->id }}/editGet">edit</a></div>
                <div class="panel-body">
                    <p>First: {{ $client->first }}</p>
                    <p>Last: {{ $client->last }}</p>
                    <p>Username: 
                        @if($client->username !== null)
                        <a href="https://vk.com/{{ $client->username }}" target="_blank">{{ $client->username }}</a>
                        @else
                        <a href="https://vk.com/id{{ $client->id }}" target="_blank">{{ $client->id }}</a>
                        @endif
                    </p>
                    <p>Created: {{ $client->created_at }}</p>
                    <p>Updated: {{ $client->updated_at }}</p>
                </div>
            </div>
        </div>

        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Actual orders</div>
                <div class="panel-body">
                    @if( sizeof($orders) === 0)
                        <p>You don't have orders yet!</p>
                    @else
                        <table class="table table-striped table-bordered">
                            
                        </table>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection