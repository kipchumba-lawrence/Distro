<div class="row mt-4 mx-2">
    <div class="card mb-4 p-4">
        <div class="card-header pb-0">
            <div class="d-flex justify-content-between align-items-center">
                <h4>Pending Payments</h4>
            </div>
        </div>
        <hr>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-6">
                    <h5>Receipt Preview</h5>
                    <div style="height: auto; width: 100%; border: 1px solid rgba(149, 100, 15, 0.526); border-radius: 15px"
                        class="p-1 m-1 text-xxs table-responsive">
                        {{-- Start of the receipt body --}}
                        <span class="text-lg">Distro System</span>
                        <br>
                        <span>{{ date('Y-m-d H:i:s') }}</span>
                        <table class="table table-sm">
                            <thead class="text-right">
                                <tr>
                                    <th class="text-leftt">
                                        Product
                                    </th>
                                    <th class="text-left">
                                        Price
                                    </th>
                                    <th class="text-leftt">
                                        Quantity
                                    </th>
                                    <th>
                                        <span class="text-left">
                                            Subtotal
                                        </span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($order as $product)
                                    <tr>
                                        <td>
                                            <p class="text-xxs  font-weight-bold mb-0">
                                                {{ $product->product->name }}
                                            </p>
                                        </td>
                                        <td>
                                            <p class="text-xxs font-weight-bold mb-0">
                                                {{ $product->amount }}
                                            </p>
                                        </td>
                                        <td>
                                            <p class="text-xxs font-weight-bold mb-0">
                                                {{ $product->quantity }}
                                            </p>
                                        </td>
                                        <td>
                                            <p class="text-xxs font-weight-bold mb-0">
                                                {{ $product->quantity * $product->amount }}
                                            </p>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <hr>
                        <table class="table table-sm">
                            <tbody>
                                <tr>
                                    <td>
                                        <p class="text-sm font-weight-bold mb-0">
                                            Total
                                        </p>
                                    </td>
                                    <td>
                                        <p class="text-sm font-weight-bold mb-0">
                                            Ksh. {{ $total }}
                                        </p>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-lg-6">

                        <label for="">Payment Method</label>
                        <select name="payment" id="" wire:model.lazy="paymentOption" class="form-control">
                            <option value="Cash">Cash</option>
                            <option value="Mpesa">Mpesa</option>
                        </select>
                        @if ($paymentOption == 'Mpesa')
                            <label for="">Phone Number</label>
                            <input type="number" maxlength="12" name="phone" id="" class="form-control" placeholder="2547" required>
                            
                        @endif
                    <button class="btn btn-primary btn-lg form-control mt-4" wire:click="Test">Pay</button>
                    {{-- TODO: Create the logic for regulating the order system to prevent duplicate orders --}}
                </div>
            </div>
            <div class="my-3">
                <span class="text-sm">
                    Thank you for your order.
                </span>
            </div>
            <div class="d-flex align-items-end">
                <button type="button" class="btn btn-danger btn-sm m-1">Delete Order</button>
                <button type="button" class="btn btn-success btn-sm m-1">Confirm Order</button>
                <button type="button" class="btn btn-primary btn-sm m-1">Back to POS</button>
            </div>

        </div>

    </div>

</div>
