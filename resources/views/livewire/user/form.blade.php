<!-- Modal -->
<div wire:ignore.self class="modal fade" id="addUser" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add user</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form wire:submit='create'>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="exampleInputText">Name</label>
                        <input type="text" wire:model='name' class="form-control @error('name') is-invalid @enderror"
                            id="exampleInputText" placeholder="Masukan Nama">
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleInputText">Email</label>
                        <input type="email" wire:model='email' class="form-control @error('email') is-invalid @enderror"
                            id="exampleInputText" placeholder="Masukan Email">
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleInputText">Password</label>
                        <input type="password" wire:model='password'
                            class="form-control @error('password') is-invalid @enderror" id="exampleInputText"
                            placeholder="Masukan Password">
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleSelectRounded0">Role</label>
                        <select class="custom-select rounded-0 @error('role') is-invalid @enderror"
                            id="exampleSelectRounded0" wire:model='role'>
                            <option value="">Select Role</option>
                            <option value="admin">Admin</option>
                            <option value="cashier">Cashier</option>
                        </select>
                        @error('role')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
