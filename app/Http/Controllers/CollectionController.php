<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use App\Models\brand;
use App\Models\category;
use App\Models\Cloth;
use App\Models\Order;
use App\Models\Order_items;
use App\Models\User;
use App\Models\collections;

class CollectionController extends Controller
{
    public function index()
    {
        $collections = collections::active()
            ->current()
            ->orderBy('sort_order')
            ->get();
            
        return view('customer.collections.index', compact('collections'));
    }

    public function show(collections $collection)
    {
        if (!$collection->is_active) {
            abort(404);
        }
        
        $products = $collection->activeProducts()->paginate(12);
        
        return view('customer.collections.show', compact('collection', 'products'));
    }
}
