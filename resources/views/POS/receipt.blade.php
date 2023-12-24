@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Point of Sale | Receipt'])
    <div class="container-fluid py-4">
        @livewire('receipt', ['orderId' => $orderID])
    </div>
@endsection
