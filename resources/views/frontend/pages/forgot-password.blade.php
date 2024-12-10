@extends('frontend.layouts.master')

@section('title','Little Brain || Quên mật khẩu')

@section('main-content')
<section class="shop login section">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 offset-lg-3 col-12">
                <div class="login-form">
                    <h2>Quên mật khẩu</h2>
                    <form class="form" method="post" action="{{route('password.send')}}">
                        @csrf
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label>Email<span>*</span></label>
                                    <input type="email" name="email" placeholder="Nhập email của bạn" required="required">
                                    @error('email')
                                        <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <button class="btn" type="submit">Gửi mật khẩu mới</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection 