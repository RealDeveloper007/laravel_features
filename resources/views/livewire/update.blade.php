<div class="card">
    <div class="card-body">
        <form>
            <div class="form-group mb-3">
                <label for="name">Name:</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="Enter Name" wire:model="name">
                @error('name')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group mb-3">
                <label for="email">Email:</label>
                <input type="text" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="Enter Email" wire:model="email">
                @error('email')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group mb-3">
                <label for="password">Password:</label>
                <input type="password" class="form-control" id="password" placeholder="Enter Password" wire:model="password">

            </div>

            <div class="d-grid gap-2">
                <button wire:click.prevent="updateUser()" class="btn btn-success btn-block">Update</button>
            </div>
        </form>
    </div>
</div>