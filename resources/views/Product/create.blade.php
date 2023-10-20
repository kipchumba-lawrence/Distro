@extends('.layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Product Management'])
    <div class="row mt-4 mx-4">
        <div class="col-12">
            <div class="card mb-4 p-4">
                <div class="card-header pb-0">
                    <div class="d-flex justify-content-between align-items-center">
                        <h6>Products</h6>
                        <div class="ml-auto">
                            <!-- Content to align to the right goes here -->
                            <button class="btn btn-xs btn-secondary" data-bs-toggle="modal"
                                data-bs-target="#create_category">Add Product +</button>
                        </div>
                    </div>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                </div>
            </div>
        </div>
    </div>
@endsection
