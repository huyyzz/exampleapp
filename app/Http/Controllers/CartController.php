<?php

namespace App\Http\Controllers;

use App\Models\brand;
use App\Models\User;
use App\Models\Cart;
use App\Models\category;
use App\Models\Cloth;
use App\Models\Order;
use App\Models\Order_items;
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
    public function store(Request $request)
    {
        $cart = Cart::where('user_id', auth()->id())
            ->where('product_id', $request->product_id)
            ->first();

        if ($cart) {
            $cart->quantity += $request->quantity;
            $cart->save();
        } else {
            Cart::create([
                'user_id' => auth()->id(),
                'product_id' => $request->product_id,
                'quantity' => $request->quantity,
            ]);
        }

        return redirect()->route('Customer.Cart');
    }
//    public function index()
//    {
//        $variable = auth()->id()->get();
////        dd($variable);
//        $cart = Cart::with('product')->where('user_id', auth()->id())->get();
//        return view('Customer.Cart', compact('cart'));
//    }
    public function update(Request $request, $id)
    {
        $cart = Cart::findOrFail($id);
        $cart->quantity = $request->quantity;
        $cart->save();

        return redirect()->route('Customer.Cart');
    }
    public function destroy($id)
    {
        $cart = Cart::findOrFail($id);
        $cart->delete();

        return redirect()->route('Customer.Cart');
    }
    public function showCartTable()
    {
        $products = Cloth::all();
        $brands = Brand::all();
        $categories = category::all();
//        dd(Session('id'));
        $user = User::where('id', Session('id'))->first();
        return view('customer.cart', compact('products','brands','categories','user'));
    } // lay thong tin -> blade.php fetch qua session



    public function addToCart(Request $request,$id)
    {
//        dd($id);
//        dd($request->inputQuantity);
        $product = Cloth::find($id);

        if (!$product) {

            abort(404);

        }

        $cart = session()->get('cart');

        $quantity = $request->inputQuantity;
//        dd($quantity);
        if (!$cart) {
            $cart = [
                $id => [
                    "id" => $product->id,
                    "name" => $product->product_name,
                    "quantity" => $quantity,
                    "price" => $product->product_price,
                    "image" => $product->product_image_url,
                    "QuantityInWareHouse" => $product->QuantityInWareHouse
                ]
            ];
//            dd('dmm');
            session()->put('cart', $cart);

            return redirect()->back()->with('success', 'Thêm vào giỏ hàng thành công');
        }

        if (isset($cart[$id])) {
//            dd($cart);
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
                "image" => $product->product_image_url,
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

        return redirect()->back()->with('success', 'Lôiz');
    }

    public function checkOut(Request $request)
    {
        // Assuming your returning entire request payload
        $userid = User::where('id',Session('id'))->first();
        if ($userid->address == '' || $userid->phone == '') {
            return redirect()->route('profile',$userid->id)->with('Error', 'Xin vui lòng điền thông tin trước khi mua hàng.');
        }

        $validatedData = $request->validate([
            'data' => 'required|array',
            'data.*.id' => 'required|max:255',
            'data.*.quantity' => 'required|max:255',
        ]);

//        dd(Session('user_name'));

        $subtotal = 0;

        foreach ($validatedData['data'] as $item) {
            //$item[id]
            $cloth = Cloth::where('id', $item['id'])->first();
            if ($cloth->QuantityInWareHouse < $item['quantity']){
                return redirect()->back()->with('error', 'Không đủ sản phẩm có sẵn');
            }else{
                $item['price'] = $cloth->product_price * $item['quantity'];
                $tempprice = $item['price'];
                $subtotal += $tempprice;
                $updateData = [
                  'QuantityInWareHouse' => $cloth->QuantityInWareHouse - $item['quantity']
                ];
                Cloth::whereId($item['id'])->update($updateData);
            }
        }
        $thisUser = User::where('name',Session('user_name'))->first();
        $userid = $thisUser->id;
        $order = [
            'customer_id' => $userid,
            'sub_total' => $subtotal
        ];
            $orderid = Order::create($order)->id;

            //tinh tien
        foreach ($validatedData['data'] as $item) {
//            dd($item);
            $cloth = Cloth::where('id', $item['id'])->first();
            $orderItem = [
                    'quantity' => $item['quantity'],
                    'order_id' => $orderid,
                    'product_id' => $item['id'],
                    'product_price' => $cloth['product_price']
                ];

                Order_items::create($orderItem);
        }
//            $order['subtotal'] = $item['price'] * $item['quantity'];

//            $item['image'] = $cloth->product_image_url;
//        $cloth = Cloth::create($validatedData);
        session()->forget('cart');
        return redirect()->route('customer.home')->with('success', 'Product placed successfully!');
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
        $brands = Brand::all();
        $categories = category::all();
        return view('welcome', compact('products'));
    }


}
