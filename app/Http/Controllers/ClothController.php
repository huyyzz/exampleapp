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
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

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



        foreach ($cloths as $product){
            // dd($product->skus[0]->cloth->images[0]->image_url);
            $product->product_image_url = $product->images[0]->image_url;
        }
        

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
        'category'      => 'nullable|integer',
        'sortPrice'     => 'required|in:asc,desc',
    ]);

    $minPrice = $storeData['minPriceInput'];
    $maxPrice = $storeData['maxPriceInput'];

    $query = Cloth::whereHas('skus', function ($q) use ($minPrice, $maxPrice) {
        $q->whereRaw('CAST(price AS UNSIGNED) BETWEEN ? AND ?', [$minPrice, $maxPrice]);
    });

    if (!empty($request->category)) {
        $query->where('category_id', $request->category);
    }

    if ($request->sortOption === 'Mới nhất') {
        $query->orderBy('created_at', 'desc');
    } elseif ($request->sortOption === 'Bán chạy') {
        $bestSellers = DB::table('order_items')
            ->select('sku_id', DB::raw('SUM(quantity) as total_sold'))
            ->groupBy('sku_id')
            ->orderByDesc('total_sold')
            ->get();

        $skuBestSeller = ProductSku::whereIn('id', $bestSellers->pluck('sku_id'))->get();
        $clothIds = $skuBestSeller->pluck('cloth_id')->unique();
        $query->whereIn('id', $clothIds);
    }
    ///Dang loi moi nhat + ban chay k chay nen bo di

    $products = $query->with(['skus' => function ($q) use ($minPrice, $maxPrice) {
        $q->whereRaw('CAST(price AS UNSIGNED) BETWEEN ? AND ?', [$minPrice, $maxPrice]);
    }])->get();

    foreach ($products as $product) {
        $product->product_price = $product->skus->min('price');
    }

    $products = $products->sortBy('product_price', SORT_REGULAR, $storeData['sortPrice'] === 'desc');

    $page = $request->input('page', 1);
    $perPage = 16;
    $products = new \Illuminate\Pagination\LengthAwarePaginator(
        $products->forPage($page, $perPage),
        $products->count(),
        $perPage,
        $page,
        ['path' => $request->url(), 'query' => $request->query()]
    );

    $categories = Category::all();
    $productCount = $products->count();
    $allCount = Cloth::count();

    return view('customer.showall', compact('products', 'categories', 'productCount', 'allCount'));
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
            $index = 0;
            foreach ($request->file('product_image_url') as $image){
                // $image = $request->file('product_image_url');

                $validExtensions = ['jpeg', 'png', 'jpg', 'gif','webp'];
                $validMimeTypes = ['image/jpeg', 'image/png', 'image/jpg', 'image/gif','image/webp'];

                if (!in_array($image->getClientOriginalExtension(), $validExtensions) || !in_array($image->getMimeType(), $validMimeTypes)) {
                    return redirect()->back()->withErrors(['product_image_url' => 'The product image must be a file of type: jpeg, png, jpg, gif.']);
                }

                // Store the file
                $imageName = time() . '-' . $index . '.' . $image->getClientOriginalExtension();
                $image->storeAs('public/images', $imageName);
                $storeData['product_image_url'] = $imageName;
                $image = ProductImage::create([
                    'image_url' => $storeData['product_image_url'],
                    'cloth_id' => $product->id,
                ]);
                $index++;
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
                    'value' => strtoupper($valueName['name']),
                ]);

                $sku = ProductSku::create([
                    'cloth_id' => $product->id,
                    'sku' => strtoupper('C'.$product->id.'S-'.$valueName['name']),
                    'price' => $valueName['price'],
                    'quantity' => 0,
                    //Default 0 ti vao update change

                    //Neu them color phai sua ->S = short cai option name 
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
        // dd($cloth->images);
        $cloth->product_image_url = $cloth->images[0]->image_url;
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
        $categories = Category::all();

        return view('admin.update', compact('cloths','categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $product = Cloth::where('id',$id)->first();

        // $inputQuantity = $request->inputQuantity;

        // $updated = $quantity + $inputQuantity;


        $updateData = $request->validate([
            'product_name' => 'required|max:255',
            'product_description' => 'required|max:4000',
            'category_id' => 'required|numeric',
            'product_image_url' => 'array',
            'product_image_url.*' => 'image|mimetypes:image/jpeg,image/png,image/webp|max:16132',
        ]);

        if ($request->has('delete_images')) {
            foreach ($request->delete_images as $imageId) {
                $image = ProductImage::find($imageId);
                if ($image) {
                    Storage::delete('public/images/' . $image->image_url);
                    $image->delete();
                }
            }
        }

        if ($request->has('thumb_id')) {
            ProductImage::where('cloth_id', $product->id)->update(['isThumb' => false]);
            ProductImage::where('id', $request->thumb_id)->update(['isThumb' => true]);
        }

        if ($request->hasFile('product_image_url')) {
            foreach ($request->file('product_image_url') as $image){
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

        unset($updateData['product_image_url']);
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
        foreach ($products as $product){
            $product->product_price = $product->skus->min("price");
        }
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
            $cloth = ProductSku::where('id', $product->sku_id)->first();
            // dd($cloth);
//            $quantity = [
//                $product->quantity
            if ($updateData['status'] == "Đã hủy") {
                $quantity = [
                    "quantity" => $product->quantity + $cloth->QuantityInWareHouse
                ];
                ProductSku::whereId($product->sku_id)->update($quantity);
            }

        }
        Order::whereId($id)->update($updateData);


        return redirect()->back();
    }

    public function orderDetails(Request $request, string $id){

        $items = Order_items::where('order_id', $id)
            ->with(['sku.cloth'])
            ->get();
            
        $order = Order::where('id', $id)->first();

        $categories = category::all();

        $role = auth()->user()->role;

        foreach($items as $item){
            // dd($item->sku->cloth);
            $item->product_name = $item->sku->cloth->product_name;

            $item->product_image_url = $item->sku->cloth->images[0]->image_url;
            $item->size = $item->sku->skuValues[0]->optionValue->value;
        }

        // dd($items);

        // dd($items->cloth);

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


    public function statistic(Request $request)
    {

        $categories = Category::all();
        $orders = Order::where('status', 'Chờ duyệt đơn')->get();
        
        





        $start = $request->start_date ?? now()->startOfMonth()->toDateString();
        $end = $request->end_date ?? now()->toDateString();

        $end = date('Y-m-d', strtotime($end . ' +1 day'));

        $revenueStats = Order::selectRaw('DATE(updated_at) as time, SUM(sub_total) as total_subtotal')
            ->whereBetween('updated_at', [$start, $end])
            ->groupBy('time')
            ->orderBy('time')
            ->get();
        // dd($revenueStats);

        $earliest = Order::orderBy('updated_at','asc')->first();
        if ($earliest != null){
            $earliest = $earliest->updated_at;
            $earliest = date('Y-m-d', strtotime($earliest));
        }else{
            $earliest = date('Y-m-d');
        }
            
        
        





        return view('admin.statistic', compact(
            'orders', 'categories','revenueStats','earliest'
        ));
    }

}



