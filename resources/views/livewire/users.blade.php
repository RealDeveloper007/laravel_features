<div>
    <div class="col-md-8 mb-2">
        @if(session()->has('success'))
        <div class="alert alert-success" role="alert">
            {{ session()->get('success') }}
        </div>
        @endif
        @if(session()->has('error'))
        <div class="alert alert-danger" role="alert">
            {{ session()->get('error') }}
        </div>
        @endif
        @if($addUser)
        @include('livewire.create')
        @endif
        @if($updateUser)
        @include('livewire.update')
        @endif
    </div>
    @if(!$addUser && !$updateUser)

    <div class="col-md-8">
        <div class="card">
            <div class="card-body">
                <button wire:click="addUser()" class="btn btn-primary btn-sm float-right">Add New User</button>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (count($users) > 0)
                            @foreach ($users as $user)
                            <tr>
                                <td>
                                    {{$user->name}}
                                </td>
                                <td>
                                    {{$user->email}}
                                </td>
                                <td>
                                    <button wire:click="editUser({{$user->id}})" class="btn btn-primary btn-sm">Edit</button>
                                    <button onclick="deleteUser({{$user->id}})" class="btn btn-danger btn-sm">Delete</button>
                                </td>
                            </tr>
                            @endforeach
                            @else
                            <tr>
                                <td colspan="3" align="center">
                                    No Users Found.
                                </td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
    @endif

    <script>
        function deleteUser(id) {
            if (confirm("Are you sure to delete this record?"))
                window.livewire.emit('deleteUserListner', id);
        }
    </script>
</div>