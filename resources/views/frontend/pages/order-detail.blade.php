@extends('frontend.layouts.master')

@section('title','Chi tiết đơn hàng')

@section('main-content')
<div class="container my-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Chi tiết đơn hàng #{{$order->order_number}}</h4>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <h5>Thông tin đơn hàng</h5>
                            <p><strong>Trạng thái:</strong> 
                                @if($order->status == 'new')
                                    <span class="badge badge-primary">Đơn hàng mới</span>
                                @elseif($order->status == 'process')
                                    <span class="badge badge-warning">Đang xử lý</span>
                                @elseif($order->status == 'delivered')
                                    <span class="badge badge-success">Đã giao hàng</span>
                                @else
                                    <span class="badge badge-danger">Đã hủy</span>
                                @endif
                            </p>
                            <p><strong>Ngày đặt:</strong> {{$order->created_at->format('d/m/Y H:i')}}</p>
                            <p><strong>Tổng tiền:</strong> {{number_format($order->total_amount)}} VNĐ</p>
                            <p><strong>Phương thức thanh toán:</strong> {{$order->payment_method}}</p>
                            <p><strong>Trạng thái thanh toán:</strong> {{$order->payment_status}}</p>
                        </div>
                        <div class="col-md-6">
                            <h5>Thông tin người nhận</h5>
                            <p><strong>Họ tên:</strong> {{$order->first_name}} {{$order->last_name}}</p>
                            <p><strong>Email:</strong> {{$order->email}}</p>
                            <p><strong>Số điện thoại:</strong> {{$order->phone}}</p>
                            <p><strong>Thành phố:</strong> {{$order->country}}</p>
                            <p><strong>Huyện, Phường/ xã</strong> {{$order->address1}}, {{$order->address2}}</p>
                            @if($order->address2)
                                <p><strong>Địa chỉ cụ thể:</strong> {{$order->post_code}}</p>
                            @endif
                        </div>
                    </div>

                    <h5>Sản phẩm đặt mua</h5>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Sản phẩm</th>
                                    <th>Giá</th>
                                    <th>Số lượng</th>
                                    <th>Tổng</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($order->cart as $cart)
                                <tr>
                                    <td>{{$cart->product->title}}</td>
                                    <td>{{number_format($cart->price)}} VNĐ</td>
                                    <td>{{$cart->quantity}}</td>
                                    <td>{{number_format($cart->amount)}} VNĐ</td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="3" class="text-right"><strong>Tổng phụ:</strong></td>
                                    <td>{{number_format($order->sub_total)}} VNĐ</td>
                                </tr>
                                @if($order->shipping)
                                <tr>
                                    <td colspan="3" class="text-right"><strong>Phí vận chuyển:</strong></td>
                                    <td>{{number_format($order->shipping->price)}} VNĐ</td>
                                </tr>
                                @endif
                                @if($order->coupon)
                                <tr>
                                    <td colspan="3" class="text-right"><strong>Giảm giá:</strong></td>
                                    <td>{{number_format($order->coupon)}} VNĐ</td>
                                </tr>
                                @endif
                                <tr>
                                    <td colspan="3" class="text-right"><strong>Tổng cộng:</strong></td>
                                    <td>{{number_format($order->total_amount)}} VNĐ</td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 