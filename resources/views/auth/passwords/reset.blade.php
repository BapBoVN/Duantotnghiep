@extends('frontend.layouts.master')

@section('title', 'Set New Password')

@section('content')s
<!-- Breadcrumbs -->
<div class="breadcrumbs">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="bread-inner">
                    <ul class="bread-list">
                        <li><a href="{{route('home')}}">Home<i class="ti-arrow-right"></i></a></li>
                        <li class="active"><a href="javascript:void(0);">Set New Password</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Breadcrumbs -->

<!-- New Password Form -->
<section class="shop login section">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 offset-lg-3 col-12">
                <div class="login-form">
                    <h2>Set New Password</h2>
                    <!-- Form -->
                    <form class="form" method="post" action="{{route('password.update')}}">
                        @csrf
                        <input type="hidden" name="token" value="{{ $token }}">
                        <input type="hidden" name="email" value="{{ $email }}">
                        
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label>Email Address</label>
                                    <input type="email" value="{{ $email }}" disabled>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label>New Password<span>*</span></label>
                                    <input type="password" name="password" placeholder="" required="required">
                                    @error('password')
                                        <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label>Confirm Password<span>*</span></label>
                                    <input type="password" name="password_confirmation" placeholder="" required="required">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group login-btn">
                                    <button class="btn" type="submit">Reset Password</button>
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
<!--/ End New Password Form -->
@endsection
