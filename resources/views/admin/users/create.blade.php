@extends('layouts.admin')

@section('content')
    <h2 class="mb-4 fs-3"> Create a new User</h2>

    <form action="{{ route('users.store') }}" method="post" >
        @csrf
        <!-- override up to down -->
        <!-- <input type="hidden" name="_token" value="{{ csrf_token() }}" id=""> -->
        @include('admin.users._form',[
            'submit_label' => 'Create'
           ])
    </form>

  @endsection
