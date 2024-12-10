@extends('frontend.layouts.master')

@section('title','Little Brain || Đăng kí')

@section('main-content')
	<!-- Breadcrumbs -->
    <div class="breadcrumbs">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="bread-inner">
                        <ul class="bread-list">
                            <li><a href="{{route('home')}}">Trang chủ<i class="ti-arrow-right"></i></a></li>
                            <li class="active"><a href="javascript:void(0);">Đăng kí</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Breadcrumbs -->
            
    <!-- Shop Login -->
    <section class="shop login section">
        <div class="container">
            <div class="row"> 
                <div class="col-lg-6 offset-lg-3 col-12">
                    <div class="login-form">
                        <h2>Đăng kí</h2>
                        <!-- <p>Please register in order to checkout more quickly</p> -->
                        <!-- Form -->
                        <form class="form" method="post" action="{{route('register.submit')}}">
                            @csrf
                            <div class="row">   
                                <div class="col-12">
                                    <div class="form-group">
                                        <label>Họ và tên<span>*</span></label>
                                        <input type="text" name="name" placeholder="" required="required" value="{{old('name')}}">
                                        @error('name')
                                            <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label>Email<span>*</span></label>
                                        <input type="email" name="email" placeholder="" 
                                            pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" 
                                            title="Vui lòng nhập đúng định dạng email (ví dụ: example@domain.com)"
                                            required="required" value="{{old('email')}}">
                                        @error('email')
                                            <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label>Mật khẩu<span>*</span></label>
                                        <div class="password-input">
                                            <input type="password" name="password" 
                                                minlength="6" 
                                                maxlength="15" 
                                                pattern=".{6,15}"
                                                title="Mật khẩu phải có độ dài từ 6 đến 15 ký tự"
                                                required="required" 
                                                value="{{old('password')}}">
                                            <i class="fa fa-eye-slash toggle-password"></i>
                                        </div>
                                        @error('password')
                                            <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label>Nhập lại mật khẩu<span>*</span></label>
                                        <div class="password-input">
                                            <input type="password" name="password_confirmation" 
                                                minlength="6" 
                                                maxlength="15" 
                                                pattern=".{6,15}"
                                                title="Mật khẩu phải có độ dài từ 6 đến 15 ký tự"
                                                required="required" 
                                                value="{{old('password_confirmation')}}">
                                            <i class="fa fa-eye-slash toggle-password"></i>
                                        </div>
                                        @error('password_confirmation')
                                            <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group login-btn">
                                        <button class="btn" type="submit">Đăng kí</button>
                                        <a href="{{route('login.form')}}" class="btn">Đăng nhập</a>
                                        <!-- OR
                                        <a href="{{route('login.redirect','facebook')}}" class="btn btn-facebook"><i class="ti-facebook"></i></a>
                                        <a href="{{route('login.redirect','github')}}" class="btn btn-github"><i class="ti-github"></i></a>
                                        <a href="{{route('login.redirect','google')}}" class="btn btn-google"><i class="ti-google"></i></a> -->
                                    </div>
                                </div>
                            </div>
                        </form>
                        <!--/ End Form -->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--/ End Login -->
@endsection

@push('styles')
<style>
    .shop.login .form .btn{
        margin-right:0;
    }
    .btn-facebook{
        background:#39579A;
    }
    .btn-facebook:hover{
        background:#073088 !important;
    }
    .btn-github{
        background:#444444;
        color:white;
    }
    .btn-github:hover{
        background:black !important;
    }
    .btn-google{
        background:#ea4335;
        color:white;
    }
    .btn-google:hover{
        background:rgb(243, 26, 26) !important;
    }
    .password-input {
        position: relative;
    }
    
    .toggle-password {
        position: absolute;
        right: 10px;
        top: 50%;
        transform: translateY(-50%);
        cursor: pointer;
        color: #666;
    }
    
    .toggle-password:hover {
        color: #333;
    }
</style>
@endpush

@push('scripts')
<script>
    $(document).ready(function() {
        $('.toggle-password').click(function() {
            const input = $(this).siblings('input');
            if (input.attr('type') === 'password') {
                input.attr('type', 'text');
                $(this).removeClass('fa-eye-slash').addClass('fa-eye');
            } else {
                input.attr('type', 'password');
                $(this).removeClass('fa-eye').addClass('fa-eye-slash');
            }
        });
    });
</script>
@endpush