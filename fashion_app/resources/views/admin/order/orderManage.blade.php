@extends('admin.master')
@section('content')

<div class="col-md-12">
    <div class="card">
      <div class="card-header">
        <div class="d-flex align-items-center">
          <h4 class="card-title">Danh sách đơn hàng</h4>
          <a href="{{route('order.create')}}" class="btn btn-primary btn-round ms-auto" id="btn-addProduct" >
            <i class="fa fa-plus"></i> Tạo đơn
          </a>
        </div>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table
            id="add-row"
            class="display table table-striped table-hover"
          >
            <thead>
              <tr>
                <th>Mã đơn hàng</th>
                <th>Ngày tạo đơn</th>
                <th>Tên khách hàng</th>
                <th>Tổng trị giá</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($orders as $order)
              <tr>
                <td>{{$order->order_id}}</td>
                <td>{{$order->created_at}}</td>
                <td>{{$order->customer->customer_name}}</td>
                <td>{{$order->total_amount}}</td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
</div>

@endsection