<?php

namespace App\Http\Controllers;

use App\Models\category;
use App\Models\Cloth;
use App\Models\Order;
use App\Models\Order_items;
use App\Models\ProductImage;
use App\Models\Option;
use App\Models\ProductSku;
use App\Models\OptionValue;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpOption\None;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;


use App\Models\collections;
use App\Models\SkuValue;

class ClothController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
//        $admin = User::where('role','admin');

        $cloths = Cloth::all();
        $categories = category::all();
        $orders = Order::where("status",'=','Chờ duyệt đơn')->get();




        

        return view('admin.index', compact('cloths','categories','orders'));
    }

    public function home2()
    {
        $specific = null;
        $products = Cloth::paginate(16);
        $categories = category::all();

        $productCount = Count($products);
        $allCount = Count(Cloth::all());
        // $sizes = $cloths->variants();
        foreach ($products as $product){
            $product->product_price = $product->skus->min("price");
        }

        

        return view('customer.showall', compact('products','categories','productCount','allCount'));
    }

    public function filter(Request $request)
    {
        $storeData = $request->validate([
            'minPriceInput' => 'required|numeric|min:0',
            'maxPriceInput' => 'required|numeric|min:0|gte:minPriceInput',
            // 'size' => 'nullable|array',
            'category' => 'nullable|integer',
            'sortPrice'     => 'required|in:asc,desc',
        ]);

        // dd($request->sortPrice);

        $specific = null;
        $minPrice = $storeData['minPriceInput'];
        $maxPrice = $storeData['maxPriceInput'];
        



        $query = Cloth::query();
        
        
        if ($request->sortOption === 'Mới nhất') {
            $query->orderBy('created_at', 'desc');
        } elseif ($request->sortOption === 'Bán chạy') {
            $bestSellerIds = DB::table('order_items')
                ->select('product_id', DB::raw('SUM(quantity) as total_sold'))
                ->groupBy('product_id')
                ->orderByDesc('total_sold')
                ->pluck('product_id');

            $query->whereIn('id', $bestSellerIds);
        }

        // $discount = random
        if (empty($request->category)){
            $products = Cloth::whereRaw('CAST(product_price AS UNSIGNED) BETWEEN ? AND ?', [$minPrice, $maxPrice])
            ->orderByRaw('CAST(product_price AS UNSIGNED) '.$request->sortPrice)
            ->paginate(16);
        }else{
            $products = Cloth::whereRaw('CAST(product_price AS UNSIGNED) BETWEEN ? AND ?', [$minPrice, $maxPrice])
            ->orderByRaw('CAST(product_price AS UNSIGNED) '.$request->sortPrice)
            ->where('category_id', $request->category)
            ->paginate(16);
        }


        

        // dd($request->category);

        $categories = category::all();

        $productCount = Count($products);
        $allCount = Count(Cloth::all());


        

        

        // $sizes = $cloths->variants();
        return view('customer.showall', compact('products','categories','productCount','allCount'));
    }

    public function home()
    {
        
        $specific = null;
        $cloths = Cloth::all();
        $categories = category::all();

        foreach ($cloths as $product){
            $product->product_price = $product->skus->min("price");
        }


        $featuredCollections = collections::active()
            ->current()
            ->where('show_on_homepage', true)
            ->orderBy('sort_order')
            ->take(3)
            ->get();


        // $bestSellers = DB::table('order_items')
        //     ->select('product_id', DB::raw('SUM(quantity) as total_sold'))
        //     ->groupBy('product_id')
        //     ->orderByDesc('total_sold')
        //     ->limit(8)
        //     ->get();

        $bestSellers = DB::table('order_items')
            ->select('sku_id', DB::raw('SUM(quantity) as total_sold'))
            ->groupBy('sku_id')
            ->orderByDesc('total_sold')
            ->limit(5)
            ->get();

        $productIds = $bestSellers->pluck('sku_id');
        

        $skuBestSeller = ProductSku::whereIn('id', $productIds)->get();
        $productBestSeller = Cloth::whereIn('id', $skuBestSeller->pluck("cloth_id"))->get();


        // dd($productBestSeller);
        
        foreach ($productBestSeller as $product){
            $product->product_price = $product->skus->min("price");
        }

        return view('customer.home', compact('cloths','specific','categories','featuredCollections','productBestSeller'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = category::all();
        return view('admin.create',compact('categories'));
    }
    private function generateCombinations(array $arrays)
    {
        if (empty($arrays)) return [];

        $result = [[]];

        foreach ($arrays as $propertyValues) {
            $temp = [];

            foreach ($result as $partialCombination) {
                foreach ($propertyValues as $value) {
                    $temp[] = array_merge($partialCombination, [$value]);
                }
            }

            $result = $temp;
        }

        return $result;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // $storeData = $request->validate([
        //     'product_name' => 'required|max:255',
        //     'product_description' => 'required|max:1000',
        //     'QuantityInWareHouse' => 'numeric|max:1000',
        //     'product_price' => 'required|max:255',
        //     'category_id' => 'numeric',
        //     'product_image_url' => 'required|image|mimes:jpeg,png,jpg,gif|max:16132',
        // ]);
        // dd($request->all());

        $storeData = $request->validate([
            'product_name' => 'required|string|max:255',
            // 'product_price' => 'nullable|numeric',
            'product_description' => 'nullable|string',
            'category_id' => 'nullable|exists:categories,id',
            'product_image_url' => 'required|array',
            'product_image_url.*' => 'image|mimetypes:image/jpeg,image/png,image/webp|max:16132',
            'options' => 'required|array',
            'options.*.name' => 'required|string|max:255',
            'options.*.values' => 'required|array|min:1',
            'options.*.values.*.name' => 'required|string|max:255',
            'options.*.values.*.price' => 'required|numeric|min:0',
        ]);
        // dd($storeData);

        $product = Cloth::create([
            'product_name' => $storeData['product_name'],
            'product_description' => $storeData['product_description'],
            'category_id' => $storeData['category_id'],
        ]);

        if ($request->hasFile('product_image_url')) {
            foreach ($request->file('product_image_url') as $image){
                // $image = $request->file('product_image_url');

                $validExtensions = ['jpeg', 'png', 'jpg', 'gif','webp'];
                $validMimeTypes = ['image/jpeg', 'image/png', 'image/jpg', 'image/gif','image/webp'];

                if (!in_array($image->getClientOriginalExtension(), $validExtensions) || !in_array($image->getMimeType(), $validMimeTypes)) {
                    return redirect()->back()->withErrors(['product_image_url' => 'The product image must be a file of type: jpeg, png, jpg, gif.']);
                }

                // Store the file
                $imageName = time() . '-' . $product->id . '.' . $image->getClientOriginalExtension();
                $image->storeAs('public/images', $imageName);
                $storeData['product_image_url'] = $imageName;
                $image = ProductImage::create([
                    'image_url' => $storeData['product_image_url'],
                    'cloth_id' => $product->id,
                ]);
            }
        }
        

        $allOptionValueIds = [];

        foreach ($storeData['options'] as $optionData) {
            // ORM lay option cua product
            // public function options()
            // {
            //     return $this->hasMany(Option::class);
            // }
            //Create entity option co name va OptionValue chua name 
            $option = Option::create([
                'cloth_id' => $product->id,
                'name' => $optionData['name'],
            ]);

            $valueIds = [];

            foreach ($optionData['values'] as $valueName) {
                $value = OptionValue::create([
                    'option_id' => $option->id,
                    'value' => $valueName['name'],
                ]);

                $sku = ProductSku::create([
                    'cloth_id' => $product->id,
                    'sku' => strtoupper('C'.$product->id.'S-'.$valueName['name']),
                    'price' => $valueName['price'],
                    'quantity' => 0,
                    //Default 0 ti vao update change
                ]);
                // dd($sku->id);
                $skuValue = SkuValue::create([
                    'product_sku_id' => $sku->id,
                    'option_id' => $option->id,
                    'option_value_id' => $value->id,
                ]);
                // $valueIds[] = $value->id;
            }

            // $allOptionValueIds[] = $valueIds;
        }

        // if ($request->hasFile('product_image_url')) {
        //     $image = $request->file('product_image_url');

        //     // Validate file extension and MIME type
        //     $validExtensions = ['jpeg', 'png', 'jpg', 'gif'];
        //     $validMimeTypes = ['image/jpeg', 'image/png', 'image/jpg', 'image/gif'];

        //     if (!in_array($image->getClientOriginalExtension(), $validExtensions) || !in_array($image->getMimeType(), $validMimeTypes)) {
        //         // Invalid file type
        //         return redirect()->back()->withErrors(['product_image_url' => 'The product image must be a file of type: jpeg, png, jpg, gif.']);
        //     }

        //     // Store the file
        //     $imageName = time() . '.' . $image->getClientOriginalExtension();
        //     $image->storeAs('public/images', $imageName);
        //     $storeData['product_image_url'] = $imageName;
        //     // $cloths = Cloth::create($storeData);
        // }
        return redirect('/Cloths')->with('completed', 'New product has been saved!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $cloth = Cloth::findOrFail($id);
        return view('admin.product_detail_2',compact('cloth'));
        // return view('admin.show-detail',compact('cloth'));
    }

    public function showcus(string $id)
    {
        $categories = category::all();
        //
        $cloth = Cloth::findOrFail($id);

//        dd($cloth);
        return view('customer.showcus-detail',compact('cloth','categories'));
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
            'product_image_url' => 'image|mimes:jpeg,png,jpg,gif|max:16132',
        ]);

        $updateData['QuantityInWareHouse'] = $updated;




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
            $updateData['product_image_url'] = $imageName;
        }else{
            $updateData['product_image_url'] = Cloth::where('id',$id)->first()->product_image_url;
        }

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
        // $categories = category::all();
        $products = Cloth::where('product_name', 'like', "%$search%")->paginate(16);
        $categories = category::all();

        $productCount = Count($products);
        $allCount = Count(Cloth::where('product_name', 'like', "%$search%")->get());


        return view('customer.showall', compact('products','categories','allCount','productCount','specific'));
    }

    public function find($id)
    {
        $cloth = DB::table('cloths')
            ->where('id', $id)
            ->first();
        return response()->json($cloth);
    }
    public function orderIndex($types){
//        $pending = Order::where('status','Processed')->orderBy('id','desc')->get();
//        $delivery = Order::where('status','Shipped')->orderBy('id','desc')->get();
//        $completed = Order::where('status','Delivered')->orderBy('id','desc')->get();
//        $cancelled = Order::where('status','Canceled')->orderBy('id','desc')->get();

        $specific = $types;

        $orders = Order::where('status', $types)->orderBy('updated_at','asc')->get();
        $order_item = Order_items::all();

        return view('admin.order', compact('orders','specific'));
    }

    public function orderUpdate(Request $request, string $id){

        $updateData = $request->validate([
            'status' => 'required|max:255',
        ]);

        if ($request->status == 'Đang giao hàng'){
            $updateData['shipment_code'] = $request->shipment_code;
        }
        if ($request->status == 'Đã giao'){
            $updateData['isPaid'] = 1;
        }

        $products = Order_items::where('order_id',$id)->get();
        foreach($products as $product) {
            $cloth = Cloth::withTrashed()->where('id', $product->product_id)->first();
            // dd($cloth);
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

        $items = Order_items::where('order_id', $id)
            ->with(['cloths' => function ($query) {
                $query->withTrashed();
            }])->get();

            
        $order = Order::where('id', $id)->first();

        $categories = category::all();

        $role = auth()->user()->role;
        // dd($items->cloths);

        return view($role.'.order_details', compact('items','categories','order'));
    }

    public function orderHistory(string $id){
//        dd($name);
        if (Auth::id() != $id) {
            abort(403, 'Unauthorized access');
        }
        $categories = category::all();
        // $userid = User::where('id', $name)->first()->id;
        $orders = Order::where('customer_id', $id)->orderBy('updated_at','desc')->get();
        return view('customer.order_history', compact('orders','categories'));
    }
    
    public function profile($id)
{   
    if (Auth::id() != $id) {
        abort(403, 'Unauthorized access');
    }
    $user = User::find($id);
    $orders = Order::where('customer_id', $id)
        ->latest()
        ->paginate(5);
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

    // dd($donHangTrongMotThang);

    $user->donHangTrongMotThang = $donHangTrongMotThang;

    $tongChiTieu = Order::where('customer_id', $id)
        ->where('status', 'Đã giao')
        ->sum('sub_total');

    $user->tongChiTieu = $tongChiTieu;

    $since = $user->created_at;
    $user->since = $since;

    $categories = category::all();
    if (!$user) {
        return redirect()->back()->with('error', 'User not found');
    }
    return view('customer.profile', compact('user', 'orders', 'addresses', 'categories'));
}


    public function statistic(){

        $hourStats = [];
        $ordersByDay = Order::where('status','Đã giao')
            ->get()
            ->groupBy(function($order) {
                return $order->updated_at->format('D');
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

        $yearStats = [];
        $ordersByYear = Order::where('status','Đã giao')
            ->get()
            ->groupBy(function($order) {
                return $order->updated_at->format('Y');
            })
            ->sortBy(function($orders, $date) {
                return $date;
            });
        $orders = null;
        foreach($ordersByYear as $year => $orders) {

            $stats = (object) [
                'time' => $year,
                'order_count' => count($orders),
                'total_subtotal' => 0
            ];

            foreach($orders as $order) {
                $stats->total_subtotal += $order->sub_total;
            }

            $stats->average_order_value = $stats->total_subtotal / $stats->order_count;

            $yearStats[] = $stats;

        }
        
//        dd($hourStats);
        $yearStatsObj = [];

        foreach($yearStats as $stats) {
            $yearStatsObj[] = $stats;
        }

        $categories = category::all();


        $monthStats = Order::where('status','Đã giao')
            ->get()
            ->groupBy(function($order) {
                return $order->updated_at->format('M');
            })
            ->sortBy(function($orders, $date) {
                return $date;
            });
        $orders = null;
        foreach($monthStats as $month => $orders) {
            $stats = (object) [
                'time' => $month,
                'order_count' => count($orders),
                'total_subtotal' => 0
            ];

            foreach($orders as $order) {
                $stats->total_subtotal += $order->sub_total;
            }

            $stats->average_order_value = $stats->total_subtotal / $stats->order_count;

            $monthStats[] = $stats;

        }
        $monthStatsObj = [];
        foreach($monthStats as $stats) {
            $monthStatsObj[] = $stats;
        }



        $orders = Order::where('status','Chờ duyệt đơn')->get();
        // dd($orders);

        

        return view('admin.statistic', compact('orders','categories','hourStatsObj', 'yearStatsObj','monthStatsObj'));
    }
}



