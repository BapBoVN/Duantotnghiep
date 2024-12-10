<!DOCTYPE html>
<html>
<head>
    <title>Chi tiết đơn hàng</title>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; }
        .header { background: #f8f9fa; padding: 20px; text-align: center; }
        .order-info { margin: 20px 0; }
        table { width: 100%; border-collapse: collapse; margin: 20px 0; }
        th, td { border: 1px solid #ddd; padding: 12px; text-align: left; }
        th { background: #f8f9fa; }
        .product-image { width: 80px; height: 80px; object-fit: cover; }
        .footer { margin-top: 30px; padding-top: 20px; border-top: 1px solid #ddd; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>Xin chào {{ $order->first_name }} {{ $order->last_name }},</h2>
            <p>Cảm ơn bạn đã đặt hàng. Dưới đây là chi tiết đơn hàng của bạn:</p>
        </div>

        <div class="order-info">
            <table>
                <tr>
                    <th colspan="2">Thông tin đơn hàng #{{ $order->order_number }}</th>
                </tr>
                <tr>
                    <td>Thời gian đặt:</td>
                    <td>{{ $order->created_at->format('H:i') }} ngày {{ $order->created_at->format('d/m/Y') }}</td>
                </tr>
                <!-- <tr>
                    <td>Phương thức thanh toán:</td>
                    <td>{{ $order->payment_method=='cod' ? 'Thanh toán khi nhận hàng' : 'Paypal' }}</td>
                </tr> -->
            </table>

            <table>
                <tr>
                    <th>Sản phẩm</th>
                    <th>Hình ảnh</th>
                    <th>Số lượng</th>
                    <th>Đơn giá</th>
                    <th>Thành tiền</th>
                </tr>
                @foreach($order->cart_info as $item)
                <tr>
                    <td>{{ $item->product->title }}</td>
                    <td>
                        @if($item->product->photo)
                            <img src="{{ asset('storage/'.$item->product->photo) }}" 
                                 class="product-image" 
                                 alt="{{ $item->product->title }}"
                                 style="width: 80px; height: 80px; object-fit: cover;">
                        @else
                            <span>No image</span>
                        @endif
                    </td>
                    <td>{{ $item->quantity }}</td>
                    <td>{{ number_format($item->price) }} VND</td>
                    <td>{{ number_format($item->amount) }} VND</td>
                </tr>
                @endforeach
            </table>

            <table>
                <tr>
                    <td>Tổng tiền hàng:</td>
                    <td>{{ number_format($order->sub_total) }} VND</td>
                </tr>
                <!-- <tr>
                    <td>Phí vận chuyển:</td>
                    <td>{{ optional($order->shipping)->price ?: 'N/A' }} VND</td>
                </tr> -->
                <!-- <tr>
                    <td>Giảm giá:</td>
                    <td>{{ number_format($order->coupon) }} VND</td>
                </tr> -->
                <tr>
                    <th>Tổng thanh toán:</th>
                    <th>{{ number_format($order->total_amount) }} VND</th>
                </tr>
            </table>

            <table>
                <tr>
                    <th colspan="2">Địa chỉ giao hàng</th>
                </tr>
                <tr>
                    <td>Địa chỉ:</td>
                    <td>{{ $order->address1 }}, {{ $order->address2 }}</td>
                </tr>
                <tr>
                    <td>Tỉnh/Thành phố:</td>
                    <td>{{ $order->country }}</td>
                </tr>
                <tr>
                    <td>Địa chỉ cụ thể:</td>
                    <td>{{ $order->post_code }}</td>
                </tr>
                <tr>
                    <td>Điện thoại:</td>
                    <td>{{ $order->phone }}</td>
                </tr>
            </table>
        </div>

        <div class="footer">
            <p>Nếu bạn có bất kỳ câu hỏi nào, vui lòng liên hệ với chúng tôi.</p>

            <p>Trân trọng,<br>
            {{ config('app.name') }}</p>
        </div>
    </div>
</body>
</html> 