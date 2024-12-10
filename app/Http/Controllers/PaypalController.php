<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Srmklive\PayPal\Services\PayPal as PayPalClient;
use App\Models\Order;
use Illuminate\Support\Facades\Session;
use App\Models\Cart;
use Illuminate\Support\Facades\DB;

class PayPalController extends Controller
{
    private $provider;

    public function __construct()
    {
        $this->provider = new PayPalClient;
        $this->provider->getAccessToken();
    }

    public function createPayment(Request $request)
    {
        try {
            \Log::info('PayPal Create Payment Request:', $request->all());
            
            // Lưu thông tin đặt hàng vào session
            Session::put('order_data', $request->all());

            $total = number_format(\Helper::totalCartPrice()/23000, 2, '.', '');
            \Log::info('PayPal Amount:', ['total' => $total]);

            $response = $this->provider->createOrder([
                'intent' => 'CAPTURE',
                'purchase_units' => [
                    [
                        'amount' => [
                            'currency_code' => 'USD',
                            'value' => $total
                        ]
                    ]
                ],
                'application_context' => [
                    'return_url' => route('paypal.success'),
                    'cancel_url' => route('paypal.cancel')
                ]
            ]);
            \Log::info('PayPal Create Order Response:', $response);

            if (isset($response['id']) && $response['id'] != null) {
                foreach ($response['links'] as $link) {
                    if ($link['rel'] === 'approve') {
                        return redirect()->away($link['href']);
                    }
                }
            }

            \Log::error('PayPal Create Order Failed:', $response);
            return redirect()->route('checkout')->with('error', 'Có lỗi xảy ra.');

        } catch (\Exception $e) {
            \Log::error('PayPal Create Payment Error:', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return redirect()->route('checkout')->with('error', $e->getMessage());
        }
    }

    public function success(Request $request)
    {
        try {
            \Log::info('PayPal Success Response:', ['token' => $request->token]);
            
            $response = $this->provider->capturePaymentOrder($request->token);
            \Log::info('PayPal Capture Response:', $response);

            if (isset($response['status']) && $response['status'] == 'COMPLETED') {
                // Lấy thông tin giỏ hàng
                $total = \Helper::totalCartPrice();
                
                // Lấy thông tin đặt hàng từ session
                $orderData = Session::get('order_data');
                \Log::info('Order Data:', $orderData);
                
                // Tạo đơn hàng
                $order = new Order();
                $order->user_id = auth()->user()->id;
                $order->order_number = uniqid();
                $order->sub_total = $total;
                $order->total_amount = $total;
                $order->quantity = \Helper::cartCount();
                $order->payment_status = 'paid';
                $order->payment_method = 'paypal';
                $order->status = 'process';
                
                // Thêm thông tin người đặt hàng
                $order->first_name = $orderData['first_name'] ?? '';
                $order->last_name = $orderData['last_name'] ?? '';
                $order->email = $orderData['email'] ?? '';
                $order->phone = $orderData['phone'] ?? '';
                $order->country = $orderData['country'] ?? 'VN';
                $order->address1 = $orderData['address1'] ?? '';
                $order->address2 = $orderData['address2'] ?? '';
                
                // Thêm thông tin shipping từ session nếu có
                if(session('shipping')) {
                    $order->shipping_id = session('shipping')['id'];
                    $order->shipping = session('shipping')['price'];
                }
                
                // Thêm thông tin coupon nếu có
                if(session('coupon')) {
                    $order->coupon = session('coupon')['value'];
                }

                $order->save();
                \Log::info('Order Created:', $order->toArray());

                // Lưu chi tiết đơn hàng
                if($order) {
                    $carts = \Helper::getAllProductFromCart();
                    foreach($carts as $cart) {
                        $cart->order_id = $order->id;
                        $cart->user_id = auth()->user()->id;
                        $cart->save();
                    }
                }

                // Xóa giỏ hàng
                Cart::where('user_id', auth()->user()->id)
                    ->where('order_id', null)
                    ->delete();

                // Xóa các session liên quan
                Session::forget(['order_data', 'coupon', 'shipping']);

                return redirect()->route('home')->with('success', 'Thanh toán thành công!');
            }

            \Log::error('PayPal Status Not Completed:', $response);
            return redirect()->route('checkout')->with('error', 'Thanh toán thất bại.');

        } catch (\Exception $e) {
            \Log::error('PayPal Error:', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return redirect()->route('checkout')->with('error', $e->getMessage());
        }
    }

    public function cancel()
    {
        return redirect()->route('checkout')->with('error', 'Bạn đã hủy thanh toán PayPal.');
    }

    public function payment(Request $request){
        try {
            DB::beginTransaction();
            
            // Tạo order trước
            $order = Order::create([
                // ... thông tin order
            ]);
            
            // Log để kiểm tra ID của order vừa tạo
            \Log::info('Created order ID: ' . $order->id);
            
            // Cập nhật cart
            Cart::where('id', $cartId)->update([
                'order_id' => $order->id
            ]);
            
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            \Log::error('PayPal Error: ' . $e->getMessage());
            throw $e;
        }
    }
}
