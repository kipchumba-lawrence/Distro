@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])
@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Record Breakage'])
    <div class="row mt-4 mx-4">
        <div class="col-12">
            <div class="card mb-4 p-4">
                <div class="card-header pb-0">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4>
                            Inventory Management
                        </h4>

                        <a href="{{ route('breakages.create') }}">
                            <button class="btn btn-primary">Add Product Stock</button>
                        </a>
                    </div>
                    <hr>
                </div>
                <div class="card-body">
                </div>

            </div>
        </div>
    </div>
@endsection
