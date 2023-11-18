<div>
    <section class="content">
        <div class="container-fluid py-3">
            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Order Product</h3>
                        </div>

                        <div class="card-body">
                            <div class="row">
                                <div class="col-8">
                                    <div class="form-group">
                                        <form wire:submit.prevent='submit'>
                                            <span>Product Nmae</span>
                                            <select class="form-control @error('product_id') is-invalid @enderror"
                                                wire:model='product_id' required>
                                                <option>Select Product</option>
                                                @foreach ($products as $item)
                                                    <option value="{{ $item->id }}">{{ $item->product_name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('product_id')
                                                <div id="validationServer03Feedback" class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                    </div>
                                </div>
                                <div class="col-4">
                                    <button style="margin-top: 24px;" type="submit" class="btn btn-primary">Add
                                        Product</button>
                                </div>
                            </div>
                            </form>
                            @if (session()->has('message'))
                                <div class="alert alert-success">
                                    {{ session('message') }}
                                </div>
                            @endif
                            @if (session()->has('stock'))
                            <div class="alert alert-danger">
                                {{ session('stock') }}
                            </div>
                        @endif
                        </div>


                        <div class="card-body">
                            <table class="table tcaption-top">
                                <thead>
                                    <tr>
                                        <th width="25%">Product Name</th>
                                        <th width="25%">Quantity</th>
                                        <th>Price</th>
                                        <th>Total</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                @foreach ($transactions as $transaction)
                                    <tbody>
                                        <tr>
                                            <td>{{ $transaction->product->product_name }}</td>
                                            <td>
                                                <div>
                                                    @if ($transaction->quantity > 1)
                                                        <span class="btn btn-danger btn-sm"
                                                            wire:click="decrement({{ $transaction->id }})">-</span>
                                                    @endif
                                                    <input type="text" class="form-control qty"
                                                        value="{{ $transaction->quantity }}" readonly>
                                                    <span class="btn btn-success btn-sm"
                                                        wire:click="increment({{ $transaction->id }})">+</span>
                                                </div>
                                            </td>
                                            <td>Rp. {{ number_format($transaction->product->price) }}</td>
                                            <td>Rp.
                                                {{ number_format($transaction->product->price * $transaction->quantity) }}
                                            </td>
                                            <td><button type="submit" wire:click="delete({{ $transaction->id }})"
                                                    class="btn btn-danger">Delete</button></td>
                                        </tr>
                                    </tbody>
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Payment</h3>
                        </div>

                        <div class="card-body p-0">
                            <table id="example2" class="table table-bordered table-striped">
                                <div class="card-body">
                                    <label>Total Transaction</label>
                                    <input value="Rp. {{ number_format($transactions->sum('total')) }}" type="text"
                                        class="form-control" disabled>
                                    <label>Pay</label>
                                    <input wire:model='pay' type="number" wire:model.live='pay' class="form-control">
                                    <label>Change</label>
                                    @php
                                        $formattedPay = intval($pay); // Konversi $pay menjadi integer
                                        $formattedTotal = intval($transactions->sum('total')); // Konversi total transaksi menjadi integer
                                        $kemabalian = $formattedPay - $formattedTotal;
                                    @endphp

                                    <input value="Rp. {{ number_format($kemabalian) }}" type="text"
                                        class="form-control" disabled>
                                </div>
                                <div class="card-body">
                                    @if (!empty($transaction))
                                        <a href="{{ url('transaction/invoice') }}" class="btn btn-warning">Print</a>
                                    @endif
                                    <button wire:click='save' type="submit" class="btn btn-info">Pay</button>
                                </div>
                            </table>
                        </div>

                    </div>

                </div>

            </div>
        </div>
        <style>
            .qty {
                width: 40%;
                display: inline;
            }
        </style>
</div>
