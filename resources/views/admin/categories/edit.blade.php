@extends('layouts.admin')

@section('content')
    <h2 class="mb-4 fs-3"> Edit Category </h2>


        <form action="{{ route('categories.update' , $category->name) }}" method="post" enctype="multipart/form-data">
            <!-- {{ csrf_field() }} -->
            @csrf
            {{-- Comment: Form Methood Spoofing --}}
            <input type="hidden" name="_method" value="put">

             <div>
                <label for="category">category</label>
                <input class="form-control @error('name') is-invalid @enderror" type="text" name="name" id="categoey" value="{{ $category->name }}" >
                @error('name')
                 <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary mt-1"> Update </button>
        </form>

  @endsection

