@extends('layouts.app')

@section('content_header')
<h1>Users</h1>
@stop

@section('content')
<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">List of Users</h3>
    </div>
    <div class="card-body">
        @include("alerts.success")
        @include("alerts.error")

        <a href="{{route('users.create')}}" class="btn btn-primary btn-sm">+ Add User</a>
        <br><br>
        <div class="table-responsive dt-responsive">
            <table id="dom-jqry" class="table table-striped table-bordered nowrap">
                <thead>
                    <tr>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->status==1 ? 'Active' : 'In-Active' }}</td>
                        <td style="display: flex;height: 65px;">

                            <a href="{{route('users.edit',$user->id)}}" class="btn btn-warning btn-mini" style="margin-left:10px">Edit</a>

                            <!-- Delete should be a button -->
                            {!! Form::open(array(
                            'method' => 'DELETE',
                            'route' => ['users.destroy', $user->id],
                            'onsubmit' => "return confirm('Are you sure you want to delete?')",
                            ))
                            !!}
                            {!! Form::submit('Delete',['class'=>"btn btn-danger btn-mini"]) !!}
                            {!! Form::close() !!}
                            <!-- End Delete button -->

                        </td>
                    </tr>
                    @empty

                    @endforelse

                </tbody>

            </table>

            <span>{{$users->links()}}</span>

        </div>
    </div>

</div>
</div>

@stop

<style>
    form input.btn.btn-danger.btn-mini {
        margin-left: 10px;
    }
</style>