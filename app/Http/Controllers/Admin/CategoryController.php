<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request->query('search');

        if ($search) {
            $categories = Category::where('name', 'like', "%$search%")->get();
        } else {
            $categories = Category::all();
        }

        return view(('admin.category.index'), compact('categories', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required|string|max:20|unique:categories',
            'description' => 'nullable|string|max:150'
        ]);

        $catgoryValidate = $request->all();

        $catgory = New Category();
        $catgory->fill($catgoryValidate);
        $catgory->save();

        return redirect()->route('admin.categories.index')->with('create', 'Item created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('admin.category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:20|unique:categories',
            'description' => 'nullable|string|max:150'
        ]);

        $category = Category::findOrFail($id);
        $data = $request->all();

        $category->update($data);
        $category->save();

        return redirect()->route('admin.categories.index')->with('update', 'Item updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        if($category->parts->count() > 0){
            return redirect()->route('admin.categories.index', ['category' => $category])->with('status', 'Impossibile eliminare l\'elemento poiché è utilizzato');
        }

        $category->delete();

        return redirect()->route('admin.categories.index', ['category' => $category])->with('status', 'Item deleted');
    }
}
