<?php

namespace App\Http\Controllers;

use App\Models\ProductSku;
use App\Models\Option;
use App\Models\OptionValue;
use App\Models\SkuValue;
use App\Models\Cloth;
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
    public function create(Request $request)
    {
        
        try {
            $data = $request->validate([
                'cloth_id' => 'required|numeric',
                'price' => 'required|numeric',
                'size' => 'required|string|max:255'
            ]);

        } catch (\Illuminate\Validation\ValidationException $e) {
            dd('Validation failed', $e->errors());
        }

        $data['size'] = strtoupper($data['size']);

        //Tại vì website hiện tại chỉ có option là size nên để như này nếu thêm color thì lỗi
        $option = Option::where("cloth_id",$data['cloth_id'])->first();

        $value = OptionValue::create([
                    'option_id' => $option->id,
                    'value' => $data["size"],
                ]);

        $sku = ProductSku::create([
            'cloth_id' => $data['cloth_id'],
            'sku' => strtoupper('C'.$data['cloth_id'].'S-'.$data["size"]),
            'price' => $data["price"],
            'quantity' => 0,
            //Default 0 ti vao update change
        ]);

        // dd($sku->id);
        $skuValue = SkuValue::create([
            'product_sku_id' => $sku->id,
            'option_id' => $option->id,
            'option_value_id' => $value->id,
        ]);
        
        return back()->with("success",'Tạo size mới thành công');
    }
}
