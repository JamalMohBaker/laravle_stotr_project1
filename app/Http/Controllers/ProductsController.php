<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\productImage;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function index()
    {

    }
    public function show($slug)
    {
        // dd($slug);
        $product = Product::active()
        ->withoutGlobalScope('owner')
        // ->slug($slug)
        ->where('slug', '=', $slug)

        ->firstOrfail();

        $gallery = productImage::where('product_id' , '=' , $product->id)->get();
        return view('shop.products.show' , [
            'product' => $product,
            'gallery' => $gallery,
        ]);

    }
}
