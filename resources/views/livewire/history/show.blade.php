<!-- Modal -->
<div wire:ignore.self class="modal fade" id="showOrder" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">TRANSACTION DETAIL</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <table class="table caption-top">
                <thead>
                    <tr>
                        <th width="5%">NO</th>
                        <th width="5%">PRODUCT</th>
                        <th width="5%">QUANTITY</th>
                        <th width="5%">TOTAL</th>
                    </tr>
                </thead>
                @if ($transactionDetails && count($transactionDetails) > 0)
                    @foreach ($transactionDetails as $item)
                        <tbody>
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{ $item->product->product_name }}</td>
                                <td>{{ $item->quantity }}</td>
                                <td>{{ $item->total }}</td>
                            </tr>
                        </tbody>
                    @endforeach
                @endif
            </table>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Print</button>
            </div>
        </div>
    </div>
</div>
