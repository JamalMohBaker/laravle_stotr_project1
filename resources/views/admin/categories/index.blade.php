@extends('layouts.admin')

@section('content')
   <header class=" mb-4 d-flex">
    <h2 class="mb-4 fs-3"> Categories </h2>
    <div class="ml-auto">
        <a href="{{ route('categories.create') }}" class="btn btn-sm btn-primary">
            + Create category
        </a>

    </div>
   </header>
    @if(session()->has('success'))
    <div id="success-message" class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th>Id</th>
                <th>image</th>
                <th>Name</th>
                <th>Products #</th>
                <th>edit</th>
                <th>delete</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($categories as $category)
            <tr>
                <td>{{ $category->id }}</td>
                <td>

                        <a href="{{ $category->image_url  }}" target="_blank">
                            {{-- <img src="{{ asset('storage/' . $category->image ) }}" width="50" alt=""> --}}
                            <img src="{{ $category->image_url }}" width="50" alt="">
                            {{-- url this use for image from googledrive or aws --}}
                        </a>

                </td>
                <td>{{ $category->name }}</td>
                <td>{{ $category->products_count }}</td>
                <td>{{ $category->price_formatted }}</td>
                <td>{{ $category->status }}</td>
                <td><a href="{{ route('categories.edit', $category->id) }}" class="btn btn-sm btn-outline-dark"><i class="far fa-edit"></i> Edit</a></td>
                <td>
                    <form action="{{ route('categories.destroy', $category->id) }}" method="post">
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i> Delete</button>
                    </form>
                </td>
            </tr>

            @endforeach

        </tbody>
    </table>

    {{ $categories->links() }}

<script>
    // to hidden flash message after 5 seconed
    setTimeout(function(){
        var successMessage = document.getElementById('success-message');
        if(successMessage) {
            successMessage.style.display = 'none';
        }
    },5000);
</script>
@endsection
