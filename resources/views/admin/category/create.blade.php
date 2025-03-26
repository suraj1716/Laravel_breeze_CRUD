<x-admin-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight text-center">
            {{ __('Edit Role') }}
        </h2>
    </x-slot>

    <div class="d-flex justify-content-center align-items-center min-vh-500 bg-light">
        <div class="card border-0 shadow-lg rounded-4 p-4" style="max-width: 500px; width: 100%;">
            <div class="card-body">
                <form action="{{ route('admin.category.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf  {{-- Ensure CSRF protection --}}
                            <div class="mb-3">
                                <label>Name</label>
                                <input type="text" name="name" class="form-control" />
                                @error('name'){{$message}} @enderror
                            </div>
                            <div class="mb-3">
                                <label>Description</label>
                                <textarea name="description" rows="3" class="form-control"></textarea>  {{-- Fixed closing tag --}}
                                @error('name'){{$message}} @enderror

                            </div>
                            <div class="mb-3">
                                <label>Status</label>
                                <input type="checkbox" name="status"/> Checked: Visible, Unchecked: Hidden  {{-- Removed unnecessary class --}}
                                @error('name'){{$message}} @enderror

                            </div>

                            <div class="mb-3">
                                <label>Image Upload</label>
                                <input type="file" name="image" class="form-control"/>   {{-- Removed unnecessary class --}}
                                @error('name'){{$message}} @enderror

                            </div>
                            <div class="mb-3">
                                <button type="submit" class="btn btn-success">Submit</button> {{-- Added submit button --}}

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </x-admin-app-layout>
