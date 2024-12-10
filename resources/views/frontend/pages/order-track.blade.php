@extends('frontend.layouts.master')

@section('title','Theo dõi đơn hàng')

@section('main-content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
            <div class="card-header bg-dark text-white">
                    <h5 class="mb-0">Theo dõi đơn hàng</h5>
                </div>
                <div class="card-body">
                    @if(session('error'))
                        <div class="alert alert-danger">
                            {{session('error')}}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('product.track.order') }}">
                        @csrf
                        <div class="form-group">
                            <label for="order_number">Mã đơn hàng:</label>
                            <input type="text" 
                                name="order_number" 
                                class="form-control" 
                                placeholder="Vui lòng nhập mã đơn hàng của bạn..." 
                                required>
                            <small class="form-text text-muted">
                                Mã đơn hàng đã được gửi đến email của bạn sau khi đặt hàng thành công
                            </small>
                        </div>
                        <button type="submit" class="btn btn-primary">
                             Tra cứu đơn hàng
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection