<?php

namespace App\Http\Controllers;

use App\Models\brand;
use App\Models\User;
use App\Models\Cart;
use App\Models\category;
use App\Models\Cloth;
use App\Models\Order;
use App\Models\Order_items;
use App\Models\Payment;
use App\Models\ProductSku;
use Illuminate\Http\Request;

class CartController extends Controller
{
//    public function showcart(string $id)
//    {
//        //
////        $variable = auth()->id()->get();
////        dd($variable);
//        $cart = Cart::with('product')->where('user_id', auth()->id())->get();
//        return view('Customer.Cart', compact('cart'));
//    }
//     public function store(Request $request)
//     {
//         $cart = Cart::where('user_id', auth()->id())
//             ->where('product_id', $request->product_id)
//             ->first();

//         if ($cart) {
//             $cart->quantity += $request->quantity;
//             $cart->save();
//         } else {
//             Cart::create([
//                 'user_id' => auth()->id(),
//                 'product_id' => $request->product_id,
//                 'quantity' => $request->quantity,
//             ]);
//         }

//         return redirect()->route('Customer.Cart');
//     }
// //    public function index()
// //    {
// //        $variable = auth()->id()->get();
// ////        dd($variable);
// //        $cart = Cart::with('product')->where('user_id', auth()->id())->get();
// //        return view('Customer.Cart', compact('cart'));
// //    }
//     public function update(Request $request, $id)
//     {
//         $cart = Cart::findOrFail($id);
//         $cart->quantity = $request->quantity;
//         $cart->save();

//         return redirect()->route('Customer.Cart');
//     }
//     public function destroy($id)
//     {
//         $cart = Cart::findOrFail($id);
//         $cart->delete();

//         return redirect()->route('Customer.Cart');
//     }


    public function showCartTable()
    {
        $products = Cloth::all();
        $categories = category::all();
//        dd(Session('id'));
        $user = User::where('id', Session('id'))->first();
        return view('customer.cart', compact('products','categories','user'));
    } // lay thong tin -> blade.php fetch qua session

public function addToCart(Request $request, $id)
{
    // dd('meombe');
    $product = Cloth::find($id);

    if (!$product) {
        abort(404);
    }

    $skuId = $request->sku_id;
    $quantity = (int) $request->inputQuantity;

    $sku = $product->skus()->where('id', $skuId)->first();

    if (!$sku) {
        return redirect()->back()->with('error', 'Không tìm thấy SKU đã chọn.');
    }

    $cart = session()->get('cart', []);

    // Use a unique key for each product-SKU combination
    $cartKey = $id . '-' . $skuId;

    // If cart item already exists
    if (isset($cart[$cartKey])) {
        $existingQty = $cart[$cartKey]['quantity'];
        $newQty = min($existingQty + $quantity, $sku->quantity);
        $cart[$cartKey]['quantity'] = $newQty;
    } else {
        // Add new item to cart
        $cart[$cartKey] = [
            "product_id" => $product->id,
            "sku_id" => $sku->id,
            "name" => $product->product_name,
            "size" => $sku->skuValues[0]->optionValue->value,
            "quantity" => min($quantity, $sku->quantity),
            "price" => $sku->price,
            "image" => $product->images[0]->image_url ?? null,
            "QuantityInWareHouse" => $sku->quantity
        ];
    }

    session()->put('cart', $cart);

    if ($request->wantsJson()) {
        return response()->json(['message' => 'Thêm vào giỏ hàng thành công']);
    }

    return redirect()->back()->with('success', 'Thêm vào giỏ hàng thành công');
}

    public function addToCart2(Request $request, $id)
    {
    //    dd($request);
//        dd($request->inputQuantity);
        $product = Cloth::find($id);

        if (!$product) {

            abort(404);

        }

        $cart = session()->get('cart');

        $quantity = $request->inputQuantity;
        $sku_id = $request->sku_id;


//        dd($quantity);
        if (!$cart) {
            $cart = [
                $id => [
                    "id" => $product->id,
                    "sku_id" => $sku_id,
                    "name" => $product->product_name,
                    "quantity" => $quantity,
                    "price" => $product->skus[0]->price,
                    "image" => $product->images[0]->image_url,
                    "QuantityInWareHouse" => $product->skus[0]->quantity
                ]
            ];
//            dd('dmm');
            session()->put('cart', $cart);

            return redirect()->back()->with('success', 'Thêm vào giỏ hàng thành công');
        }

        if (isset($cart[$id])) {
           dd($cart);
            if ($cart[$id]['quantity'] + $quantity > $product->QuantityInWareHouse) {
                $cart[$id]['quantity'] = $product->QuantityInWareHouse;
            } else {
                $cart[$id]['quantity'] += $quantity;
            }

            session()->put('cart', $cart);
//            dd(Session('cart'));

            return redirect()->back()->with('success', 'Thêm vào giỏ hàng thành công');
        }else {

            $cart[$id] = [
                "id" => $product->id,
                "name" => $product->product_name,
                "quantity" => 0,
                "price" => $product->product_price,
                "image" => $product->images[0]->image_url,
                "QuantityInWareHouse" => $product->QuantityInWareHouse
            ];

            if ($cart[$id]['quantity'] + $quantity > $product->QuantityInWareHouse) {
                $cart[$id]['quantity'] = $product->QuantityInWareHouse;
            }else {
                $cart[$id]['quantity'] += $quantity;
            }
//            dd($cart);
            session()->put('cart', $cart);
            return redirect()->back()->with('success', 'Thêm vào giỏ hàng thành công');
        }
        if (request()->wantsJson()) {
            return response()->json(['message' => 'Thêm vào giỏ hàng thành công']);
        }

        return redirect()->back()->with('success', 'Lỗi');
    }

    public function checkOut(Request $request)
    {
        
        $userid = User::where('id',Session('id'))->first();

        if ($userid->address == '' || $userid->phone == '') {
            return redirect()->route('profile',$userid->id)->with('Error', 'Xin vui lòng điền thông tin trước khi mua hàng.');
        }

        $validatedData = $request->validate([
            'data' => 'required|array',
            'data.*.id' => 'required|max:255',
            'data.*.quantity' => 'required|max:255',
            'payment_type' => 'required|string'
        ]);
        // dd($validatedData['payment_type']);
        if ($validatedData['payment_type'] == 'VNPAY') {
            $isOnlinePaid = 1;

        } elseif ($validatedData['payment_type'] == 'COD') {
            $isOnlinePaid = 0;
        }
        // dd($validatedData);

        $subtotal = 0;

        foreach ($validatedData['data'] as $item) {
            //$item[id]
            $cloth = ProductSku::where('id', $item['id'])->first();
            if ($cloth->quantity < $item['quantity']){
                return redirect()->back()->with('error', 'Không đủ sản phẩm có sẵn');
            }else{
                // $item['price'] = $cloth->product_price * $item['quantity'];
                // $tempprice = $item['price'];
                // $subtotal += $tempprice;
                $subtotal += $cloth->price * $item['quantity'];
                // $updateData = [
                //   'QuantityInWareHouse' => $cloth->QuantityInWareHouse - $item['quantity']
                // ];
                // Cloth::whereId($item['id'])->update($updateData);
            }
        }



        // dd($cloth);

        // $thisUser = User::where('name',Session('user_name'))->first();
        // $userid = $thisUser->id;
        $order = Order::create([
            'customer_id' => $userid->id,
            'sub_total' => $subtotal,
            'shipping_address' => $userid->address,
            'shipping_phone' => $userid->phone,
            'isOnlinePaid' => $isOnlinePaid,
        ]);

        foreach ($validatedData['data'] as $item) {
            Order_items::create([
                'order_id' => $order->id,
                'sku_id' => $item['id'],
                'quantity' => $item['quantity'],
                'product_price' => ProductSku::find($item['id'])->price,
            ]);
            // 15/6/2025
            // $cloth = Cloth::where('id', $item['id'])->first();
            // $orderItem = [
            //         'quantity' => $item['quantity'],
            //         'order_id' => $orderid,
            //         'product_id' => $item['id'],
            //         'product_price' => $cloth['product_price']
            //     ];

            // Order_items::create($orderItem);
        }
        $payment = Payment::create([
            'order_id' => $order->id,
            'description' => 'Thanh toán đơn hàng #' . $order->id,
            'sub_total' => $subtotal,
            'payment_type' => $request->payment_type,
            'status' => 'Chờ xác nhận'
        ]);

        if ($request->payment_type == 'VNPAY') {
            // dd($request);
            return redirect()->route('vnpay_index', [
                'order_id' => $order->id,
                'payment_id' => $payment->id,
                'amount' => $subtotal
            ]);
        }
        if ($request->payment_type == 'COD'){
            //COD
            foreach ($validatedData['data'] as $item) {
                $cloth = ProductSku::find($item['id']);
                $cloth->quantity -= $item['quantity'];
                $cloth->save();
            }
        }


        
        session()->forget('cart');
        return redirect()->route('customer.home')->with('success', 'Đặt hàng thành công!');
    }

    public function removeCartItem(Request $request)
    {
        if ($request->id) {

            $cart = session()->get('cart');

            if (isset($cart[$request->id])) {

                unset($cart[$request->id]);

                session()->put('cart', $cart);
            }

            session()->flash('success', 'Xóa khỏi giỏ hàng thành công');
        }
    }

    public function clearCart()
    {
        session()->forget('cart');
        return redirect()->back();
    }

    public function showProducts()
    {
        $products = Cloth::all();
        // $brands = Brand::all();
        $categories = category::all();
        return view('welcome', compact('products'));
    }


}
