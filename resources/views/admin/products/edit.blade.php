@extends('layouts.admin')

@section('content')
    <h2 class="mb-4 fs-3"> Edit Product</h2>

    <form action="{{ route('products.update' , $product->id) }}" method="post" enctype="multipart/form-data">
        <!-- {{ csrf_field() }} -->
        @csrf
        {{-- Comment: Form Methood Spoofing --}}
        <input type="hidden" name="_method" value="put">
        <!-- override up to down -->
        <!-- <input type="hidden" name="_token" value="{{ csrf_token() }}" id=""> -->
       @include('admin.products._form',[
        'submit_label' => 'Update'
       ])
    </form>

  @endsection

