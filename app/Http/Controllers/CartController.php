<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Str;
use NumberFormatter;

class CartController extends Controller
{
    public function index(Request $request)
    {
        $cookie_id = $request->cookie('cart_id');
        //with('product') for performance
        $cart = Cart::with('product')->where('cookie_id', '=', $cookie_id)->get(); //collection
        $total = $cart->sum(function($item){
            return $item->product->price * $item->quantity;
        });
        $formatter = new NumberFormatter('en', NumberFormatter::CURRENCY);
        return view('shop.cart',[
            'cart' => $cart,
            'total' => $formatter->formatCurrency($total, 'ILS'),
        ]);
    }
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => ['required', 'int', 'exists:products,id'],
            'quantity' => ['nullable', 'int', 'min:1' ,"max:99"],
        ]);

        $cookie_id = $request->cookie(('cart_id'));// cart_id : name of cookie
        if(!$cookie_id)
        {
            $cookie_id = Str::uuid();
            Cookie::queue('cart_id', $cookie_id , 60*24*30);
        }
        $item = Cart::where('cookie_id', '=', $cookie_id)
        ->where('product_id', '=',$request->input('product_id'))
        ->where('user_id', '=',Auth::id() )
        ->first();
        if($item){
            // update quantity of existing item in the database and cookie
            $item->increment('quantity', $request->input('quantity', 1));
        } else{
            Cart::create([
                'cookie_id' => $cookie_id,
                'user_id' => Auth::id(),
                'product_id' => $request->input('product_id'),
                'quantity' => $request->input('quantity', 1),
            ]);
        }


        //redirect()->back() == back()
        return back()
        ->with('success', 'product added to cart');

    }
    public function destroy($id)
    {

    }
}
