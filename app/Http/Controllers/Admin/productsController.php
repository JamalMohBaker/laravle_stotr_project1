<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class productsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
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
        ->get();

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
        $categories = Category::all(); // collection (array)
        return view('admin/products/create',[
            'product'=> new product(),
            'categories'=>$categories,
            'status_option' => [
                'active'=>'active',
                'draft'=>'draft',
                'archived'=>'archived',
            ],
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|max:255|min:3',
            'slug' => 'required|unique:products,slug',
            'category_id' => 'nullable|int|exists:categories,id',
            'descriprion' => 'nullable|string',
            'short_description' => 'nullable|string|max:500',
            'price' => 'nullable|required|numeric|min:0', // not accept negative value
            'compare_price' => 'nullable|numeric|min:0|gt:price',
            'image' => 'nullable|image|dimensions:min_width=400,min_height=300|max:1024',
            'status' => 'required|in:active,draft,archived',
        ];
        
        $request->validate($rules);

        $product = new Product(); // call object from model
        $product->name = $request->input('name');
        $product->slug = $request->input('slug');
        $product->category_id = $request->input('category_id');
        $product->description = $request->input('description');
        $product->short_description = $request->input('short_description');
        $product->price = $request->input('price');
        $product->compare_price = $request->input('compare_price');
        $product->status = $request->input('status','active');
        $product->save();
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
    public function edit(string $id)
    {
        $categories = Category::all();
        // $product = Product::where('id','=',$id)->first(); return Model or NULL
        $product=Product::findOrFail($id); //return Model or NULL
        // if(!$product){
        //     abort(404); if use find($id) without using findOrFail($id)
        // }
        return view('admin.products.edit' , [
            'product' => $product,
            'categories'=>$categories,
            'status_option' => [
                'active' => 'active',
                'draft' => 'draft',
                'archived' => 'archived',
            ],
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $rules = [
            'name' => 'required|max:255|min:3',
            'slug' => "required|unique:products,slug,$id", // $this->id does not in search
            'category_id' => 'nullable|int|exists:categories,id',
            'descriprion' => 'nullable|string',
            'short_description' => 'nullable|string|max:500',
            'price' => 'nullable|required|numeric|min:0', // not accept negative value
            'compare_price' => 'nullable|numeric|min:0|gt:price',
            'image' => 'nullable|image|dimensions:min_width=400,min_height=300|max:1024',
            'status' => 'required|in:active,draft,archived',
        ];
        $request->validate($rules);

        $product = Product::findOrFail($id); // call object from model
        $product->name = $request->input('name');
        $product->slug = $request->input('slug');
        $product->category_id = $request->input('category_id');
        $product->description = $request->input('description');
        $product->short_description = $request->input('short_description');
        $product->price = $request->input('price');
        $product->compare_price = $request->input('compare_price');
        $product->status = $request->input('status','active');
        $product->save();
        //prg : post redirect get
       return redirect()->route('products.index')
       ->with('success',"Product ({$product->name}) Updated!"); //GET
        //    return 'Product save';
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // product::destroy($id);// short way
        $product = Product::findOrFail($id);
        $product->delete();
        // 130 131 line this war for retrive an information
        return redirect()->route('products.index')
        ->with('success',"Product ({$product->name}) deleted!");
    }
}
