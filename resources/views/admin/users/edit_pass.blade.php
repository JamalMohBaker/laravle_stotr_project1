@extends('layouts.admin')

@section('content')
    <h2 class="mb-4 fs-3"> Edit Password User</h2>

    <form action="{{ route('users.updatepass' , $user->id) }}" method="post" >
        <!-- {{ csrf_field() }} -->
        @csrf
        {{-- Comment: Form Methood Spoofing --}}
        <input type="hidden" name="_method" value="put">
        <input type="password" class="form-control @error('password') is-invalid @enderror" name="editpassword" id="password">
        <br>
        <x-form.error name="password" />
        <button type="submit" class="btn btn-primary">Update Password</button>

    </form>

  @endsection

