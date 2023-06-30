@extends('layouts.admin')

@section('content')
   <header class=" mb-4 d-flex">
    <h2 class="mb-4 fs-3">Trashed products </h2>
    <div class="ml-auto">  
        <a href="{{ route('products.index') }}" class="btn btn-sm btn-primary">
            Product List
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
                <th>Deleted At </th>
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
                
                <td>{{ $product->deleted_at }}</td>
                <td>
                    <form action="{{ route('products.restore', $product->id) }}" method="post">
                        @csrf
                        @method('put')
                        <button type="submit" class="btn btn-primary"><i class="fas fa-trash-restore"></i> Restore</button>
                    </form>
                </td>
                <td>
                    <form action="{{ route('products.force-delete', $product->id) }}" method="post">
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i> Force Delete</button>
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
