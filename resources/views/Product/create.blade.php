@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Product Create'])
    <div class="row mt-4 mx-4">
        <div class="col-12">
            <div class="card mb-4 p-4">
                <div class="card-header pb-0">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4>Update Stock</h4>
                        <div class="ml-auto">
                            <!-- Content to align to the right goes here -->
                            <a href="{{ route('product.create') }}"><button class="btn btn-md btn-primary"
                                    data-bs-toggle="modal">Add New Stock</button></a>
                        </div>
                    </div>
                    <hr>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <form action="">
                        <label for="">Product Name:</label>
                        <select name="" id="">
                            
                        </select>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
