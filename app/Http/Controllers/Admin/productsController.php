<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\productRequest;
use App\Models\Category;
use App\Models\Product;
use App\Models\productimage;
use App\Models\productImage as ModelsProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\View;

class productsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct(Request $request)
    {
       if($request->method() == 'GET'){
            $categories = Category::all(); // collection (array)
            View::share([
                // any file view can use this variable
                'categories'=>$categories,
                'status_options' =>  product::statusOptions(),


            ]);
       }
    }
    public function index(Request $request)
    {
        //select products.*, categories.name as category_name
        //from products
        //insert join categories on categories.id = products.category_id
        //"" or "" Left join categories on categories.id = products.category_id
        // $products = DB::table('products')
        // ->join('categories','categories.id' ,'=','products.category_id')
        // //or ->leftJoin('categories','categories.id' ,'=','products.category_id')
        // ->select(
        //     [
        //         'products.*',
        //         'categories.name as category_name'
        //     ]
        // )
        // ->get(); // return a collection of std object = "array" //last method calling get()


        // $products=Product::all(); == select * from product
        $products = Product::leftJoin('categories','categories.id' ,'=','products.category_id')
        ->select(
            [
                'products.*',
                'categories.name as category_name'
            ]
        )
        // ->withoutGlobalScope('owner') //to remove global scope
        //->active() //call this implement function from Models/product.php
        // ->status('active') //call this implement function from Models/product.php
        ->filter($request->all())
        ->paginate(5);

        return view('admin.products.index',[
            'title' => 'Product List !! ',
            'products' => $products ,

        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('admin/products/create',[
            'product'=> new product(),

        ]);

    }
    public function trashed()
    {
        $products = Product::onlyTrashed()->paginate();
        return view('admin.products.trashed',[
            'products' => $products ,
        ]

    );
    }
    public function restore( $id)
    {
        $product = Product::onlyTrashed()->findOrFail($id);
        $product->restore();
        return redirect()
               ->route('products.index')
               ->with('success' , "Producted ({$product->name}) restored");
    }
    public function forceDelete( $id)
    {
        $product = Product::onlyTrashed()->findOrFail($id);
        $product->forceDelete();
        if ($product->image){
            Storage::disk('public')->delete($product->image);
        }
        return redirect()
                ->route('products.index')
               ->with('success' , "Producted ({$product->name}) deleted forever! ");
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(productRequest $request)
    {
        //productRequest by default validation is execution

        // $request->validate($rules);
        //Mass assignment
        $data = $request->validated();
        if($request->hasFile('image')){
            $file = $request->file('image'); // return UploadedFile object
            $path =  $file->store('uploads/images','public'); //return file path after store
            //**public=>locale storage** / ** uploade/images file for storage**
            $data['image'] = $path;
        }
        $product = Product::create($data); //$request->validate() all data are validated

        if ($request->hasFile('gallery')) {
            foreach($request->file('gallery') as $file){
                productimage::create([
                    'product_id' => $product->id,
                    'image' => $file->store('uploads/images' , 'public'),
                ]);
            }
        }
        // $product = new Product(); // call object from model
        // $product->name = $request->input('name');
        // $product->slug = $request->input('slug');
        // $product->category_id = $request->input('category_id');
        // $product->description = $request->input('description');
        // $product->short_description = $request->input('short_description');
        // $product->price = $request->input('price');
        // $product->compare_price = $request->input('compare_price');
        // $product->status = $request->input('status','active');
        // $product->save();
        //prg : post redirect get
       return redirect()
       ->route('products.index')
       ->with('success',"Product ({$product->name}) created!"); //Add flash message with name=succe
    //    return 'Product save';
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {

        //$categories = Category::all();

        $gallery = productImage::where('product_id' , '=' , $product->id)->get();
        // $product = Product::where('id','=',$id)->first(); return Model or NULL
       // $product=Product::findOrFail($id); //return Model or NULL
        // if(!$product){
        //     abort(404); if use find($id) without using findOrFail($id)
        // }
        return view('admin.products.edit' , [
            'product' => $product,
            'gallery' => $gallery,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(productRequest $request, Product $product)
    {
    //    $rules=$this->rules($id);
    //    $message = $this->messages();
    //    $request->validate($rules,$message);
    //    $request->rout(); if i want call request for it class على مستوى الكلاس

        //$product = Product::findOrFail($id); // call object from model
        $data = $request->validated();
        if($request->hasFile('image')){
            $file = $request->file('image'); // return UploadedFile object
            $path =  $file->store('uploads/images','public'); //return file path after store
            //**public=>locale storage** / ** uploade/images file for storage**
            $data['image'] = $path;
        }
        $data['user_id'] = Auth::id();
        $old_image = $product->image;
        //Mass assignment
        $product->update( $data );

        if ($old_image && $old_image != $product->image){
            Storage::disk('public')->delete($old_image);
        }
        if ($request->hasFile('gallery')) {
            foreach($request->file('gallery') as $file){
                ProductImage::create([
                    'product_id' => $product->id,
                    'image' => $file->store('uploads/images' , 'public'), // path
                ]);
            }
        }
        // $product->name = $request->input('name');
        // $product->slug = $request->input('slug');
        // $product->category_id = $request->input('category_id');
        // $product->description = $request->input('description');
        // $product->short_description = $request->input('short_description');
        // $product->price = $request->input('price');
        // $product->compare_price = $request->input('compare_price');
        // $product->status = $request->input('status','active');
        // $product->save();

        //prg : post redirect get
       return redirect()->route('products.index')
       ->with('success',"Product ({$product->name}) Updated!"); //GET
        //    return 'Product save';
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        // product::destroy($id);// short way
        // $product = Product::findOrFail($id);
        $product->delete();
        // 130 131 line this war for retrive an information

        return redirect()->route('products.index')
        ->with('success',"Product ({$product->name}) deleted!");
    }
}
