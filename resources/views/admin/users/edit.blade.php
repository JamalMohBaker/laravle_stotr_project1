@extends('layouts.admin')

@section('content')
    <h2 class="mb-4 fs-3"> Edit User</h2>

    <form action="{{ route('users.update' , $user->id) }}" method="post" enctype="multipart/form-data">
        <!-- {{ csrf_field() }} -->
        @csrf
        {{-- Comment: Form Methood Spoofing --}}
        <input type="hidden" name="_method" value="put">
        <!-- override up to down -->
        <!-- <input type="hidden" name="_token" value="{{ csrf_token() }}" id=""> -->

        <div class="row">
            <div class="col-12">
                <x-form.input label="User name" id="name" name="name" value="{{ $user->name }}" />
            </div>
            <div class="col-12">
                <x-form.input type="email" label="User email" id="email" name="email" value="{{ $user->email }}" />
            </div>
            <div class="col-12">
                <x-form.input type="password" label="password" id="password" value="{{ $user->password }}" name="password" />
            </div>

            <div class="col-12">
                <label for="type">Type</label>
                <div>
                    <select class="form-select form-control @error('type') is-invalid @enderror" id="type" name="type">
                        <option></option>
                        @foreach ($typesOptions as $type )
                        <option @selected($type ==  old('type',$user->type)) value="{{ $type }} " >
                            {{ $type}}

                        </option>
                        {{-- <option {{ $type == $user->type ? 'selected' : '' }} value="{{ $type }}">{{ $type }}</option> --}}
                        @endforeach
                    </select>
                   <x-form.error name="type" />
                </div>

            </div>

            <div class=" col-12 ">
                <label for="status">status</label>
                <div>
                    @foreach ($status_options as $value => $label)
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="status" id="status_{{ $value }}" value="{{ $value }} " @checked($value == old('status',$user->status))>
                            <label class="form-check-label" for="status_{{ $value }}">
                                {{ $label }}
                            </label>
                        </div>
                    @endforeach
                    @error('status')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
            </div>


        </div>
        <button type="submit" class="btn btn-primary">Update</button>

    </form>

  @endsection

