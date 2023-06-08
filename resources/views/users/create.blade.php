@extends('layouts.app')

@section('content_header')
<h1>User</h1>
@stop

@section('content')

<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Add New User</h3>
    </div>
    <div class="card-body">
        @include("alerts.error")

        {{ Form::open(['route' => 'users.store', 'method' => 'post','id' => 'create-user','class'=>"form-horizontal",'enctype'=>"multipart/form-data"]) }}

        @include("users.form")


        <div class="form-group row">
            <label class="col-sm-2 col-form-label"></label>
            <div class="col-sm-8">
                {{ Form::submit('Save', ['class' => 'btn btn-lg btn-primary']) }}

            </div>
        </div>
        {{ Form::close() }}
    </div>
</div>

@stop