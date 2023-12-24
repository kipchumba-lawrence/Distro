@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])
@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Customers'])
    <div class="row mt-4 mx-4">
        <div class="col-12">
            <div class="card mb-4 p-4">
                <div class="card-header pb-0">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4>Customers</h4>
                        <a href="{{ route('customer.create') }}">
                            <button class="btn btn-primary">Create Customer</button>
                        </a>
                    </div>
                    <hr>
                </div>
                <style>
                    #customer-card {
                        width: auto;
                        float: left;
                        cursor: pointer;
                        transition: transform 0.3s, scale 0.3s;
                        border: solid 1px #ad7a0b;
                        /* color: white; */
                        padding: 6px;
                        margin: 10px;
                        border-radius: 20px;
                    }

                    #customer-card:hover {
                        transform: translateY(-5px) scale(1.05);
                        /* transition: transform 0.3s ease-in-out; */
                    }
                </style>
                <div class="card-body">
                    {{-- card for customers --}}
                    @foreach ($customers as $customer)
                        <a href="{{ route('customer.show', $customer->id) }}">
                            <div id="customer-card" class="row">
                                <div class="col-lg-4 col-md-4">
                                    {!! Avatar::create($customer->name)->toSvg() !!}
                                </div>
                                <div class="col-lg-8 col-md-8">
                                    <span>{{ $customer->name }}</span>
                                    <br>
                                    <span class="text-xs text-right">{{ $customer->phone_number }}</span>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
