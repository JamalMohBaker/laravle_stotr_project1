@extends('layouts.admin')

@section('content')
   <header class=" mb-4 d-flex">
    <h2 class="mb-4 fs-3"> Users </h2>
    <div class="ml-auto">
        <a href="{{ route('usres.createe') }}" class="btn btn-sm btn-primary">
            + Create User
        </a>
        <a href="{{ route('users.trashed') }}" class="btn btn-sm btn-danger">
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
                <th>Email</th>
                <th>Email_verified_at</th>
                <th>Type</th>
                <th>Status</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
            <tr>
                <td>{{ $user->id }}</td>

                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->email_verified_at }}</td>
                <td>{{ $user->type }}</td>
                <td>{{ $user->status }}</td>

                {{-- href="{{ route('products.edit', $product->id) }}" --}}
                {{-- categories.edit reference to edit() function in controller --}}
                <td><a href="{{ route('users.edit', $user->id) }}" class="btn btn-sm btn-outline-dark"><i class="far fa-edit"></i> Edit</a></td>
                <td>
                    <form action="{{ route('users.destroy', $user->id) }}" method="post">
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i> Delete</button>
                    </form>
                </td>
            </tr>

            @endforeach

        </tbody>
    </table>

    {{ $users->links() }}

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
