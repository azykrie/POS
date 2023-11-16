<div>
    <section class="content">
        <div class="container-fluid">
            <div class="row py-4">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header row mb-2">
                            <div class="col-sm-8">
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#addProduct">
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
                                        <th width="5%">NAME PRODUCT</th>
                                        <th width="5%">NAME CATEGORY</th>
                                        <th width="5%">STOCK</th>
                                        <th width="5%">PRICE</th>
                                        <th width="5%">ACTION</th>
                                    </tr>
                                </thead>
                                @foreach ($products as $product)
                                    <tbody>
                                        <tr>
                                            <th scope="row">{{ $loop->iteration }}</th>
                                            <td>{{ $product->product_name }}</td>
                                            <td>{{ $product->category->category_name }}</td>
                                            <td>{{ $product->stock }}</td>
                                            <td>Rp. {{number_format($product->price)}}</td>
                                            <td>
                                                <button wire:click='edit({{ $product->id }})' type="button"
                                                    class="btn btn-warning">EDIT</button>
                                                <button
                                                    wire:confirm="Are you sure you want to delete this {{ $product->name }}"
                                                    wire:click='delete({{ $product->id }})'
                                                    class="btn btn-danger">DELETE</button>
                                            </td>
                                        </tr>
                                    </tbody>
                                @endforeach
                            </table>
                        </div>
                        {{ $products->links() }}
                    </div>
                </div>
            </div>
        </div>
        <div wire:refresh>
            @include('livewire.product.form')
        </div>
    </section>

    <!-- Modal edit -->
    <div wire:ignore.self class="modal fade" id="editProduct" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add product</h5>
                    <button wire:click='resetInput' type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <form wire:submit='update'>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="exampleInputText">Product name</label>
                            <input type="text" wire:model='product_name'
                                class="form-control @error('product_name') is-invalid @enderror" id="exampleInputText"
                                placeholder="Product name">
                            @error('product_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleSelectRounded0">Category</label>
                            <select class="custom-select rounded-0 @error('category_id') is-invalid @enderror"
                                id="exampleSelectRounded0" wire:model='category_id'>
                                <option value="">select category</option>
                                @foreach ($categories as $item)
                                    <option value="{{ $item->id }}">{{ $item->category_name }}</option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleInputText">Stock</label>
                            <input type="number" wire:model='stock'
                                class="form-control @error('stock') is-invalid @enderror" id="exampleInputText"
                                placeholder="stock">
                            @error('stock')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleInputText">Price</label>
                            <input type="number" wire:model='price'
                                class="form-control @error('price') is-invalid @enderror" id="exampleInputText"
                                placeholder="price">
                            @error('price')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="modal-footer">
                            <button wire:click='resetInput' type="button" class="btn btn-secondary"
                                data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>


@push('scripts')
    <script>
        window.addEventListener('close-modal', event => {
            $('#addProduct').modal('hide');
            $('#editProduct').modal('hide'); // Adjusted the modal ID here
        });

        window.addEventListener('show-edit-product-modal', event => {
            $('#editProduct').modal('show'); // Adjusted the modal ID here
        });
    </script>
@endpush
