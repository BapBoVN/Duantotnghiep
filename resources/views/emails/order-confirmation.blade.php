<!DOCTYPE html>
<html>
<head>
    <title>Xác nhận đơn hàng</title>
</head>
<body>
    <h2>Cảm ơn bạn đã đặt hàng!</h2>
    <p>Mã đơn hàng của bạn là: #{{ $order->order_number }}</p>
    
    <h3>Thông tin đơn hàng:</h3>
    <p>Tổng tiền: {{ number_format($order->total_amount) }} VND</p>
    <!-- <p>Phương thức thanh toán: {{ $order->payment_method == 'cod' ? 'Thanh toán tiền mặt' : 'Chuyển khoản' }}</p> -->
    
    <h3>Thông tin giao hàng:</h3>
    <p>Họ tên: {{ $order->first_name }} {{ $order->last_name }}</p>
    <p>Địa chỉ: {{ $order->post_code }}, {{ $order->address2 }}, {{ $order->address1 }}, {{ $order->country }}</p>
    <p>Số điện thoại: {{ $order->phone }}</p>
    <p>Email: {{ $order->email }}</p>
</body>
</html> 