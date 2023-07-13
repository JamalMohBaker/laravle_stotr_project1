@extends('layouts.admin')

@section('content')
   <header class=" mb-4 d-flex">
    <h2 class="mb-4 fs-3">Trashed Users </h2>
    <div class="ml-auto">
        <a href="{{ route('users.index') }}" class="btn btn-sm btn-primary">
            users List
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
                <th>Deleted At </th>
                <th>Restore</th>
                <th>delete</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->name }}</td>

                <td>{{ $user->deleted_at }}</td>
                <td>
                    <form action="{{ route('users.restore', $user->id) }}" method="post">
                        @csrf
                        @method('put')
                        <button type="submit" class="btn btn-primary"><i class="fas fa-trash-restore"></i> Restore</button>
                    </form>
                </td>
                <td>
                    <form action="{{ route('users.force-delete', $user->id) }}" method="post">
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i> Force Delete</button>
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
