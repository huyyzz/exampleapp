<?php

namespace App\Http\Controllers;

use App\Models\ProductSku;
use Illuminate\Http\Request;

class SkuController extends Controller
{
    public function update(Request $request)
    {
        $data = $request->validate([
            'id' => 'required|numeric',
            'quantity' => 'required|numeric',
        ]);


        
        $sku = ProductSku::findOrFail($data['id']);

        $data['quantity'] += $sku->quantity;
        
        $sku->update($data);
        
        return back()->with("success",'Cập nhật thành công');
    }
}
