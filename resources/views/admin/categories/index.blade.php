@extends('layouts.admin')

@section('content')
   <header class=" mb-4 d-flex">
    <h2 class="mb-4 fs-3"> Categories </h2>
    <div class="ml-auto">
        <a href="{{ route('categories.create') }}" class="btn btn-sm btn-primary">
            + Create category
        </a>
        <a href="{{ route('categories.trashed') }}" class="btn btn-sm btn-danger">
            <i class="fas fa-trash"></i> View trash
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

                <td>{{ $category->name }}</td>
                <td>{{ $category->products_count }}</td>

                {{-- href="{{ route('products.edit', $product->id) }}" --}}
                {{-- categories.edit reference to edit() function in controller --}}
                <td><a href="{{ route('categories.edit', $category->name) }}" class="btn btn-sm btn-outline-dark"><i class="far fa-edit"></i> Edit</a></td>
                <td>
                    <form action="{{ route('categories.destroy', $category->name) }}" method="post">
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
