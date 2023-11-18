@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])
@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Record Breakage'])
    <div class="row mt-4 mx-4">
        <div class="col-12">
            <div class="card mb-4 p-4">
                <div class="card-header pb-0">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4>Record Breakage</h4>
                    </div>
                    <hr>
                </div>
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Fuga in aperiam nemo alias deleniti quod, facere odio quis fugit vitae accusamus nam nobis libero repellat? Facere in eaque totam dignissimos!
                {{-- Work on the breakages index page --}}
            </div>
        </div>
    </div>
@endsection
