@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Category Management'])
    <div class="row mt-4 mx-4">
        <div class="col-12">
            <div class="card mb-4 p-4">
                <div class="card-header pb-0">
                    <div class="d-flex justify-content-between align-items-center">
                        <h6>Categories</h6>

                        <div class="ml-auto">
                            <a href="{{ route('category.create') }}">

                                <button class="btn btn-md btn-primary">Add
                                    New
                                    Category</button></a>
                        </div>
                    </div>

                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">ID</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Name
                                    </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Create Date</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Action</th>
                                </tr>
                            </thead>
                            @livewire('create-category')
                            @livewire('update-category')
                            <tbody>
                                @if (empty($categories))
                                    No Categories!
                                @else
                                    @foreach ($categories as $category)
                                        <tr>
                                            <td>
                                                <h6 class="mb-0 text-sm">{{ $category->id }}</h6>
                                            </td>
                                            <td>
                                                <p class="text-sm font-weight-bold mb-0">{{ $category->name }}</p>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                <p class="text-sm font-weight-bold mb-0">{{ $category->created_at }}</p>
                                            </td>
                                            <td class="align-middle text-end">
                                                <div class="d-flex px-3 py-1 justify-content-center align-items-center">
                                                    @livewire('update-category', ['category_id' => $category->id])
                                                    <p class="text-sm font-weight-bold mb-0" style="cursor: pointer;"
                                                        data-bs-toggle="modal" data-bs-target="#update_category">

                                                        Edit</p>


                                                </div>
                                            </td>
                                            <td>
                                                <p class="text-sm font-weight-bold mb-0 ps-2">Delete</p>
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
