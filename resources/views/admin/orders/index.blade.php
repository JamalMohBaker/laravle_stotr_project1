@extends('layouts.admin')

@section('content')
   <header class=" mb-4 ">
    <h2 class="mb-4 fs-3"> Orders </h2>

   </header>
    @if(session()->has('success'))
    <div id="success-message" class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    <table class="table">
        <thead>
            <tr class="bg-dark">
                <th>Id</th>
                <th>User_id</th>
                <th>First Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>City</th>
                <th>Sttatus</th>
                <th>Payment Sttatus</th>
                <th>Total</th>
                <th>Edit</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orders as $order)
            <tr>
                <td>{{ $order->id }}</td>
                <td>{{ $order->user_id }}</td>
                <td>{{ $order->customer_first_name }}</td>
                <td>{{ $order->customer_email }}</td>
                <td>{{ $order->customer_phone }}</td>
                <td>{{ $order->customer_city }}</td>
                <td>{{ $order->status }}</td>
                <td>{{ $order->payment_status }}</td>
                <td>{{ $order->total }}</td>

                {{-- href="{{ route('products.edit', $product->id) }}" --}}
                {{-- categories.edit reference to edit() function in controller --}}
                <td><a href="{{ route('orders.edit', $order->id) }}" class="btn btn-sm btn-outline-dark"><i class="far fa-edit"></i> Edit</a></td>


            </tr>

            @endforeach

        </tbody>
    </table>

    {{ $orders->links() }}

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
