@extends('layouts.admin')

@section('content')
   <header class=" mb-4 d-flex">
    <h2 class="mb-4 fs-3">{{$title}} </h2>
    <div class="ml-auto">  
        <a href="{{ route('products.create') }}" class="btn btn-sm btn-primary">
            + Create Product
        </a>
        <a href="{{ route('products.trashed') }}" class="btn btn-sm btn-danger">
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
                <th>image</th>
                <th>Name</th>
                <th>Category</th>
                <th>Price</th>
                <th>Status</th>
                <th>edit</th>
                <th>delete</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
            <tr>
                <td>{{ $product->id }}</td>
                <td>

                        <a href="{{ $product->image_url  }}" target="_blank">
                            {{-- <img src="{{ asset('storage/' . $product->image ) }}" width="50" alt=""> --}}
                            <img src="{{ $product->image_url }}" width="50" alt="">
                            {{-- url this use for image from googledrive or aws --}}
                        </a>

                </td>
                <td>{{ $product->name }}</td>
                <td>{{ $product->category_name }}</td>
                <td>{{ $product->price_formatted }}</td>
                <td>{{ $product->status }}</td>
                <td><a href="{{ route('products.edit', $product->id) }}" class="btn btn-sm btn-outline-dark"><i class="far fa-edit"></i> Edit</a></td>
                <td>
                    <form action="{{ route('products.destroy', $product->id) }}" method="post">
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i> Delete</button>
                    </form>
                </td>
            </tr>

            @endforeach

        </tbody>
    </table>

    {{ $products->links() }}

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
