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
                <div class="card-body mx-2 pt-0 pb-2">
                    <form method="POST" action="{{ route('breakages.store') }}" class="my-4">
                        @csrf
                        <!-- Product ID (You may use a dropdown or input based on your UI/UX) -->
                        <div class="mb-3">
                            <label for="product_id" class="form-label">Product:</label>
                            {{-- <input type="text" name="product_id" id="product_id" class="form-control" required> --}}
                            <select name="product_id" id="" class="form-control">
                                @foreach ($products as $product)
                                    <option value="{{ $product->id }}"> {{ $product->name }} --
                                        {{ $product->category->name }}</option>
                                @endforeach
                                <option value=""></option>
                            </select>
                        </div>

                        <!-- User ID (You may use a dropdown or input based on your UI/UX) -->
                        <div class="mb-3">
                            <label for="user_id" class="form-label">User:</label>
                            <select name="user_id" id="user_id" class="form-select" required>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->fisrtname }} {{ $user->lastname }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Quantity -->
                        <div class="mb-3">
                            <label for="quantity" class="form-label">Quantity:</label>
                            <input type="number" name="quantity" id="quantity" class="form-control" required>
                        </div>

                        <!-- Date of Breakage -->
                        <div class="mb-3">
                            <label for="date_of_breakage" class="form-label">Date of Breakage:</label>
                            <input type="datetime-local" name="date_of_breakage" id="date_of_breakage" class="form-control"
                                required>
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>


                    </body>
                </div>
            </div>
        </div>
    </div>
@endsection
