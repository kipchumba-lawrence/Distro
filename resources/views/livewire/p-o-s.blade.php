<div class="row">
    <style>
        #productsCard {
            background-color: #a74b157f;
            color: white;
            width: 119px;
            padding: 10px !important;
            margin: 5px;
            float: left;
            cursor: pointer;
            transition: transform 0.3s, scale 0.3s;
            /* Adding transition for smooth animation */
        }

        #productsCard:hover {
            transform: translateY(-5px) scale(1.05);
            /* Applying the transformation and scaling effect on hover */
        }
    </style>
    <div class="col-xl-8 col-sm-6 mb-xl-0 mb-4">
        <div class="card">
            <div class="card-header pb-0 pt-3">
                <h5 class="text-capitalize">Point of Sale</h5>
                <p class="text-sm mb-0">
                    <span class="font-weight-bold">
                        {{-- Add Time and date here --}}
                    </span>
                </p>
            </div>
            <div class="card-body">
                <div class="my-2">
                    {{-- Search field --}}
                    {{-- Work on adding the new search field to filter products based on product name and category --}}
                    <form action="">
                        {{ csrf_field() }}
                        <input type="text" class="form-control" name="search-field" placeholder="search products...">
                    </form>
                </div>
                {{-- Start of product card --}}
                @foreach ($products as $product)
                    <div class="card" id="productsCard" wire:click="addToCart({{ $product->id }})">
                        <span class="text-bold">{{ $product->name }}</span>
                        <span class="text-xxs"><i>{{ $product->category->name }}</i></span>
                        <span class="text-xxs"><i>{{ $product->packaging }}</i></span>
                        <span class="text-xs text-right">{{ $product->quantity }}</span>
                        <span class="text-sm text-bold text-center">Ksh. {{ $product->price }}</span>
                    </div>
                    </a>
                @endforeach
                {{-- end of product card --}}
            </div>
        </div>
    </div>
    <div class="col-xl-4 col-sm-6 mb-xl-0 mb-4">
        <div class="card pb-2">
            <div class="card-header pb-0 pt-3">
                <h5 class="text-capitalize"> <i class="ni ni-bag-17"></i> Cart</h5>
                <hr>
            </div>
            @forelse ($cartItems as $item)
                <div class="card px-3 py-2 mx-2 my-1">
                    <div class="row">
                        <div class="col-6">
                            <span class="text-xs"> {{ $item->product->name }}</span>
                        </div>
                        <div class="col-4">
                            {{-- <form action="" method="POST">
                                <input type="number" value="{{ $item->quantity }}" onchange="submit" name="quantity" class="form-control"
                                    size="10">
                            </form> --}}

                            {{-- <form wire:submit.prevent="update('{{ $item->id }}')">
                                <input type="number" value="{{ $item->quantity }}" name="quantity" class="form-control" size="10">
                            </form>
                             --}}
                            <span class="text-sm">Ksh. {{ $item->product->price }}</span>
                        </div>
                        <div class="col-2">
                            <i class="fa fa-trash" wire:click="removeFromCart({{ $item->id }})"
                                style="color: red; cursor: pointer;" aria-hidden="true"></i>
                        </div>

                    </div>
                </div>
            @empty
                <span class="my-3 mx-4">
                    No Items in Cart
                </span>
            @endforelse
        </div>
        @if ($cartItems->isEmpty())
            <p>Your cart is currently empty.</p>
        @else
            <div class="card my-2 p-3">
                <div class="row">
                    <div class="d-flex justify-content-between">
                        <div class="text-sm text-bold">Subtotal</div>
                        <div class="text-sm">Ksh. {{ $cartTotal }}</div>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="d-flex justify-content-between">
                        <div class="text-sm text-bold">Tax</div>
                        <div class="text-sm">Ksh. {{ $cartTotal * 0.09 }}</div>
                    </div>
                </div>
                <hr>
                <div class="row mt-2">
                    <div class="d-flex justify-content-between">
                        <div class="text-md text-bold">Total</div>
                        <div class="text-md text-bold">Ksh. {{ $cartTotal + $cartTotal * 0.09 }}</div>
                    </div>
                </div>
                <style>
                    #menu-block {
                        width: 120px;
                        height: 50px;
                        display: flex;
                        border: solid;
                        border-color: #a74b157f;
                        /* background-color: #a74b157f; */
                        text-align: center;
                        color: #a74b15c7;
                        justify-content: center;
                        border-radius: 15px;
                        align-items: center;
                    }

                    /*
                    #submit-button {
                        width: 100%;
                        height: 50px;
                        display: flex;
                        border: solid;
                        border-color: #a74b157f;
                        background-color: #a74b15a8;
                        text-align: center;
                        margin-top: 10px;
                        color: white;
                        justify-content: center;
                        border-radius: 15px;
                        align-items: center;
                    } */
                </style>
                <div>
                    <hr>

                    <form>
                        <div class="row">
                            <input type="text" class="form-control" wire:model.lazy="customer_search"
                                name="search-field" placeholder="search customer...">
                        </div>
                        <table class="table table-striped table-sm">
                            @foreach ($customer as $item)
                                <tr>
                                    <td>
                                        <input class="form-check-input" type="radio" wire:click="selectCustomer({{ $item->id }})"
                                            value="{{ $item->id }}">
                                        <span class="text-sm">{{ $item->name }}</span>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                        {{-- FIX: Finalise this logic later --}}
                        @if ($cartTotal >= 5.0)
                            @if (!is_null($selectedCustomer))
                                <button class="mt-3 form-control btn btn-warning" wire:click="checkout">
                                    <span style="color: white">
                                        All conditions met
                                    </span>
                                </button>
                            @else
                                <button class="mt-3 form-control btn btn-warning" disabled wire:click="checkout">
                                    <span style="color: white">
                                        No customer
                                    </span>
                                </button>
                            @endif
                        @else
                            <button class="mt-3 form-control btn btn-warning" wire:click="checkout">
                                <span style="color: white">
                                    Checkout 👍🏾
                                </span>
                            </button>
                        @endif


                    </form>
                </div>
            </div>
        @endif



    </div>
</div>
