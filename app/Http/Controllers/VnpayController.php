<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Cloth;
use App\Models\Order;
use App\Models\Order_items;
use App\Models\Payment;

class VnpayController extends Controller
{
    public function index(Request $request)
    {

        date_default_timezone_set('Asia/Ho_Chi_Minh');


        $orderId = $request->get('order_id');
        $order = Order::findOrFail($orderId);

        // VNPay config
        $vnp_TmnCode = env('vnp_TmnCode');
        $vnp_HashSecret = env('vnp_HashSecret');
        $vnp_Url = env('vnp_Url');



        $vnp_Returnurl = route('vnpay.return');
        // dd($vnp_Returnurl);

        $vnp_TxnRef = $order->id;
        $vnp_OrderInfo = "Thanh toan GD: " . $order->id;
        $vnp_OrderType = 'other';
        $vnp_Amount = $order->sub_total * 100;
        $vnp_Locale = 'vn';
        $vnp_BankCode = $request->bank_code;
        $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];

        

        // dd($vnp_IpAddr);

        
        $vnp_CreateDate = date('YmdHis');
        $vnp_ExpireDate = date('YmdHis', strtotime('+15 minutes'));
        // dd([
        //     'now' => date('YmdHis'),
        //     'expire' => date('YmdHis', strtotime('+15 minutes')),
        // ]);
        $inputData = array(
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => $vnp_CreateDate,
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => $vnp_Returnurl,
            "vnp_ExpireDate" => $vnp_ExpireDate,
            "vnp_TxnRef" => $vnp_TxnRef,
        );
        $inputData['vnp_BankCode'] = "NCB";

        if (!empty($vnp_BankCode)) {
            $inputData['vnp_BankCode'] = $vnp_BankCode;
        }
        // if (empty($vnp_BankCode)) {
        //     $inputData['vnp_BankCode'] = "NCB";
        // }
        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashdata .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }

        $vnp_Url = $vnp_Url . "?" . $query;
        if (isset($vnp_HashSecret)) {
            $vnpSecureHash = hash_hmac('sha512', $hashdata, $vnp_HashSecret);
            $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        }
        // dd($vnp_Url);
        return redirect($vnp_Url);
    }
    public function return(Request $request)
    {
        $inputData = $request->all();

        $vnp_HashSecret = env('VNP_HASHSECRET');
        $vnp_SecureHash = $inputData['vnp_SecureHash'];
        unset($inputData['vnp_SecureHash']);
        unset($inputData['vnp_SecureHashType']);

        ksort($inputData);
        $hashData = "";
        $i = 0;
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashData .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashData .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
        }
        $secureHash = hash_hmac('sha512', $hashData, $vnp_HashSecret);
        
        if ($secureHash == $vnp_SecureHash) {
            if ($inputData['vnp_ResponseCode'] == '00') {
                // Payment Success
                $order = Order::find($inputData['vnp_TxnRef']);
                // $order->update(['status' => 'Đang giao hàng']);

                $items = Order_items::where("order_id", "=" ,$inputData['vnp_TxnRef'])->get();
                foreach($items as $item){
                    $cloth = Cloth::find($item['product_id']);
                    $cloth->QuantityInWareHouse -= $item['quantity'];
                    $cloth->save();
                }

                Payment::create([
                    'order_id' => $order->id,
                    'description' => "Thanh Toánn đơn hàng #" . $order->id,
                    'sub_total' => $order->sub_total,
                    'payment_type' => 'VNPAY',
                    'status' => 'Đã thanh toán',
                    'p_note' => $inputData['vnp_OrderInfo'] ?? null,
                    'p_vnp_response_code' => $inputData['vnp_ResponseCode'] ?? null,
                    'p_code_vnpay' => $inputData['vnp_TransactionNo'] ?? null,
                    'p_code_bank' => $inputData['vnp_BankCode'] ?? null,
                    'p_time' => now(),
                ]);
                session()->forget('cart');
                return redirect()->route('customer.home')->with('success', 'Thanh toán thành công');
            } else {
                //Giao dich khong thanh cong
                $order = Order::find($inputData['vnp_TxnRef']);
                $order->update(['status' => 'Đã hủy']);


                
                return redirect()->route('customer.home')->with('error', 'Giao dịch không thành công');
            }
        } else {
            return redirect()->route('customer.home')->with('error', 'Sai chữ ký');
        }
    }
    public function vnpayReturn(Request $request)
    {
        
        $orderId = $request->query('order_id');
        $paymentId = $request->query('payment_id');
        $responseCode = $request->query('vnp_ResponseCode');

        $payment = Payment::find($paymentId);
        $order = Order::find($orderId);

        if (!$payment || !$order) {
            return redirect()->route('customer.home')->with('error', 'Giao dịch không hợp lệ.');
        }

        if ($responseCode === '00') {
            // Payment successful
            foreach ($order->items as $item) {
                $cloth = Cloth::find($item->product_id);
                if ($cloth->QuantityInWareHouse < $item->quantity) {
                    return redirect()->route('customer.home')->with('error', 'Không đủ hàng sau khi thanh toán.');
                }

                $cloth->QuantityInWareHouse -= $item->quantity;
                $cloth->save();
            }

            $payment->update([
                'p_code_vnpay' => $request->query('vnp_TxnRef'),
                'p_code_bank' => $request->query('vnp_BankCode'),
                'p_vnp_response_code' => $responseCode,
                'p_time' => now(),
                'status' => 'Đã thanh toán'
            ]);

            return redirect()->route('customer.home')->with('success', 'Thanh toán VNPay thành công!');
        }

        $payment->update([
            'status' => 'Đã hủy',
            'p_vnp_response_code' => $responseCode,
            'p_time' => now()
        ]);

        return redirect()->route('customer.home')->with('error', 'Thanh toán thất bại.');
    }
}
