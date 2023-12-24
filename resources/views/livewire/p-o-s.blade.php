<div style="position: relative; overflow: hidden; height: 100vh;">
    <div class="row" style="height: 100%; overflow-y: auto;">
        <style>
            #productsCard {
                background-color: #a74b15a8;
                color: white;
                width: 135px;
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
                    <h3 class="text-capitalize">Point of Sale</h3>
                    <p class="text-sm mb-0">
                        <span class="font-weight-bold text-xs">
                            {{ now()->format('d M Y, h:i A') }}
                        </span>
                    </p>
                </div>
                <div class="card-body">
                    {{-- Work on adding the new search field to filter products based on product name and category --}}
                    <form wire:submit.prevent="productSearch">
                        <div class="d-flex justify-content-between">
                            <input type="text" wire:model='searchTerm' class="form-control"
                                placeholder="search products...">
                            {{-- <input type="submit" class="btn btn-md mx-2 my-1 btn-primary" value="Search"> --}}
                            <button wire:click="productSearch" type="submit"
                                class="btn btn-sm btn-primary mx-2 my-2">Search</button>
                            @if (!empty($searchTerm))
                                <button wire:click="clearSearch" type="submit"
                                    class="btn btn-sm btn-danger mx-2 my-2">Clear</button>
                            @endif

                        </div>
                    </form>
                    <hr>
                    {{-- Start of product card --}}
                    @foreach ($products as $product)
                        <div class="card" id="productsCard" wire:click="addToCart({{ $product->id }})">
                            <span class="text-bold">{{ $product->name }}</span>
                            <span class="text-xs"><i>{{ $product->category->name }}</i></span>
                            <span class="text-xxs"><i>{{ $product->packaging }}</i></span>

                            <span class="text-xxs text-right">{{ $product->quantity }} items</span>
                            <span class="text-sm text-bold ">Ksh. {{ $product->price }}</span>
                        </div>
                        </a>
                    @endforeach
                    {{-- end of product card --}}
                </div>
            </div>
        </div>
        {{-- make this stick while scrolling --}}

        <div class="col-xl-4 col-sm-6 mb-xl-0 mb-4">
            <div class="card pb-2">
                <div class="card-header pb-0 pt-3">
                    <h5 class="text-capitalize"> <i class="ni ni-bag-17"></i> Cart</h5>
                    <hr>
                </div>
                @forelse ($cartItems as $item)
                    <div class="card px-3 py-2 mx-2 my-1" style="background-color: #b49e9258;">
                        <div class="row">
                            <div class="col-6">
                                <span class="text-md"> {{ $item->product->name }}</span>
                            </div>
                            <div class="col-4">
                                <span class="text-sm">Ksh. {{ $item->quantity * $item->product->price }}</span>
                            </div>
                            <div class="col-2">
                                <i class="fa fa-trash" wire:click="removeFromCart({{ $item->id }})"
                                    style="color: red; cursor: pointer;" aria-hidden="true"></i>
                            </div>

                        </div>
                        <div class="row mt-2">
                            <div class="d-flex justify-content-center">
                                <style>
                                    #quantityControl {
                                        border-radius: 50%;
                                        transition: transform 0.3s, scale 0.3s;
                                    }

                                    #quantityControl:hover {
                                        transform: translateY(-5px) scale(1.05);
                                    }
                                </style>
                                {{-- Quantity Control --}}
                                <button class="btn btn-primary btn-xs" id="quantityControl"
                                    wire:click="removeQuantity({{ $item->id }})"><span
                                        class="text-lg">-</span></button>
                                <span class="text-md mx-2">
                                    {{ $item->quantity }}
                                </span>
                                <button class="btn btn-primary btn-xs" id="quantityControl"
                                    wire:click="addQuantity({{ $item->id }})"><span
                                        class="text-lg">+</span></button>

                            </div>
                        </div>
                    </div>
                @empty
                    <span class="my-3 mx-4">
                        No Items in Cart
                    </span>
                @endforelse
            </div>
            @if ($cartItems->isNotEmpty())
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
                            text-align: center;
                            color: #a74b15c7;
                            justify-content: center;
                            border-radius: 15px;
                            align-items: center;
                        }
                    </style>
                    <div>
                        <hr>

                        <form wire:submit.prevent="checkout">
                            {{-- FIX: Finalise this logic later --}}
                            <button class="mt-3 form-control btn btn-warning" type="submit">
                                <span style="color: white">
                                    Print Receipt
                                </span>
                            </button>
                            <button type="button" class="btn btn-outline-danger form-control"
                                wire:click="clearCart">Clear
                                Cart</button>
                        </form>
                    </div>
                </div>
            @endif



        </div>
    </div>
</div>
