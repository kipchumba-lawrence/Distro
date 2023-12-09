@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Product Create'])
    <div class="row mt-4 mx-4">
        <div class="col-12">
            <div class="card mb-4 p-4">
                <div class="card-header pb-0">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4>Add New Category</h4>
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
                    <form action="{{ route('category.store') }}" method="POST">
                        @csrf
                        <span class="text-md">Enter name of category to create.</span>
                        <input type="text" name="name" placeholder="Category name" class="form-control">
                        <div class="d-flex justify-content-end my-3">
                            <button class="btn btn-md btn-primary">
                                Save Category
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
