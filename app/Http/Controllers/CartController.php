<?php

namespace App\Http\Controllers;

use App\Models\Cloth;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function showcart(string $id)
    {
        //
        $cloths = Cloth::findOrFail($id);
        return view('customer.Cart',compact('cloths'));
    }
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
    public function index()
    {
        $cart = Cart::with('product')->where('user_id', auth()->id())->get();
        return view('Customer.Cart', compact('cart'));
    }
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
}
