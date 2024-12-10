@extends('frontend.layouts.master')

@section('title','Little Brain || Đăng nhập')

@section('main-content')
    <!-- Breadcrumbs -->
    <div class="breadcrumbs">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="bread-inner">
                        <ul class="bread-list">
                            <li><a href="{{route('home')}}">Trang chủ<i class="ti-arrow-right"></i></a></li>
                            <li class="active"><a href="javascript:void(0);">Đăng nhập</a></li>
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
                        <h2>Đăng nhập</h2>
                        <!-- <p>Please register in order to checkout more quickly</p> -->
                        <!-- Form -->
                        <form class="form" method="post" action="{{route('login.submit')}}">
                            @csrf
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label>Emai<span>*</span></label>
                                        <input type="email" name="email" placeholder="" required="required" value="{{old('email')}}">
                                        @error('email')
                                            <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label>Mật khẩu<span>*</span></label>
                                        <div class="password-input">
                                            <input type="password" name="password" placeholder="" required="required" value="{{old('password')}}">
                                            <i class="fa fa-eye-slash toggle-password"></i>
                                        </div>
                                        @error('password')
                                            <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group login-btn">
                                        <button class="btn" type="submit">Đăng nhập</button>
                                        <a href="{{route('register.form')}}" class="btn">Đăng kí</a>
                                        <!-- OR
                                        <a href="{{route('login.redirect','facebook')}}" class="btn btn-facebook"><i class="ti-facebook"></i></a>
                                        <a href="{{route('login.redirect','github')}}" class="btn btn-github"><i class="ti-github"></i></a>
                                        <a href="{{route('login.redirect','google')}}" class="btn btn-google"><i class="ti-google"></i></a> -->

                                    </div>
                                    <div class="checkbox">
                                        <label class="checkbox-inline" for="2"><input name="news" id="2" type="checkbox">Nhớ tôi</label>
                                    </div>
                                    <div class="form-group">
                                        <a href="{{ route('password.form') }}" class="lost-pass">Quên mật khẩu?</a>
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
        right: 25px;
        top: 50%;
        transform: translateY(-50%);
        cursor: pointer;
        font-size: 18px;
    }
</style>
@endpush

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.toggle-password').forEach(function(element) {
            element.addEventListener('click', function() {
                this.classList.toggle('fa-eye');
                this.classList.toggle('fa-eye-slash');
                let input = this.parentElement.querySelector('input');
                if (input.type === 'password') {
                    input.type = 'text';
                } else {
                    input.type = 'password';
                }
            });
        });
    });
</script>
@endpush