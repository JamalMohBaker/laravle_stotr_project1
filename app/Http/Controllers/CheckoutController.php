<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderLine;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Intl\Countries;

class CheckoutController extends Controller
{
    public function create()
    {
        $countries = Countries::getNames('en');
        return view('shop.checkout',[
            'countries' => $countries,
        ]);
    }

    public function store(Request $request)
    {
       $validated = $request->validate([
        'customer_first_name' => 'required',
        'customer_last_name' => 'required',
        'customer_email' => 'required',
        'customer_phone' => 'nullable',
        'customer_address' => 'required',
        'customer_city' => 'required',
        'customer_postal_code' => 'nullable',
        'customer_province' => 'nullable',
        'customer_country_code' => 'required|string|size:2'

        ]);

        $validated['user_id'] = Auth::id();
        $validated['status'] = 'pending';
        $validated['payment_status'] = 'pending';
        $validated['currency'] = 'ILS';


        $cookie_id = $request->cookie('cart_id');
        //with('product') for performance
        $cart = Cart::with('product')->where('cookie_id', '=', $cookie_id)->get(); //collection
        $total = $cart->sum(function($item){
            return $item->product->price * $item->quantity;
        });
        $validated['total'] = $total;

        DB::beginTransaction();
        try{
            //create order from model
        $order = Order::create($validated);

        //Insert orderLines
        foreach ($cart as $item) {
            OrderLine::create([
                'order_id' => $order->id,
                'product_id' => $item->product_id,
                'quantity' => $item->quantity,
                'price' => $item->product->price,
                'product_name' => $item->product->name,
            ]);
        }

        // Delete cart item
        Cart::where('cookie_id', '=', $cookie_id)->delete();

        DB::commit();

        }catch(Exception $e){
            DB::rollBack();
            return back()
            ->withInput() // old data input now
            ->with('error', $e->getMessage());
        }


         //Redirect to success page!
         return redirect()->route('checkout.success');
    }
}

