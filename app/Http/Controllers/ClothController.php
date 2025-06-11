<?php

namespace App\Http\Controllers;

use App\Models\brand;
use App\Models\category;
use App\Models\Cloth;
use App\Models\Order;
use App\Models\Order_items;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpOption\None;

class ClothController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
//        $admin = User::where('role','admin');

        $cloths = Cloth::all();
        $brands = Brand::all();
        $categories = category::all();
        return view('admin.index', compact('cloths','brands'));
    }

    public function home()
    {
        $specific = null;
        $cloths = Cloth::all();
//        doi thanh category
        // 1 la ao, 2 la quan
        $brands = Brand::all();
        $categories = category::all();
        return view('customer.home', compact('cloths','brands','specific','categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $brands = Brand::where('id','!=','1')->orderBy('id','asc')->get();
        $categories = category::all();
        return view('admin.create',compact('brands','categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $storeData = $request->validate([
            'product_name' => 'required|max:255',
            'product_description' => 'required|max:1000',
            'QuantityInWareHouse' => 'numeric|max:1000',
            'product_price' => 'required|max:255',
            'brand_id' => 'numeric',
            'category_id' => 'numeric',
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

        $brands = Brand::all();
        $categories = category::all();
        //
        $cloth = Cloth::findOrFail($id);

//        dd($cloth);
        return view('customer.showcus-detail',compact('cloth','brands','categories'));
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
        $quantity = Cloth::where('id',$id)->first()->QuantityInWareHouse;
        $inputQuantity = $request->inputQuantity;
//        dd($inputQuantity);

        $updated = $quantity + $inputQuantity;


        $updateData = $request->validate([
            'product_name' => 'required|max:255',
            'product_description' => 'required|max:4000',
            'product_price' => 'required|max:255',
            'QuantityInWareHouse' => 'max:255',
        ]);

        $updateData['QuantityInWareHouse'] = $updated;

        Cloth::whereId($id)->update($updateData);

        return redirect('/Cloths')->with('completed', 'This product has been saved!');
    }

//    public function updateQuantity(Request $request, string $id)
//    {
//
//        $quantity = Cloth::where('id',$id)->first()->QuantityInWareHouse;
//        $inputQuantity = $request->inputQuantity;
//        dd($inputQuantity);
//        $updateData = $request->validate([
//            'QuantityInWareHouse' => $quantity + $inputQuantity,
//        ]);
//
//        Cloth::whereId($id)->update($updateData);
//
//        return redirect('/Cloths')->with('completed', 'This product has been saved!');
//    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $cloth = Cloth::findOrFail($id);
        $cloth->delete();
        return redirect('/Cloths')->with('completed', 'This product has been deleted');
    }

    public function search(Request $request)
    {
        $specific = null;
        $search = strtolower($request->input('term'));

        $cloths = Cloth::where('product_name', 'like', "%$search%")->get();
        $brands = Brand::all();
        $categories = category::all();


        return view('customer.home', compact('cloths','categories','brands','specific'));
    }

    public function find($id)
    {
        $cloth = DB::table('cloths')
            ->where('id', $id)
            ->first();
        return response()->json($cloth);
    }
    public function manuf($name){
        $cloth = Cloth::all();
//$name = Versace

        $id = brand::where('name', $name)->first();
        $brands = Brand::where('id','!=','6')->orderBy('id','asc')->get();
        $specific = Cloth::where('brand_id', $id->id)->get();

        return view('customer.home', compact('cloth','specific','brands'));
    }
    public function orderIndex($types){
//        $pending = Order::where('status','Processed')->orderBy('id','desc')->get();
//        $delivery = Order::where('status','Shipped')->orderBy('id','desc')->get();
//        $completed = Order::where('status','Delivered')->orderBy('id','desc')->get();
//        $cancelled = Order::where('status','Canceled')->orderBy('id','desc')->get();

        $specific = $types;

        $orders = Order::where('status', $types)->orderBy('updated_at','desc')->get();
        $order_item = Order_items::all();

        return view('admin.order', compact('orders','specific'));
    }

    public function orderUpdate(Request $request, string $id){

        $updateData = $request->validate([
            'status' => 'required|max:255',
        ]);

        $products = Order_items::where('order_id',$id)->get();
        foreach($products as $product) {
            $cloth = Cloth::where('id', $product->product_id)->first();
//            $quantity = [
//                $product->quantity
            if ($updateData['status'] == "Đã hủy") {
                $quantity = [
                    "QuantityInWareHouse" => $product->quantity + $cloth->QuantityInWareHouse
                ];
                Cloth::whereId($product->product_id)->update($quantity);
            }

        }
        Order::whereId($id)->update($updateData);


        return redirect()->back();
    }

    public function orderDetails(Request $request, string $id){

        $items = Order_items::where('order_id', $id)->get();
        $order = Order::where('id', $id)->first();


        $brands = Brand::all();
        $categories = category::all();

        $role = auth()->user()->role;
//        dd($role);

        return view($role.'.order_details', compact('items','brands','categories','order'));
    }

    public function orderHistory(string $name){
//        dd($name);
        $brands = Brand::all();
        $categories = category::all();
        $userid = User::where('name',$name)->first()->id;
        $orders = Order::where('customer_id', $userid)->orderBy('updated_at','desc')->get();
        return view('customer.order_history', compact('orders','brands','categories'));
    }
    
    public function profile($id)
{
    $user = User::find($id);
    $orders = Order::where('customer_id', $id)
        ->latest()
        ->take(5)
        ->get();
    $addresses = null;
    if ($user->address) {
       $addresses = $user->address;
    }
    // dd($user);

    $donHangDaHoanThanh = Order::where('customer_id', $id)
        ->where('status', 'Đã giao')
        ->count();

    $user->donHangDaHoanThanh = $donHangDaHoanThanh;

    $donHangTrongMotThang = Order::where('customer_id', $id)
        ->where('status', 'Đã giao')
        ->whereMonth('updated_at', now()->month)
        ->count();

    $user->donHangTrongMotThang = $donHangTrongMotThang;

    $tongChiTieu = Order::where('customer_id', $id)
        ->where('status', 'Đã giao')
        ->sum('sub_total');

    $user->tongChiTieu = $tongChiTieu;


    $brands = Brand::all();
    $categories = category::all();
    if (!$user) {
        return redirect()->back()->with('error', 'User not found');
    }
    return view('customer.profile', compact('user', 'orders', 'addresses', 'brands', 'categories'));
}


    public function statistic(){

        $hourStats = [];
//        $ordersByYear = Order::where('status','Đã giao')
//            ->get()
//            ->groupBy(function($order) {
//                return $order->updated_at->format('Y');
//            })
//            ->sortBy(function($orders, $date) {
//                return $date;
//            });

        $ordersByDay = Order::where('status','Đã giao')
            ->get()
            ->groupBy(function($order) {
                return $order->updated_at->format('Y');
            })
            ->sortBy(function($orders, $date) {
                return $date;
            });
        $orders = null;
        foreach($ordersByDay as $hour => $orders) {

            $stats = (object) [
                'time' => $hour,
                'order_count' => count($orders),
                'total_subtotal' => 0
            ];

            foreach($orders as $order) {
                $stats->total_subtotal += $order->sub_total;
            }

            $stats->average_order_value = $stats->total_subtotal / $stats->order_count;

            $hourStats[] = $stats;

        }
        
//        dd($hourStats);
        $hourStatsObj = [];

        foreach($hourStats as $stats) {
            $hourStatsObj[] = $stats;
        }

        $brands = Brand::all();
        $categories = category::all();

        return view('admin.statistic', compact('orders','brands','categories','hourStatsObj'));
    }
}



