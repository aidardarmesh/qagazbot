@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Terminals <a href="/terminals/addGet" class="btn btn-success">add</a></div>

                <div class="panel-body">
                    @if( sizeof($terminals) === 0)
                        <p>You don't have terminals yet!</p>
                    @else
                        <table class="table table-striped table-bordered">
                            <tr>
                                <th>id</th>
                                <th>addr</th>
                                <th>traffic</th>
                                <th>pages</th>
                                <th>toner</th>
                                <th>done</th>
                                <th>actions</th>
                            </tr>
                            @foreach($terminals as $terminal)
                                <tr>
                                    <td>
                                        <a href="/terminals/{{ $terminal->id }}">{{ $terminal->id }}</a>
                                    </td>
                                    <td>{{ $terminal->addr }}</td>
                                    <td>{{ $terminal->traffic }}</td>
                                    <td>{{ $terminal->pages }}</td>
                                    <td>{{ $terminal->toner }}</td>
                                    <td>{{ $terminal->done }}</td>
                                    <td>
                                        <a href="/terminals/{{ $terminal->id }}/editGet" class="btn btn-info">edit</a>
                                        <a href="/terminals/{{ $terminal->id }}/delete" class="btn btn-danger">del</a>
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
