<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
// use App\Http\Controllers\Admin\Controller;
use App\Http\Requests\categoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::withCount('products')->paginate();
        return view('admin.categories.index',[
            'categories' => $categories,
        ]);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin/categories/create',[
            'category'=> new category(),

        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(categoryRequest $request)
    {
        $data = $request->validated();

        $category = Category::create($data);

        return redirect()
        ->route('categories.index')
        ->with('success',"Caetgory ({$category->name}) created!");
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
    public function edit(Category $category)
    {
        return view('admin.categories.edit' , [
            'category' => $category,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(categoryRequest $request, Category $category)
    {
        $data = $request->validated();
        $category->update($data);
        return redirect()->route('categories.index')
       ->with('success',"category ({$category->name}) Updated!");
    }

    public function trashed(){
        $categories = Category::onlyTrashed()->paginate();

        return view('admin.categories.trashed',[
            'categories' => $categories,
        ]);

    }
    public function restore( $id)
    {
        $category = Category::onlyTrashed()->findOrFail($id);
        $category->restore();

        return redirect()
                    ->route('categories.index')
                    ->with('success' , "categorry ({$category->name}) restored");
    }
    public function forceDelete( $id){
        $category = Category::onlyTrashed()->findOrFail($id);
        $category->forceDelete();

        return redirect()
                ->route('categories.index')
                ->with('success' , "categorry ({$category->name}) deleted forever! ");
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('categories.index')
        ->with('success' , "categorry ({$category->name}) deleted! ");
    }
}
