@extends('frontend.layouts.master')

@section('title', 'Reset Password')

@section('content')
<!-- Breadcrumbs -->
<div class="breadcrumbs">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="bread-inner">
                    <ul class="bread-list">
                        <li><a href="{{route('home')}}">Trang chủ<i class="ti-arrow-right"></i></a></li>
                        <li class="active"><a href="javascript:void(0);">Đặt lại mật khẩu</a></li>
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
                    <h2>Đặt lại mật khẩu</h2>
                    <!-- Form -->
                    <form class="form" method="post" action="{{route('password.reset')}}">
                        @csrf
                        <div class="row">
                            @if (Session::has('success'))
                                <div class="alert alert-success">{{Session::get('success')}}</div>
                            @endif
                            @if (Session::has('error'))
                                <div class="alert alert-danger">{{Session::get('error')}}</div>
                            @endif

                            <div class="col-12">
                                <div class="form-group">
                                    <label>Địa chỉ Email<span>*</span></label>
                                    <input type="email" name="email" placeholder="Nhập email của bạn" required="required" value="{{old('email')}}">
                                    @error('email')
                                        <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group login-btn">
                                    <button class="btn" type="submit">Gửi link đặt lại mật khẩu</button>
                                    <a href="{{route('login.form')}}" class="btn">Quay lại đăng nhập</a>
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
<!--/ End Shop Login -->
@endsection
