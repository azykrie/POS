<div>
    <section class="content">
        <div class="container-fluid">
            <div class="row py-4">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header row mb-2">
                            <div class="col-sm-8">
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#addUser">
                                    + Create
                                </button>
                            </div>
                            <div class="col-sm-3 float-sm-right">
                                <input wire:model.live="search" class="form-control me-2" type="search"
                                    placeholder="Search" aria-label="Search">
                            </div>
                        </div>
                        <div class="card-body">
                            @if (session('success'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('success') }}
                                </div>
                            @endif
                            @if (session('message'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('message') }}
                                </div>
                            @endif
                            <table class="table caption-top">
                                <thead>
                                    <tr>
                                        <th width="5%">NO</th>
                                        <th width="5%">NAME</th>
                                        <th width="5%">EMAIL</th>
                                        <th width="5%">ROLE</th>
                                        <th width="5%">ACTION</th>
                                    </tr>
                                </thead>
                                @foreach ($users as $user)
                                    <tbody>
                                        <tr>
                                            <th scope="row">{{ $loop->iteration }}</th>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ $user->role }}</td>
                                            <td>
                                                <button wire:click='edit({{ $user->id }})' type="button"
                                                    class="btn btn-warning">EDIT</button>
                                                <button
                                                    wire:confirm="Are you sure you want to delete this {{ $user->name }}"
                                                    wire:click='delete({{ $user->id }})'
                                                    class="btn btn-danger">DELETE</button>
                                            </td>
                                        </tr>
                                    </tbody>
                                @endforeach
                            </table>
                        </div>
                        {{ $users->links() }}
                    </div>
                </div>
            </div>
        </div>
    </section>
    @include('livewire.user.form')
    @include('livewire.user.edit')
</div>

@push('scripts')
    <script>
        window.addEventListener('close-modal', event => {
            $('#addUser').modal('hide');
            $('#editUser').modal('hide');
        });
        window.addEventListener('show-edit-user-modal', event => {
            $('#editUser').modal('show');
        });
    </script>
@endpush
