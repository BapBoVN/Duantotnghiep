@extends('backend.layouts.master')

@section('main-content')
 <!-- DataTales Example -->
 <div class="card shadow mb-4">
     <div class="row">
         <div class="col-md-12">
            @include('backend.layouts.notification')
         </div>
     </div>
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary float-left">Order Lists</h6>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        @if(count($orders)>0)
        <table class="table table-bordered" id="order-dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>ID</th>
              <th>Mã đơn hàng</th>
              <th>Tên</th>
              <th>Email</th>
              <th>Số lượng</th>
              <th>Ship</th>
              <th>Tổng cộng</th>
              <th>Trạng thái</th>
              <th>Hành động</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
            <th>ID</th>
              <th>Mã đơn hàng</th>
              <th>Tên</th>
              <th>Email</th>
              <th>Số lượng</th>
              <th>Ship</th>
              <th>Tổng cộng</th>
              <th>Trạng thái</th>
              <th>Hành động</th>
              </tr>
          </tfoot>
          <tbody>
            @foreach($orders as $order)  
            @php
                $shipping_charge=DB::table('shippings')->where('id',$order->shipping_id)->pluck('price');
            @endphp 
                <tr>
                    <td>{{$order->id}}</td>
                    <td>{{$order->order_number}}</td>
                    <td>{{$order->first_name}} {{$order->last_name}}</td>
                    <td>{{$order->email}}</td>
                    <td>{{$order->quantity}}</td>
                    <td>@foreach($shipping_charge as $data) $ {{number_format($data)}} @endforeach</td>
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
                        <a href="{{route('order.show',$order->id)}}" class="btn btn-warning btn-sm float-left mr-1" style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip" title="view" data-placement="bottom"><i class="fas fa-eye"></i></a>
                        <a href="{{route('order.edit',$order->id)}}" class="btn btn-primary btn-sm float-left mr-1" style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip" title="edit" data-placement="bottom"><i class="fas fa-edit"></i></a>
                        <form method="POST" action="{{route('order.destroy',[$order->id])}}">
                          @csrf 
                          @method('delete')
                              <button class="btn btn-danger btn-sm dltBtn" data-id={{$order->id}} style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip" data-placement="bottom" title="Delete"><i class="fas fa-trash-alt"></i></button>
                        </form>
                    </td>
                </tr>  
            @endforeach
          </tbody>
        </table>
        <div class="phanTrang">
          <button onclick="window.location.href='{{ $orders->previousPageUrl() }}'" class="phanTrang-btn" {{ $orders->onFirstPage() ? 'disabled' : '' }}>←</button>
          
          @for ($i = 1; $i <= $orders->lastPage(); $i++)
              <button onclick="window.location.href='{{ $orders->url($i) }}'" 
                      class="phanTrang-number {{ $orders->currentPage() == $i ? 'active' : '' }}">
                  {{ $i }}
              </button>
          @endfor

          <button onclick="window.location.href='{{ $orders->nextPageUrl() }}'" class="phanTrang-btn" {{ $orders->currentPage() == $orders->lastPage() ? 'disabled' : '' }}>→</button>
        </div>
        @else
          <h6 class="text-center">No orders found!!! Please order some products</h6>
        @endif
      </div>
    </div>
</div>
@endsection

@push('styles')
  <link href="{{asset('backend/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css" />
  <style>
      div.dataTables_wrapper div.dataTables_paginate{
          display: none;
      }

      .phanTrang {
          display: flex;
          justify-content: center;
          align-items: center;
          gap: 8px;
          margin-top: 20px;
      }

      .phanTrang-btn {
          padding: 8px 15px;
          border: 2px solid #4e73df;
          background-color: white;
          color: #4e73df;
          border-radius: 5px;
          cursor: pointer;
          transition: all 0.3s ease;
          font-size: 16px;
      }

      .phanTrang-btn:hover {
          background-color: #4e73df;
          color: white;
      }

      .phanTrang-btn[disabled] {
          opacity: 0.5;
          cursor: not-allowed;
          border-color: #cccccc;
          color: #666666;
      }

      .phanTrang-btn[disabled]:hover {
          background-color: white;
          color: #666666;
      }

      .phanTrang-number {
          padding: 5px 10px;
          border: 1px solid #4e73df;
          background-color: white;
          color: #4e73df;
          border-radius: 3px;
          cursor: pointer;
          transition: all 0.3s ease;
          min-width: 35px;
      }

      .phanTrang-number:hover {
          background-color: #4e73df;
          color: white;
      }

      .phanTrang-number.active {
          background-color: #4e73df;
          color: white;         
          font-weight: bold;
      }
  </style>
@endpush

@push('scripts')

  <!-- Page level plugins -->
  <script src="{{asset('backend/vendor/datatables/jquery.dataTables.min.js')}}"></script>
  <script src="{{asset('backend/vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="{{asset('backend/js/demo/datatables-demo.js')}}"></script>
  <script>
      
      $('#order-dataTable').DataTable( {
            "columnDefs":[
                {
                    "orderable":false,
                    "targets":[8]
                }
            ]
        } );

        // Sweet alert

        function deleteData(id){
            
        }
  </script>
  <script>
      $(document).ready(function(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
          $('.dltBtn').click(function(e){
            var form=$(this).closest('form');
              var dataID=$(this).data('id');
              // alert(dataID);
              e.preventDefault();
              swal({
                    title: "Bạn chắc chứ",
                    text: "Bạn sẽ không thể khôi phục nếu xóa",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                       form.submit();
                    } else {
                        swal("Hủy bỏ thành công");
                    }
                });
          })
      })
  </script>
  <script>
      let currentPage = 1;
      const table = $('#order-dataTable').DataTable();
      
      function nextPage() {
          table.page('next').draw('page');
          currentPage++;
      }

      function previousPage() {
          if(currentPage > 1) {
              table.page('previous').draw('page');
              currentPage--;
          }
      }
  </script>
@endpush