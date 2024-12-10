@extends('backend.layouts.master')

@section('title','Order Detail')

@section('main-content')
<div class="card">
 <h5 class="card-header">Order    <!--  <a href="{{route('order.pdf',$order->id)}}" class=" btn btn-sm btn-primary shadow-sm float-right"><i class="fas fa-download fa-sm text-white-50"></i> Generate PDF</a> -->
  </h5>
  <div class="card-body">
    @if($order)
    <table class="table table-striped table-hover">
      <thead>
        <tr>
            <th>ID</th>
            <th>Mã hóa đơn</th>
            <th>Tên</th>
            <th>Email</th>
            <th>Số lượng</th>
            
            <th>Tổng cộng</th>
            <th>Trạng thái</th>
            <th>Hành động</th>
        </tr>
      </thead>
      <tbody>
        <tr>
            <td>{{$order->id}}</td>
            <td>{{$order->order_number}}</td>
            <td>{{$order->first_name}} {{$order->last_name}}</td>
            <td>{{$order->email}}</td>
            <td>{{$order->quantity}}</td>
            <!-- <<td>{{ $order->shipping ? $order->shipping->price : 'N/A' }}</td> -->
            <td>{{number_format($order->total_amount)}} VND</td>
            <td>
                @if($order->status=='new')
                  <span class="badge badge-primary">{{$order->status}}</span>
                @elseif($order->status=='process')
                  <span class="badge badge-warning">{{$order->status}}</span>
                @elseif($order->status=='delivered')
                  <span class="badge badge-success">{{$order->status}}</span>
                @else
                  <span class="badge badge-danger">{{$order->status}}</span>
                @endif
            </td>
            <td>
                <a href="{{route('order.edit',$order->id)}}" class="btn btn-primary btn-sm float-left mr-1" style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip" title="edit" data-placement="bottom"><i class="fas fa-edit"></i></a>
                <form method="POST" action="{{route('order.destroy',[$order->id])}}">
                  @csrf
                  @method('delete')
                      <button class="btn btn-danger btn-sm dltBtn" data-id={{$order->id}} style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip" data-placement="bottom" title="Delete"><i class="fas fa-trash-alt"></i></button>
                </form>
            </td>

        </tr>
      </tbody>
    </table>

    <section class="confirmation_part section_padding">
      <div class="order_boxes">
        <div class="row">
          <div class="col-lg-6 col-lx-4">
            <div class="order-info">
              <h4 class="text-center pb-4">Thông tin đơn hàng</h4>
              <table class="table">
                    <tr class="">
                        <td>Mã vận đơn</td>
                        <td> : {{$order->order_number}}</td>
                    </tr>
                    <!-- <tr>
                        <td>Ngày tạo</td>
                        <td>  {{$order->created_at->format('g : i a')}}  at {{$order->created_at->format('D d M, Y')}} </td>
                    </tr> -->
                    <tr>
                        <td>Ngày tạo</td>
                        <td> : {{$order->created_at->format('H:i')}} ngày {{$order->created_at->format('d/m/Y')}}</td>
                    </tr>
                    <tr>
                        <td>Số lượng</td>
                        <td> : {{$order->quantity}}</td>
                    </tr>
                    <!-- <tr>
                        <td>Trạng thái</td>
                        <td> : {{$order->status}}</td>
                    </tr> -->
                    <!-- <tr>
                        <td>Phí ship</td>
                        <td> :  {{ optional($order->shipping)->price ?: 'N/A' }} VND</td>
                    </tr>
                    <tr>
                      <td>Giảm giá</td>
                      <td> :  {{number_format($order->coupon)}} VND</td>
                    </tr> -->
                    <tr>
                        <td>Tổng cộng</td>
                        <td> :  {{number_format($order->total_amount)}} VND</td>
                    </tr>
                    <tr>
                        <td>Phương thức thanh toán</td>
                        <td> : @if($order->payment_method=='cod') Thanh toán tiền mặt @else Paypal @endif</td>
                    </tr>
                    <tr>
                        <td>Trạng thái</td>
                        <td> : {{$order->status}}</td>
                    </tr>
              </table>
            </div>
          </div>

          <div class="col-lg-6 col-lx-4">
            <div class="shipping-info">
              <h4 class="text-center pb-4">Thông tin khách hàng</h4>
              <table class="table">
                    <tr class="">
                        <td>Họ và tên</td>
                        <td> : {{$order->first_name}} {{$order->last_name}}</td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td> : {{$order->email}}</td>
                    </tr>
                    <tr>
                        <td>Số điện thoại</td>
                        <td> : {{$order->phone}}</td>
                    </tr>  
                    <tr>
                        <td>Tỉnh</td>
                        <td> : {{$order->country}}</td>
                    </tr>
                    <tr>
                        <td>Thành phố/ huyện, Phường/ xã</td>
                        <td> : {{$order->address1}}, {{$order->address2}}</td>
                    </tr>
                  
                    <tr>
                        <td>Địa chỉ cụ thể</td>
                        <td> : {{$order->post_code}}</td>
                    </tr>
              </table>
              <div class="text-center mt-3">
                <a href="{{route('order.email',$order->id)}}" class="btn btn-primary">
                  <i class="fas fa-envelope"></i> Gửi Email
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    @endif

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

  </div>
</div>
@endsection

@push('styles')
<style>
    .order-info,.shipping-info{
        background:#ECECEC;
        padding:20px;
    }
    .order-info h4,.shipping-info h4{
        text-decoration: underline;
    }

</style>
@endpush
