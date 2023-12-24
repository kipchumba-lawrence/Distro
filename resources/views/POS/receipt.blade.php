@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])
@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Product Create'])
    <div class="row mt-4 mx-4">
        <div class="col-12">
            <div class="card mb-4 p-4">
                <div class="card-header pb-0">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4>Order Checkout</h4>
                    </div>
                </div>
                <hr>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6 col-md-6">
                            <h5>Receipt Preview</h5>
                            <div style="height: auto; border: 1px solid rgba(149, 100, 15, 0.526); border-radius: 15px"
                                class="p-1 m-2 text-xxs">
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
                                                    {{ $total }}
                                                </p>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <form action=""></form>
                            {{-- TODO: Create the logic for regulating the order system to prevent duplicate orders --}}
                        </div>
                    </div>
                    <div class="my-3">
                        <span class="text-sm">
                            Thank you for your order.
                        </span>
                    </div>
                </div>

            </div>
        </div>

    </div>
@endsection
