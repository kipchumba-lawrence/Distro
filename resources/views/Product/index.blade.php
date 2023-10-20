@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

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
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    {{-- <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">ID</th> --}}
                                    {{-- Create a  numbering system --}}
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Name
                                    </th>
                                    {{-- <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Description
                                    </th> --}}
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Category
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Packaging
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Price
                                    </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Updated Date</th>
                                    {{-- <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Action</th> --}}
                                </tr>
                            </thead>
                            @livewire('create-category')
                            @livewire('update-category')
                            <tbody>
                                @if (empty($products))
                                    No Categories!
                                @else
                                    @foreach ($products as $product)
                                        <tr>
                                            <td>
                                                <h6 class="mb-0 text-sm">{{ $product->name }}</h6>
                                            </td>
                                            {{-- <td>
                                                <p class="text-sm font-weight-bold mb-0">{{ $product->description }}</p>
                                            </td> --}}
                                            <td class="align-middle text-center text-sm">
                                                <p class="text-sm font-weight-bold mb-0">{{ $product->category->name }}</p>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                <p class="text-sm font-weight-bold mb-0">{{ $product->packaging }}</p>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                <p class="text-sm font-weight-bold mb-0">{{ $product->price }}</p>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                <p class="text-sm font-weight-bold mb-0">{{ $product->updated_at }}</p>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('livewire:load', function() {
            Livewire.on('update-category', categoryId => {
                // Trigger the Livewire component with the category id
                Livewire.emit('update-category', categoryId);
            });

            $('#update_category').on('show.bs.modal', function(event) {
                // Get the category id from the clicked "Edit" button's data attribute
                const categoryId = $(event.relatedTarget).data('category-id');

                // Trigger the Livewire event to pass the category id
                Livewire.emit('editCategory', categoryId);
            });
        });
    </script>

@endsection
