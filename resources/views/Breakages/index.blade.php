@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])
@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Record Breakage'])
    <div class="row mt-4 mx-4">
        <div class="col-12">
            <div class="card mb-4 p-4">
                <div class="card-header pb-0">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4>Recorded Breakages</h4>
                        <a href="{{ route('breakages.create') }}">
                            <button class="btn btn-primary">Record Breakage</button>
                        </a>
                    </div>
                    <hr>
                </div>
                <style>
                    #break-card {
                        width: 250px;
                        float: left;
                        cursor: pointer;
                        transition: transform 0.3s, scale 0.3s;
                    }

                    #break-card:hover {
                        transform: translateY(-5px) scale(1.05);
                        /* transition: transform 0.3s ease-in-out; */
                    }
                </style>
                <div class="card-body">
                    {{-- card for breakages --}}
                    @foreach ($breakages as $breakage)
                        <div class="card my-1 mx-2" id="break-card">
                            <div class="card-body pt-2">
                                <span
                                    class="text-gradient text-primary text-uppercase text-xs font-weight-bold my-2">Item</span>
                                <a href="#" class="card-title h5 d-block text-darker">
                                    {{ $breakage->product->name }}
                                </a>
                                <span class="text-gradient text-primary text-xs font-weight-bold my-2">Person
                                    Responsible</span>
                                <span class="d-block">
                                    {{ $breakage->user->firstname }} {{ $breakage->user->lastname }}
                                </span>

                                <span class="text-gradient text-primary text-xs font-weight-bold my-2">Quantity</span>
                                <span class="d-block">
                                    {{ $breakage->quantity }}
                                </span>
                                <span class="text-gradient text-primary text-xs font-weight-bold my-2">
                                    Reason</span>

                                <p class="card-description text-sm mb-1">
                                    {{ $breakage->reason }}
                                </p>
                                <div class="author align-items-center">
                                    <img src="{{ asset('img/kit/pro/team-2.jpg') }}" alt="..." class="avatar shadow">
                                    <div class="name ps-3">
                                        <span>Date of Breakage</span>
                                        <div class="stats">
                                            <small>{{ \Carbon\Carbon::parse($breakage->date_of_breakage)->format('jS F Y h:ia') }}</small>
                                        </div>
                                    </div>
                                </div>
                                <form action="{{ route('breakages.cleared', ['id' => $breakage->id]) }}" method="post">
                                    @csrf
                                    <div class="pt-3 text-center">
                                        <button type="submit" class="btn btn-default btn-sm">
                                            Approve
                                        </button>
                                    </div>
                                </form>

                            </div>
                        </div>
                    @endforeach
                    {{-- End of card --}}
                </div>
                <div class="d-flex justify-content-end">
                    <a href="{{ route('approvedBreakages') }}" class="">
                        <button class="btn btn-primary">
                            View Approved Breakages
                        </button></a>
                </div>
            </div>
        </div>
    </div>
@endsection
