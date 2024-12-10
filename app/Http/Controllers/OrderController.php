<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Shipping;
use App\User;
use PDF;
use Notification;
use Helper;
use Illuminate\Support\Str;
use App\Notifications\StatusNotification;
use App\Mail\OrderConfirmation;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderMail;
use App\Models\OrderDetail;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::orderBy('id', 'DESC')->paginate(10);
        return view('backend.order.index')->with('orders', $orders);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            \Log::info('Order store started:', [
                'payment_method' => $request->payment_method,
                'request_data' => $request->all()
            ]);

            // Validate payment method
            if(!in_array($request->payment_method, ['cod', 'paypal'])) {
                \Log::error('Invalid payment method:', ['method' => $request->payment_method]);
                return redirect()->back()->with('error', 'Phương thức thanh toán không hợp lệ.');
            }

            // Nếu là PayPal, chuyển request đến PayPalController
            if($request->payment_method == 'paypal') {
                try {
                    \Log::info('Redirecting to PayPal payment');
                    return app(PayPalController::class)->createPayment($request);
                } catch (\Exception $e) {
                    \Log::error('PayPal redirect failed:', [
                        'error' => $e->getMessage(),
                        'trace' => $e->getTraceAsString()
                    ]);
                    return redirect()->back()->with('error', 'Lỗi khi chuyển hướng đến PayPal: ' . $e->getMessage());
                }
            }

            // Xử lý thanh toán COD
            $order = new Order();
            $total_amount = Helper::totalCartPrice();
            
            // Kiểm tra giỏ hàng
            $cart_items = Cart::where('user_id', auth()->user()->id)
                            ->where('order_id', null)
                            ->get();
                            
            \Log::info('Cart items:', [
                'count' => $cart_items->count(),
                'items' => $cart_items->toArray()
            ]);
                            
            if($cart_items->isEmpty()) {
                return redirect()->back()->with('error', 'Giỏ hàng của bạn đang trống!');
            }

            $total_quantity = $cart_items->sum('quantity');

            $order->order_number = 'ORD-'.strtoupper(Str::random(10));
            $order->first_name = $request->first_name;
            $order->last_name = $request->last_name;
            $order->email = $request->email;
            $order->phone = $request->phone;
            $order->address1 = $request->address1;
            $order->address2 = $request->address2;
            $order->country = $request->country;
            $order->post_code = $request->post_code;
            $order->payment_method = strtoupper($request->payment_method);
            $order->payment_status = 'Unpaid';
            $order->status = 'new';
            $order->quantity = $total_quantity;
            $order->sub_total = $total_amount;
            $order->total_amount = $total_amount;
            
            if(auth()->check()) {
                $order->user_id = auth()->user()->id;
            }
            
            try {
                \DB::beginTransaction();
                
                \Log::info('Saving order:', $order->toArray());
                $status = $order->save();

                if($status) {
                    Cart::where('user_id', auth()->user()->id)
                        ->where('order_id', null)
                        ->update(['order_id' => $order->id]);

                    \DB::commit();
                    
                    try {
                        Mail::to($order->email)->send(new OrderMail($order));
                    } catch (\Exception $e) {
                        \Log::error('Email sending failed:', ['error' => $e->getMessage()]);
                    }
                    return redirect()->route('home')->with('success', 'Đơn hàng của bạn đã được đặt thành công. Chúng tôi sẽ liên hệ với bạn sớm!');
                }
                
                \DB::rollBack();
                return redirect()->back()->with('error', 'Không thể lưu đơn hàng, vui lòng thử lại.');
            } catch (\Exception $e) {
                \DB::rollBack();
                \Log::error('Database transaction failed:', ['error' => $e->getMessage()]);
                return redirect()->back()->with('error', 'Lỗi trong quá trình xử lý đơn hàng: ' . $e->getMessage());
            }

        } catch(\Exception $e) {
            \Log::error('Order creation error:', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return redirect()->back()->with('error', 'Đã có lỗi xảy ra: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order=Order::find($id);
        // return $order;
        return view('backend.order.show')->with('order',$order);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $order=Order::find($id);
        return view('backend.order.edit')->with('order',$order);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $order=Order::find($id);
        $this->validate($request,[
            'status'=>'required|in:new,process,delivered,cancel'
        ]);
        $data=$request->all();
        // return $request->status;
        if($request->status=='delivered'){
            foreach($order->cart as $cart){
                $product=$cart->product;
                // return $product;
                $product->stock -=$cart->quantity;
                $product->save();
            }
        }
        $status=$order->fill($data)->save();
        if($status){
            request()->session()->flash('success','Successfully updated order');
        }
        else{
            request()->session()->flash('error','Error while updating order');
        }
        return redirect()->route('order.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $order=Order::find($id);
        if($order){
            $status=$order->delete();
            if($status){
                request()->session()->flash('success','Order Successfully deleted');
            }
            else{
                request()->session()->flash('error','Order can not deleted');
            }
            return redirect()->route('order.index');
        }
        else{
            request()->session()->flash('error','Order can not found');
            return redirect()->back();
        }
    }

    public function orderTrack()
    {
        return view('frontend.pages.order-track');
    }

    public function productTrackOrder(Request $request){
        // Kiểm tra nếu là admin
        if(auth()->user()->role == 'admin') {
            $order = Order::where('order_number', $request->order_number)
                ->with(['cart.product'])
                ->first();
        } else {
            // Người dùng thường chỉ xem được đơn hàng của họ
            $order = Order::where('user_id', auth()->user()->id)
                ->where('order_number', $request->order_number)
                ->with(['cart.product'])
                ->first();
        }
        
        if($order){
            \Log::info('Order found:', ['order' => $order->toArray()]);
            return view('frontend.pages.order-detail', compact('order'));
        }
        else{
            request()->session()->flash('error', 'Số ID đơn hàng không hợp lệ, vui lòng thử lại.');
            return back();
        }
    }

    // PDF generate
    public function pdf(Request $request){
        $order=Order::getAllOrder($request->id);
        // return $order;
        $file_name=$order->order_number.'-'.$order->first_name.'.pdf';
        // return $file_name;
        $pdf=PDF::loadview('backend.order.pdf',compact('order'));
        return $pdf->download($file_name);
    }
    // Income chart
    public function incomeChart(Request $request){
        $year=\Carbon\Carbon::now()->year;
        // dd($year);
        $items=Order::with(['cart_info'])->whereYear('created_at',$year)->where('status','delivered')->get()
            ->groupBy(function($d){
                return \Carbon\Carbon::parse($d->created_at)->format('m');
            });
            // dd($items);
        $result=[];
        foreach($items as $month=>$item_collections){
            foreach($item_collections as $item){
                $amount=$item->cart_info->sum('amount');
                // dd($amount);
                $m=intval($month);
                // return $m;
                isset($result[$m]) ? $result[$m] += $amount :$result[$m]=$amount;
            }
        }
        $data=[];
        for($i=1; $i <=12; $i++){
            $monthName=date('F', mktime(0,0,0,$i,1));
            $data[$monthName] = (!empty($result[$i]))? number_format((float)($result[$i]), 2, '.', '') : 0.0;
        }
        return $data;
    }

    public function sendOrderEmail($id)
    {
        $order = Order::find($id);
        
        if (!$order) {
            return back()->with('error', 'Không tìm thấy đơn hàng!');
        }

        try {
            Mail::to($order->email)->send(new OrderMail($order));
            return back()->with('success', 'Email đã được gửi thành công!');
        } catch (\Exception $e) {
            return back()->with('error', 'Có lỗi xảy ra khi gửi email: ' . $e->getMessage());
        }
    }
}
