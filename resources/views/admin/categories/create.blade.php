@extends('layouts.admin')

@section('content')
    <h2 class="mb-4 fs-3"> Create a new Category </h2>

    <form action="{{ route('categories.store') }}" method="post">
        @csrf
        <div>
            <label for="category">category</label>
            <input class="form-control @error('name') is-invalid @enderror" type="text" name="name" id="categoey">
            @error('name')
             <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary mt-1"> Create </button>
    </form>

@endsection
