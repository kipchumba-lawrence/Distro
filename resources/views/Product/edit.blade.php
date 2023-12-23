@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Product Create'])
    <div class="row mt-4 mx-4">
        <div class="col-12">
            <div class="card mb-4 p-4">
                <div class="card-header pb-0">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4>Edit Existing Product</h4>
                        <div class="ml-auto">
                            <!-- Content to align to the right goes here -->
                            <a href="{{ route('inventory.create') }}"><button class="btn btn-md btn-primary">Update
                                    Product</button></a>
                        </div>
                    </div>
                    <hr>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    @if (session()->has('message'))
                        <div class="alert alert-success alert-dismissible fade show text-white" role="alert">
                            <span class="alert-icon"><i class="ni ni-like-2"></i></span>
                            <span class="alert-text"><strong>Success!</strong> {{ session('message') }}</span>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    {{-- tart form --}}
                    <form action="{{ route('product.update', ['product' => $product]) }}" method="post">
                        @method('PUT')
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <label for="name">Name</label>
                                <input type="text" name="name" value="{{ $product->name }}" id="name" class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label for="category">Category</label>
                                <select name="category_id" id="" class="form-control selection" >
                                    <option value="{{ $product->category->id }}">{{ $product->category->name }}</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-12">
                                <label for="description">Description</label>
                                <textarea name="description" placeholder="Enter product description..." class="form-control" id=""
                                    cols="10" rows="3">{{ $product->description }}</textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <label for="packaging">Packaging</label>
                                <select name="packaging" id="" class="form-control" required>
                                    <option value="{{ $product->packaging }}">{{ $product->packaging }}</option>
                                    @foreach ($packaging as $pack)
                                        <option value="{{ $pack->packaging }}">{{ $pack->packaging }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label for="price">Price</label>
                                <input type="number" name="price" id="price" value="{{ $product->price }}" required class="form-control">
                            </div>
                            <div class="col-md-4">
                                <label for="quantity">Quantity</label>
                                <input type="number" name="quantity" value="{{ $product->quantity }}" id="quantity" disabled required class="form-control">
                            </div>
                        </div>
                        <div class="d-flex justify-content-end my-3">
                            <button class="btn btn-primary btn-md" type="submit">Save Product</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
