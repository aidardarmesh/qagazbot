@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-default">
                <div class="panel-heading">New client</div>

                <div class="panel-body">
                    <form method="POST" action="/clients/addPost">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <p>
                                <label for="id">Id*</label>
                                <input id="id" type="text" name="id" class="form-control" required="on" value="86234301" placeholder="86234301">
                            </p>
                            <p>
                                <label for="first">First*</label>
                                <input id="first" type="text" name="first" class="form-control" required="on" value="Aidar" placeholder="Aidar">
                            </p>
                            <p>
                                <label for="last">Last*</label>
                                <input id="last" type="text" name="last" class="form-control" required="on" value="Darmesh" placeholder="Darmesh">
                            </p>
                            <p>
                                <label for="username">Username*</label>
                                <input id="username" type="text" name="username" class="form-control" required="on" placeholder="vk_aidario" value="vk_aidario">
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
