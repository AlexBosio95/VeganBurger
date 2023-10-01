<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\Part;
use App\Models\Category;
use App\Models\Manufacturer;
use QrCode;
Use Illuminate\Support\Facades\Storage;


class PartController extends Controller
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
            $parts = Part::where('part_number', 'like', "%$search%")->get();
        } else {
            $parts = Part::all();
        }

        return view(('admin.part.index'), compact('parts', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $manufacturers = Manufacturer::pluck('name', 'id');
        $categories = Category::pluck('name', 'id');
        return view(('admin.part.create'), compact('categories', 'manufacturers'));
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
            'part_number' => 'required|string|max:20|unique:parts',
            'name' => 'required|string|max:80',
            'description' => 'string|max:150',
            'price' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:1',
            'location' => 'string|max:100',
            'category_id' => 'required|exists:categories,id',
            'manufacturer_id' => 'required|exists:manufacturers,id',
            'image'=> 'nullable|max:10000|image',
        ]);
        
        $validatedData = $request->all();
        
        $part = new Part();

        if (array_key_exists('image', $validatedData)){

            $image = Storage::put('public/parts_img', $validatedData['image']);
            $validatedData['image'] = str_replace('public/', '', $image);
        }

        $part->fill($validatedData);
        
        $part->save();

        if (array_key_exists('category_id', $validatedData)){
            $category = Category::find($validatedData['category_id']);
            $part->category()->associate($category);
        }

        if (array_key_exists('manufacturer_id', $validatedData)){
            $manufacturer = Manufacturer::find($validatedData['manufacturer_id']);
            $part->manufacturer()->associate($manufacturer);
        }

        return redirect()->route('admin.parts.index')->with('create', 'Item created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $part = Part::findOrFail($id);
        $qrCode = QrCode::size(150)->generate($part->part_number);

        return view('admin.part.show', compact('part', 'qrCode'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $manufacturers = Manufacturer::pluck('name', 'id');
        $categories = Category::pluck('name', 'id');
        $part = Part::findOrFail($id);
        return view('admin.part.edit', compact('part', 'categories', 'manufacturers'));
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
            'name' => 'required|string|max:80',
            'description' => 'string|max:150',
            'price' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:1',
            'location' => 'string|max:30',
            'category_id' => 'required|exists:categories,id',
            'manufacturer_id' => 'required|exists:manufacturers,id',
            'image'=> 'nullable|max:10000|image',
        ]);

        $part = Part::findOrFail($id);
        $data = $request->all();

        if (array_key_exists('image', $data)){

            if($part->image){
                Storage::delete($part->image);
            }

            $image = Storage::put('public/parts_img', $data['image']);
            $data['image'] = str_replace('public/', '', $image);
        }

        $part->update($data);
        $part->save();

        return redirect()->route('admin.parts.index')->with('update', 'Item updated');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Part $part)
    {

        if ($part->image) {
            Storage::delete($part->image);
        }

        $part->delete();

        return redirect()->route('admin.parts.index', ['part' => $part])->with('status', 'Item deleted');
    
    }

    public function search(Request $request)
    {
        $searchTerm = $request->input('search');

        if ($searchTerm) {
            $results = Part::where('name', 'like', '%' . $searchTerm . '%')->get();
        } else {
            $results = []; // Nessun risultato se non è stato fornito un termine di ricerca
        }

        dd($searchTerm);
        
        return view('admin.part.index', compact('searchTerm', 'results'));
    }

    public function deleteImage(Part $part){
        if ($part->image) {
            Storage::delete($part->image);
        }

        $part->image = null;
        $part->save();
        
        return redirect()->route('admin.parts.edit', [ 'part' => $part->id]);
    }
}
