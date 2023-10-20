@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Point of Sale'])
    <div class="container-fluid py-4">
        <livewire:pos />
    </div>
@endsection
