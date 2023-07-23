@extends('layouts.admin')

@section('content')
@if($errors->any())
<div class="alert alert-danger">
    you have some errors:
    <ul>
        @foreach($errors->all() as $error)
        <li> {{ $error }} </li>
        @endforeach
    </ul>
</div>
@endif
    <h2 class="mb-4 fs-3"> Edit Order</h2>

    <form action="{{ route('orders.update' , $order->id) }}" method="post" >
        <!-- {{ csrf_field() }} -->
        @csrf
        {{-- Comment: Form Methood Spoofing --}}
        <input type="hidden" name="_method" value="put">
        <!-- override up to down -->
        <!-- <input type="hidden" name="_token" value="{{ csrf_token() }}" id=""> -->

        <div class="row">
           <div class="col-lg-8">
                <div class="col-12">
                    <x-form.input label="User Id" id="User Id" name="user_id" value="{{ $order->user_id }}" />
                </div>
                <div class="col-12">
                    <x-form.input label="customer_first_name" id="customer_first_name" name="customer_first_name" value="{{ $order->customer_first_name }}" />
                </div>
                <div class="col-12">
                    <x-form.input label="customer_last_name" id="customer_last_name" name="customer_last_name" value="{{ $order->customer_last_name }}" />
                </div>
                <div class="col-12">
                    <x-form.input type="email" label="customer_email" id="customer_email" name="customer_email" value="{{ $order->customer_email }}" />
                </div>
                <div class="col-12">
                    <x-form.input label="customer_phone" id="customer_phone" name="customer_phone" value="{{ $order->customer_phone }}" />
                </div>
                <div class="col-12">
                    <x-form.input label="customer_address" id="customer_address" name="customer_address" value="{{ $order->customer_address }}" />
                </div>
                <div class="col-12">
                    <x-form.input label="customer_city" id="customer_city" name="customer_city" value="{{ $order->customer_city }}" />
                </div>
                <div class="col-12">
                    <x-form.input label="customer_postal_code" id="customer_postal_code" name="customer_postal_code" value="{{ $order->customer_postal_code }}" />
                </div>
                <div class="col-12">
                    <x-form.input label="customer_province" id="customer_province" name="customer_province" value="{{ $order->customer_province }}" />
                </div>
                <div class="col-12">
                    <x-form.input label="customer_country_code" id="customer_country_code" name="customer_country_code" value="{{ $order->customer_country_code }}" />
                </div>

           </div>


           <div class="col-lg-4">

                <div class="col-12">
                    <label for="type">status</label>
                    <div>
                        <select class="form-select form-control @error('status') is-invalid @enderror" id="status" name="status">
                            <option></option>
                            @foreach ($statusOptions as $status )
                            <option @selected($status ==  old('status',$order->status)) value="{{ $status }} " >
                                {{ $status}}
                            </option>
                            {{-- <option {{ $type == $user->type ? 'selected' : '' }} value="{{ $type }}">{{ $type }}</option> --}}
                            @endforeach
                        </select>
                    <x-form.error name="status" />
                    </div>

                </div>
                <div class=" col-12 ">
                    <label for="status">payment_status</label>
                    <div>
                        @foreach ($paymentStatus as $value => $label)
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="payment_status" id="status_{{ $value }}" value="{{ $value }} " @checked($value == old('payment_status',$order->payment_status))>
                                <label class="form-check-label" for="status_{{ $value }}">
                                    {{ $label }}
                                </label>
                            </div>
                        @endforeach
                        @error('payment_status')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="col-12">
                     <x-form.input label="currency" id="currency" name="currency" value="{{ $order->currency }}" />
                </div>
                <div class="col-12">
                     <x-form.input label="total" id="total" name="total" value="{{ $order->total }}" />
                </div>

           </div>


        </div>
        <button type="submit" class="btn btn-primary">Update</button>

    </form>

  @endsection

