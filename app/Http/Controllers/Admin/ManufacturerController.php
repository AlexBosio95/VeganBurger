<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Manufacturer;

class ManufacturerController extends Controller
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
            $manufacturers = Manufacturer::where('name', 'like', "%$search%")->get();
        } else {
            $manufacturers = Manufacturer::all();
        }

        return view(('admin.manufacturer.index'), compact('manufacturers', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.manufacturer.create');
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
            'country' => 'required|string|max:50',
            'contact_email' => 'required|email|max:100',
            'phone_number' => 'required|numeric|digits_between:8,15',
            'website' => 'nullable|string|max:50',
            'contact_person' => 'nullable|string|max:30',
            'address' => 'required|string|max:100'
        ]);

        $data = $request->all();

        $manufacturer = new Manufacturer();
        $manufacturer->fill($data);
        $manufacturer->save();

        return redirect()->route('admin.manufacturers.index')->with('create', 'Item created');
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
        $manufacturer = Manufacturer::findOrFail($id);
        return view('admin.manufacturer.edit', compact('manufacturer'));
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
            'country' => 'required|string|max:50',
            'contact_email' => 'required|email|max:100',
            'phone_number' => 'required|numeric|digits_between:8,15',
            'website' => 'nullable|string|max:50',
            'contact_person' => 'nullable|string|max:30',
            'address' => 'required|string|max:100'
        ]);

        $manufacturer = Manufacturer::findOrFail($id);
        $data = $request->all();

        $manufacturer->update($data);
        $manufacturer->save();

        return redirect()->route('admin.manufacturers.index')->with('update', 'Item updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Manufacturer $manufacturer)
    {
        if($manufacturer->parts->count() > 0){
            return redirect()->route('admin.manufacturers.index', ['manufacturer' => $manufacturer])->with('status', 'Impossibile eliminare l\'elemento poiché è utilizzato');
        }

        $manufacturer->delete();

        return redirect()->route('admin.manufacturers.index', ['manufacturer' => $manufacturer])->with('status', 'Item deleted');
    }
}
