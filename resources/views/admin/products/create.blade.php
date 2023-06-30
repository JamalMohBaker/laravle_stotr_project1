@extends('layouts.admin')

@section('content')
    <h2 class="mb-4 fs-3"> Create a new Product</h2>

    <form action="{{ route('products.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <!-- override up to down -->
        <!-- <input type="hidden" name="_token" value="{{ csrf_token() }}" id=""> -->
        @include('admin.products._form',[
            'submit_label' => 'Create'
           ])
    </form>

  @endsection

