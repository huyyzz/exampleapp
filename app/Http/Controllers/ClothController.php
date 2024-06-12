<?php

namespace App\Http\Controllers;

use App\Models\Cloth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ClothController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cloths = Cloth::all();
        return view('admin.index', compact('cloths'));
    }

    public function home()
    {
        $specific = null;
        $cloths = Cloth::all();
//        doi thanh category
        // 1 la ao, 2 la quan

        $ao = Cloth::where('product_name','like', '%'.'Áo'.'%')->get();
        $quan = Cloth::where('product_name','like', '%'.'Quần'.'%')->get();
        return view('customer.home', compact('cloths','ao','quan','specific'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $storeData = $request->validate([
            'product_name' => 'required|max:255',
            'product_description' => 'required|max:255',
            'product_price' => 'required|max:255',
            'product_image_url' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('product_image_url')) {
            $image = $request->file('product_image_url');

            // Validate file extension and MIME type
            $validExtensions = ['jpeg', 'png', 'jpg', 'gif'];
            $validMimeTypes = ['image/jpeg', 'image/png', 'image/jpg', 'image/gif'];

            if (!in_array($image->getClientOriginalExtension(), $validExtensions) || !in_array($image->getMimeType(), $validMimeTypes)) {
                // Invalid file type
                return redirect()->back()->withErrors(['product_image_url' => 'The product image must be a file of type: jpeg, png, jpg, gif.']);
            }

            // Store the file
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public/images', $imageName);
            $storeData['product_image_url'] = $imageName;
            $cloths = Cloth::create($storeData);
        }
        return redirect('/Cloths')->with('completed', 'New product has been saved!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $cloth = Cloth::findOrFail($id);
        return view('admin.show-detail',compact('cloth'));
    }

    public function showcus(string $id)
    {
        //
        $cloth = Cloth::findOrFail($id);
        return view('customer.showcus-detail',compact('cloth'));
    }



    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $cloths = Cloth::findOrFail($id);

        return view('admin.update', compact('cloths'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $updateData = $request->validate([
            'product_name' => 'required|max:255',
            'product_description' => 'required|max:255',
            'product_price' => 'required|max:255',
        ]);

        Cloth::whereId($id)->update($updateData);

        return redirect('/Cloths')->with('completed', 'This product has been saved!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $cloth = Cloth::findOrFail($id);
        $cloth->delete();
        return redirect('/Cloths')->with('completed', 'This product has been deleted');
    }

//    public function search(Request $request)
//    {
//        $search = strtolower($request->input('search'));
//
//        $cloths = Cloth::where('product_name', 'like', "%$search%")->get();
//        return view('admin.index', compact('cloths'));
//    }

    public function find($id)
    {
        $cloth = DB::table('cloths')
            ->where('id', $id)
            ->first();
        return response()->json($cloth);
    }
    public function manuf($name){
        $specific = Cloth::where('product_name','like', '%'.$name.'%')->get();
        return view('customer.home', compact('specific'));
    }

//    public function home()
//    {
//        $cloths = Cloth::all();
////        doi thanh category
//        // 1 la ao, 2 la quan
//
//        $ao = Cloth::where('product_name','like', '%'.'Áo'.'%')->get();
//        $quan = Cloth::where('product_name','like', '%'.'Quần'.'%')->get();
//        return view('customer.home', compact('cloths','ao','quan','nike'));
//    }
}



