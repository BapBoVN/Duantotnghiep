<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Session;

class VNPayController extends Controller
{
    public function createPayment(Request $request)
    {
        $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        $vnp_Returnurl = "http://localhost:8000/vnpay-return";
        $vnp_TmnCode = "2QXUI4J4";
        $vnp_HashSecret = "NRXFKVLPMQPHGKFKVJBVUCXINHDPTOEH";

        $vnp_TxnRef = date('YmdHis');
        $vnp_OrderInfo = 'Thanh toan don hang test';
        $vnp_OrderType = 'billpayment';
        $vnp_Amount = \Helper::totalCartPrice() * 100;
        $vnp_Locale = 'vn';
        $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];
        $vnp_CreateDate = date('YmdHis');

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
            "vnp_TxnRef" => $vnp_TxnRef
        );

        // Log dữ liệu dạng text thường
        file_put_contents(
            storage_path('logs/vnpay.log'), 
            "------------- " . date('Y-m-d H:i:s') . " -------------\n" .
            "Input Data:\n" . 
            print_r($inputData, true) . 
            "\n",
            FILE_APPEND
        );

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

        $vnpSecureHash = hash_hmac('sha512', $hashdata, $vnp_HashSecret);
        $vnp_Url = $vnp_Url . "?" . $query;
        $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;

        // Log URL cuối cùng
        file_put_contents(
            storage_path('logs/vnpay.log'),
            "Final URL:\n" . $vnp_Url . "\n\n",
            FILE_APPEND
        );

        return redirect($vnp_Url);
    }

    public function vnpayReturn(Request $request)
    {
        if($request->vnp_ResponseCode == "00") {
            $orderData = Session::get('order_data');
            
            $order = new Order();
            $order->user_id = auth()->user()->id;
            $order->order_number = $request->vnp_TxnRef;
            $order->payment_method = 'vnpay';
            $order->payment_status = 'paid';
            $order->status = 'processing';
            $order->save();

            Session::forget('order_data');
            
            return redirect()->route('home')->with('success', 'Đã thanh toán đơn hàng thành công');
        }
        return redirect()->route('home')->with('error', 'Lỗi trong quá trình thanh toán');
    }
} 