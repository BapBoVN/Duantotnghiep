@extends('frontend.layouts.master')

@section('title','Checkout page')

@section('main-content')

    <!-- Breadcrumbs -->
    <div class="breadcrumbs">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="bread-inner">
                        <ul class="bread-list">
                            <li><a href="{{route('home')}}">Home<i class="ti-arrow-right"></i></a></li>
                            <li class="active"><a href="javascript:void(0)">Checkout</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Breadcrumbs -->
            
    <!-- Start Checkout -->
    <section class="shop checkout section">
        <div class="container">
                <form class="form" method="POST" action="{{route('cart.order')}}">
                    @csrf
                    <div class="row"> 

                        <div class="col-lg-8 col-12">
                            <div class="checkout-form">
                                <h2>Điền thông tin của bạn</h2>
                                <!-- <p>Please register in order to checkout more quickly</p> -->
                                <!-- Form -->
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-12">
                                        <div class="form-group">
                                            <label>Họ<span>*</span></label>
                                            <input type="text" name="first_name" placeholder="" value="{{old('first_name')}}" value="{{old('first_name')}}">
                                            @error('first_name')
                                                <span class='text-danger'>{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-12">
                                        <div class="form-group">
                                            <label>Tên<span>*</span></label>
                                            <input type="text" name="last_name" placeholder="" value="{{old('lat_name')}}">
                                            @error('last_name')
                                                <span class='text-danger'>{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-12">
                                        <div class="form-group">
                                            <label>Địa chỉ email<span>*</span></label>
                                            <input type="email" name="email" placeholder="" value="{{old('email')}}">
                                            @error('email')
                                                <span class='text-danger'>{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-12">
                                        <div class="form-group">
                                            <label>Số điện thoại <span>*</span></label>
                                            <input type="number" name="phone" placeholder="" required value="{{old('phone')}}">
                                            @error('phone')
                                                <span class='text-danger'>{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-12">
                                        <div class="form-group">
                                            <label>Tỉnh<span>*</span></label>
                                            <select name="country" id="country">
                                            <option value="Hanoi">Hà Nội</option>
                                            <option value="HCMC">Hồ Chí Minh</option>
                                            <option value="Danang">Đà Nẵng</option>
                                            <option value="Haiphong">Hải Phòng</option>
                                            <option value="Cantho">Cần Thơ</option>
                                            <option value="An Giang">An Giang</option>
                                            <option value="Ba Ria - Vung Tau">Bà Rịa - Vũng Tàu</option>
                                            <option value="Bac Giang">Bắc Giang</option>
                                            <option value="Bac Kan">Bắc Kạn</option>
                                            <option value="Bac Lieu">Bạc Liêu</option>
                                            <option value="Bac Ninh">Bắc Ninh</option>
                                            <option value="Ben Tre">Bến Tre</option>
                                            <option value="Binh Dinh">Bình Định</option>
                                            <option value="Binh Duong">Bình Dương</option>
                                            <option value="Binh Phuoc">Bình Phước</option>
                                            <option value="Binh Thuan">Bình Thuận</option>
                                            <option value="Ca Mau">Cà Mau</option>
                                            <option value="Cao Bang">Cao Bằng</option>
                                            <option value="Dak Lak">Đắk Lắk</option>
                                            <option value="Dak Nong">Đắk Nông</option>
                                            <option value="Dien Bien">Điện Biên</option>
                                            <option value="Dong Nai">Đồng Nai</option>
                                            <option value="Dong Thap">Đồng Tháp</option>
                                            <option value="Gia Lai">Gia Lai</option>
                                            <option value="Ha Giang">Hà Giang</option>
                                            <option value="Ha Nam">Hà Nam</option>
                                            <option value="Ha Tinh">Hà Tĩnh</option>
                                            <option value="Hai Duong">Hải Dương</option>
                                            <option value="Hau Giang">Hậu Giang</option>
                                            <option value="Hoa Binh">Hòa Bình</option>
                                            <option value="Hung Yen">Hưng Yên</option>
                                            <option value="Khanh Hoa">Khánh Hòa</option>
                                            <option value="Kien Giang">Kiên Giang</option>
                                            <option value="Kon Tum">Kon Tum</option>
                                            <option value="Lai Chau">Lai Châu</option>
                                            <option value="Lam Dong">Lâm Đồng</option>
                                            <option value="Lang Son">Lạng Sơn</option>
                                            <option value="Lao Cai">Lào Cai</option>
                                            <option value="Long An">Long An</option>
                                            <option value="Nam Dinh">Nam Định</option>
                                            <option value="Nghe An">Nghệ An</option>
                                            <option value="Ninh Binh">Ninh Bình</option>
                                            <option value="Ninh Thuan">Ninh Thuận</option>
                                            <option value="Phu Tho">Phú Thọ</option>
                                            <option value="Phu Yen">Phú Yên</option>
                                            <option value="Quang Binh">Quảng Bình</option>
                                            <option value="Quang Nam">Quảng Nam</option>
                                            <option value="Quang Ngai">Quảng Ngãi</option>
                                            <option value="Quang Ninh">Quảng Ninh</option>
                                            <option value="Quang Tri">Quảng Trị</option>
                                            <option value="Soc Trang">Sóc Trăng</option>
                                            <option value="Son La">Sơn La</option>
                                            <option value="Tay Ninh">Tây Ninh</option>
                                            <option value="Thai Binh">Thái Bình</option>
                                            <option value="Thai Nguyen">Thái Nguyên</option>
                                            <option value="Thanh Hoa">Thanh Hóa</option>
                                            <option value="Thua Thien Hue">Thừa Thiên Huế</option>
                                            <option value="Tien Giang">Tiền Giang</option>
                                            <option value="Tra Vinh">Trà Vinh</option>
                                            <option value="Tuyen Quang">Tuyên Quang</option>
                                            <option value="Vinh Long">Vĩnh Long</option>
                                            <option value="Vinh Phuc">Vĩnh Phúc</option>
                                            <option value="Yen Bai">Yên Bái</option>
                                            </select>
                                        </div>
                                    </div>
                                    
                                    <div class="col-lg-6 col-md-6 col-12">
                                        <div class="form-group">
                                            <label>Thành phố/ Huyện<span>*</span></label>
                                            <input type="text" name="address1" placeholder="" value="{{old('address1')}}">
                                            @error('address1')
                                                <span class='text-danger'>{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-12">
                                        <div class="form-group">
                                        <label>Phường/Xã<span>*</span></label>
                                            <input type="text" name="address2" placeholder="" value="{{old('address2')}}">
                                            @error('address2')
                                                <span class='text-danger'>{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <!-- <div class="col-lg-6 col-md-6 col-12">
                                        <div class="form-group">
                                            <label>Địa chỉ cụ thể</label>
                                            <input type="text" name="post_code" placeholder="" value="{{old('post_code')}}">
                                            @error('post_code')
                                                <span class='text-danger'>{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div> -->
                                    <div class="col-lg-12 col-md-6 col-12">
                                        <div class="form-group">
                                            <label>Địa chỉ cụ thể</label>
                                            <input type="text" name="post_code" placeholder="" value="{{old('post_code')}}">
                                            @error('post_code')
                                                <span class='text-danger'>{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                
                                <!--/ End Form -->
                            </div>
                        </div>
                        <div class="col-lg-4 col-12">
                            <div class="order-details">
                                <!-- Order Widget -->
                                <div class="single-widget">
                                    <h2>Thanh toán</h2>
                                    <div class="content">
                                        <ul>
										    <li class="order_subtotal" data-price="{{Helper::totalCartPrice()}}">Giá trị đơn hàng<span>{{number_format(Helper::totalCartPrice())}} VND</span></li>
                                            <!-- <li class="shipping">
                                                Shipping Cost
                                                @if(count(Helper::shipping())>0 && Helper::cartCount()>0)
                                                    <select name="shipping" class="nice-select">
                                                        <option value="">Select your address</option>
                                                        @foreach(Helper::shipping() as $shipping)
                                                        <option value="{{$shipping->id}}" class="shippingOption" data-price="{{$shipping->price}}">{{$shipping->type}}: ${{$shipping->price}}</option>
                                                        @endforeach
                                                    </select>
                                                @else 
                                                    <span>Free</span>
                                                @endif
                                            </li> -->
                                            
                                            @if(session('coupon'))
                                            <li class="coupon_price" data-price="{{session('coupon')['value']}}">You Save<span>${{number_format(session('coupon')['value'],2)}}</span></li>
                                            @endif
                                            @php
                                                $total_amount=Helper::totalCartPrice();
                                                if(session('coupon')){
                                                    $total_amount=$total_amount-session('coupon')['value'];
                                                }
                                            @endphp
                                            @if(session('coupon'))
                                                <li class="last"  id="order_total_price">Tổng cộng<span>{{number_format($total_amount)}} VND</span></li>
                                            @else
                                                <li class="last"  id="order_total_price">Tổng cộng<span>{{number_format($total_amount)}} VND</span></li>
                                            @endif
                                        </ul>
                                    </div>
                                </div>
                                <!--/ End Order Widget -->
                                <!-- Order Widget -->
                                <div class="single-widget">
                                    <h2>Phương thức thanh toán</h2>
                                    <div class="content">
                                        <div class="payment-option">
                                            <div class="form-group">
                                                <div class="phuong-thuc-thanh-toan">
                                                    <input id="cod" name="payment_method" type="radio" value="cod" required> 
                                                    <label for="cod">Thanh toán khi nhận hàng (COD)</label>
                                                </div>
                                                <div class="phuong-thuc-thanh-toan">
                                                    <input id="paypal" name="payment_method" type="radio" value="paypal" required> 
                                                    <label for="paypal">PayPal</label>
                                                </div>
                                            </div>
                                            @error('payment_method')
                                                <span class='text-danger'>{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <!--/ End Order Widget -->
                                <!-- Payment Method Widget -->
                                <div class="single-widget payement">
                                    <div class="content">
                                        <div id="payment-method-details">
                                            <!-- Payment details will be shown here -->
                                        </div>
                                    </div>
                                </div>
                                <!--/ End Payment Method Widget -->
                                <!-- Button Widget -->
                                <div class="single-widget get-button">
                                    <div class="content">
                                        <div class="button">
                                            <button type="submit" class="btn">Thanh toán</button>
                                        </div>
                                    </div>
                                </div>
                                <!--/ End Button Widget -->
                            </div>
                        </div>
                    </div>
                </form>
        </div>
    </section>
    <!--/ End Checkout -->
    
    <!-- Start Shop Services Area  -->
    <section class="shop-services section home">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-12">
                    <!-- Start Single Service -->
                    <div class="single-service">
                        <i class="ti-rocket"></i>
                        <h4>Free shiping</h4>
                        <p>Orders over $100</p>
                    </div>
                    <!-- End Single Service -->
                </div>
                <div class="col-lg-3 col-md-6 col-12">
                    <!-- Start Single Service -->
                    <div class="single-service">
                        <i class="ti-reload"></i>
                        <h4>Free Return</h4>
                        <p>Within 30 days returns</p>
                    </div>
                    <!-- End Single Service -->
                </div>
                <div class="col-lg-3 col-md-6 col-12">
                    <!-- Start Single Service -->
                    <div class="single-service">
                        <i class="ti-lock"></i>
                        <h4>Sucure Payment</h4>
                        <p>100% secure payment</p>
                    </div>
                    <!-- End Single Service -->
                </div>
                <div class="col-lg-3 col-md-6 col-12">
                    <!-- Start Single Service -->
                    <div class="single-service">
                        <i class="ti-tag"></i>
                        <h4>Best Peice</h4>
                        <p>Guaranteed price</p>
                    </div>
                    <!-- End Single Service -->
                </div>
            </div>
        </div>
    </section>
    <!-- End Shop Services -->
    
    <!-- Start Shop Newsletter  -->
    <section class="shop-newsletter section">
        <div class="container">
            <div class="inner-top">
                <div class="row">
                    <div class="col-lg-8 offset-lg-2 col-12">
                        <!-- Start Newsletter Inner -->
                        <div class="inner">
                            <h4>Newsletter</h4>
                            <p> Subscribe to our newsletter and get <span>10%</span> off your first purchase</p>
                            <form action="mail/mail.php" method="get" target="_blank" class="newsletter-inner">
                                <input name="EMAIL" placeholder="Your email address" required="" type="email">
                                <button class="btn">Subscribe</button>
                            </form>
                        </div>
                        <!-- End Newsletter Inner -->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Shop Newsletter -->
@endsection
@push('styles')
	<style>
		li.shipping{
			display: inline-flex;
			width: 100%;
			font-size: 14px;
		}
		li.shipping .input-group-icon {
			width: 100%;
			margin-left: 10px;
		}
		.input-group-icon .icon {
			position: absolute;
			left: 20px;
			top: 0;
			line-height: 40px;
			z-index: 3;
		}
		.form-select {
			height: 30px;
			width: 100%;
		}
		.form-select .nice-select {
			border: none;
			border-radius: 0px;
			height: 40px;
			background: #f6f6f6 !important;
			padding-left: 45px;
			padding-right: 40px;
			width: 100%;
		}
		.list li{
			margin-bottom:0 !important;
		}
		.list li:hover{
			background:#F7941D !important;
			color:white !important;
		}
		.form-select .nice-select::after {
			top: 14px;
		}
		.cod-info {
			padding: 15px;
			background: #f8f9fa;
			border-radius: 5px;
		}
		.cod-info p {
			font-weight: bold;
			margin-bottom: 10px;
		}
		.cod-info ul {
			list-style: none;
			padding-left: 20px;
		}
		.cod-info ul li {
			margin-bottom: 5px;
			color: #666;
		}
		.cod-info i {
			margin-right: 5px;
			color: #28a745;
		}
		.payment-methods {
			padding: 10px 0;
		}
		
		.payment-method-item {
			display: flex;
			align-items: center;
			margin-bottom: 10px;
		}
		
		.payment-method-item input[type="radio"] {
			width: 16px;
			height: 16px;
			margin-right: 10px;
			cursor: pointer;
		}
		
		.payment-method-item label {
			margin: 0;
			cursor: pointer;
			font-weight: normal;
			font-size: 14px;
		}
		
		.payment-method-item:hover label {
			color: #F7941D;
		}
		/* .payment-option {
			padding: 8px 0;
		} */
		
		.phuong-thuc-thanh-toan {
			display: flex;
			align-items: center;
			/* margin-bottom: 10px; */
            margin-left: 30px;
		}
		
		.phuong-thuc-thanh-toan input[type="radio"] {
			width: 14px;
			height: 14px;
			margin-right: 5px;
			cursor: pointer;
			accent-color: #F7941D;
		}
		
		.phuong-thuc-thanh-toan label {
			margin: 0;
			cursor: pointer;
			font-weight: normal;
			font-size: 13px;
			line-height: 1.4;
		}
		
		.phuong-thuc-thanh-toan:hover label {
			color: #F7941D;
		}
		/* Sửa lại CSS cho input chung, loại trừ radio button */
		.shop.checkout .form .form-group input:not([type="radio"]) {
			width: 100%;
			height: 45px;
			line-height: 50px;
			padding: 0 20px;
			border-radius: 3px;
			border-radius: 0px;
			color: #333 !important;
			border: none;
			background: #F6F7FB;
		}
        .shop.checkout .form .form-group input{
			width: 5%;
			height: 45px;
			line-height: 50px;
			padding: 0 40px;
			border-radius: 3px;
			border-radius: 0px;
			color: #333 !important;
			border: none;
			background: #F6F7FB;
		}
	</style>
@endpush
@push('scripts')
	<script src="{{asset('frontend/js/nice-select/js/jquery.nice-select.min.js')}}"></script>
	<script src="{{ asset('frontend/js/select2/js/select2.min.js') }}"></script>
	<script>
		$(document).ready(function() { $("select.select2").select2(); });
  		$('select.nice-select').niceSelect();
	</script>
	<script>
		function showMe(box){
			var checkbox=document.getElementById('shipping').style.display;
			// alert(checkbox);
			var vis= 'none';
			if(checkbox=="none"){
				vis='block';
			}
			if(checkbox=="block"){
				vis="none";
			}
			document.getElementById(box).style.display=vis;
		}
	</script>
	<script>
		$(document).ready(function(){
			$('.shipping select[name=shipping]').change(function(){
				let cost = parseFloat( $(this).find('option:selected').data('price') ) || 0;
				let subtotal = parseFloat( $('.order_subtotal').data('price') ); 
				let coupon = parseFloat( $('.coupon_price').data('price') ) || 0; 
				// alert(coupon);
				$('#order_total_price span').text('$'+(subtotal + cost-coupon).toFixed(2));
			});

		});

	</script>
	<script>
		$(document).ready(function() {
			// Xử lý khi chọn phương thức thanh toán
			$('input[name="payment_method"]').change(function() {
				const method = $(this).val();
				let details = '';
				
				if(method === 'cod') {
					details = `
						<div class="cod-info">
							<p><i class="fa fa-money"></i> Thanh toán khi nhận hàng</p>
							<ul>
								<li>Thanh toán bằng tiền mặt khi nhận hàng</li>
								<li>Kiểm tra hàng trước khi thanh toán</li>
							</ul>
						</div>
					`;
				} else if(method === 'paypal') {
					details = `
						<div class="paypal-info">
							<img src="{{asset('backend/img/payment-method.png')}}" alt="PayPal">
						</div>
					`;
				}
				
				$('#payment-method-details').html(details);
			});
		});
	</script>

@endpush