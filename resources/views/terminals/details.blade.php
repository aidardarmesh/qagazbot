@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-default">
                <div class="panel-heading">Terminal {{ $terminal->id }} <a class="btn btn-info" href="/terminals/{{ $terminal->id }}/editGet">edit</a></div>

                <div class="panel-body">
                    <p>Address: {{ $terminal->addr }}</p>
                    <p>Pages: {{ $terminal->pages }}</p>
                    <p>Toner: {{ $terminal->toner }}</p>
                    <p>Traffic: {{ $terminal->traffic }}</p>
                    <p>Done: {{ $terminal->done }}</p>
                    <p>Created: {{ $terminal->created_at }}</p>
                    <p>Updated: {{ $terminal->updated_at }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection