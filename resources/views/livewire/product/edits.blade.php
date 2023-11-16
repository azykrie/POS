<!-- Modal -->
<div wire:ignore.self class="modal fade" id="editProduct" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add product</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
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
                        <input type="number" wire:model='stock' class="form-control @error('stock') is-invalid @enderror"
                            id="exampleInputText" placeholder="stock">
                        @error('stock')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleInputText">Price</label>
                        <input type="number" wire:model='price' class="form-control @error('price') is-invalid @enderror"
                            id="exampleInputText" placeholder="price">
                        @error('price')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
            </form>
        </div>
    </div>
</div>
