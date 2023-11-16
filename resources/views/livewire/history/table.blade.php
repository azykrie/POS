<div>
    <section class="content">
        <div class="container-fluid">
            <div class="row py-4">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header row mb-2">
                            <div class="col-sm-8">
                                <input wire:model.live="search" class="form-control me-2" type="search"
                                placeholder="Search" aria-label="Search">
                            </div>
                        </div>
                        <div class="card-body">
                            <table class="table caption-top">
                                <thead>
                                    <tr>
                                        <th width="5%">NO</th>
                                        <th width="5%">ORDER NO</th>
                                        <th width="5%">CASHIER</th>
                                        <th width="5%">CREATED AT</th>
                                        <th width="5%">ACTION</th>
                                    </tr>
                                </thead>
                                @foreach ($orders as $order)
                                    <tbody>
                                        <tr>
                                            <th scope="row">{{ $loop->iteration }}</th>
                                            <td>{{ $order->order_no}}</td>
                                            <td>{{ $order->cashier_name}}</td>
                                            <td>{{ $order->created_at}}</td>
                                            <td>
                                                <button wire:click='show({{ $order->id }})' type="button"
                                                    class="btn btn-warning">SHOW</button>
                                            </td>
                                        </tr>
                                    </tbody>
                                @endforeach
                            </table>
                        </div>
                        {{ $orders->links() }}
                    </div>
                </div>
            </div>
        </div>
    </section>
    @include('livewire.history.show')
</div>

@push('scripts')
    <script>
        window.addEventListener('close-modal', event => {
            $('#showOrder').modal('hide'); // Adjusted the modal ID here
        });

        window.addEventListener('show-order-modal', event => {
            $('#showOrder').modal('show'); // Adjusted the modal ID here
        });
    </script>
@endpush
