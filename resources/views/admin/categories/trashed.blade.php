@extends('layouts.admin')

@section('content')
<header class=" mb-4 d-flex">
    <h2 class="mb-4 fs-3">Trashed Categories </h2>
    <div class="ml-auto">
        <a href="{{ route('categories.index') }}" class="btn btn-sm btn-primary">
            category List
        </a>

    </div>
   </header>

   <table class="table">
    <thead>
        <tr>
            <th>ID</th>
            <th>NAME OF CATEGORY</th>
            <th>DELETED AT </th>
            <th>RESTORE</th>
            <th>DELETE</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($categories as $category)
            <tr>
                <td>{{ $category->id }}</td>
                <td>{{ $category->name }}</td>
                <td>{{ $category->deleted_at }}</td>
                <td>
                    <form action="{{ route('categories.restore', $category->id) }}" method="post">
                        @csrf
                        @method('put')
                        <button type="submit" class="btn btn-primary"><i class="fas fa-trash-restore"></i> Restore</button>
                    </form>
                </td>
                <td>
                    <form action="{{ route('categories.force-delete', $category->id) }}" method="post">
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i> Force Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
   </table>




@endsection
