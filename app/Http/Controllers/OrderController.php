<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\category;
use App\Models\Cloth;
use App\Models\Order;
use App\Models\Order_items;
use App\Models\ProductImage;
use App\Models\Option;
use App\Models\ProductSku;
use App\Models\OptionValue;
use App\Models\User;
class OrderController extends Controller
{
    public function search(Request $request, $types)
    {
        $validated = $request->validate([
            'term' => 'required|string|max:255',
            'type' => 'required|in:order_id,customer_id,shipping_code,shipping_phone',
        ]);

        $search = strtolower($validated['term']);
        $type = $validated['type'];

        $query = Order::query();

        switch ($type) {
            case 'order_id':
                $query->whereRaw('CAST(id AS CHAR) LIKE ?', ["%$search%"]);
                break;
            case 'customer_id':
                $query->whereRaw('CAST(customer_id AS CHAR) LIKE ?', ["%$search%"]);
                break;
            case 'shipping_code':
                $query->whereRaw('LOWER(shipping_code) LIKE ?', ["%$search%"]);
                break;
            case 'shipping_phone':
                $query->whereRaw('LOWER(shipping_phone) LIKE ?', ["%$search%"]);
                break;
        }
        
        if (!empty($types)) {
            $query->where('status', $types);
        }

        $orders = $query->paginate(16);
        $specific = $types;

        return view('admin.order', compact('orders', 'type', 'search','specific'));
    }
}
