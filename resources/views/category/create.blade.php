@extends('layouts.frontend')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h2>Create
                            <a href="{{ url('category')}}" method="POST" class="btn btn-danger float-end">Back</a>
                        </h2>
                    </div>
                    <div class="card-body">
                        <form action="{{route('category.store')}}" method="POST">
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
                                <button type="submit" class="btn btn-success">Submit</button> {{-- Added submit button --}}

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
