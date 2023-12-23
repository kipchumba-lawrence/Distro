@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])
@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Record Breakage'])
    <div class="row mt-4 mx-4">
        <div class="col-12">
            <div class="card mb-4 p-4">
                <div class="card-header pb-0">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4>Add Product Stock</h4>

                        <a href="{{ route('inventory.create') }}">
                            <button class="btn btn-primary">Create Product</button>
                        </a>
                    </div>
                    <span class="text-xs">This is not for creating new products to the system.</span>

                    @if (session()->has('message'))
                        <div class="alert alert-success alert-dismissible fade show text-white" role="alert">
                            <span class="alert-icon"><i class="ni ni-like-2"></i></span>
                            <span class="alert-text"><strong>Success!</strong> {{ session('message') }}</span>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    <hr>
                </div>
                <div class="card-body">
                    <form action="{{ route('inventory.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <label for="name">Product</label>
                                <select name="product" id="" class="form-control">
                                    @foreach ($products as $product)
                                        <option value="{{ $product->id }}">{{ $product->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="quantity">Quantity</label>
                                <input type="number" name="quantity" class="form-control" id="">
                            </div>
                        </div>
                        <div class="mt-3 d-flex justify-content-center ">
                            <button class="btn btn-primary" type="submit">
                                Update Stock
                            </button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
@endsection
