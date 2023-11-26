@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])
@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Record Breakage'])
    <div class="row mt-4 mx-4">
        <div class="col-12">
            <div class="card mb-4 p-4">
                <div class="card-header pb-0">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4>Customers</h4>
                        <a href="{{ route('breakages.create') }}">
                            <button class="btn btn-primary">Create Customer</button>
                        </a>
                    </div>
                    <hr>
                </div>

                <div class="card-body">
                    <form action="{{ route('customer.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <label for="name">Name</label>
                                <input type="text" name="name" id="name" class="form-control"
                                    placeholder="Enter customer name">
                            </div>
                            <div class="col-md-6">
                                <label for="phone">Phone</label>
                                <input type="tel" name="phone_number" class="form-control" id="">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label for="email">Email</label>
                                <input type="email" name="email" class="form-control" id=""
                                    placeholder="customer@email.com">
                            </div>
                            <div class="col-md-6">
                                <label for="Address">Address</label>
                                <input type="text" name="address" class="form-control"
                                    placeholder="Enter customer address">
                            </div>
                        </div>
                        <div class="mt-3 d-flex justify-content-center ">
                            <button class="btn btn-primary" type="submit">
                                <span>
                                    <i class="fas fa-user-plus"></i></span> Create
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
