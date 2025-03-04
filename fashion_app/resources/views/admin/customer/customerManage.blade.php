@extends('admin.master')
@section('content')

<div class="col-md-12">
  <div class="card">
    <div class="card-header">
      <div class="d-flex align-items-center">
        <h4 class="card-title">Danh sách sản phẩm</h4>
        <button class="btn btn-primary btn-round ms-auto" id="btn-addProduct" onclick="addCustomer()">
          <i class="fa fa-plus"></i>
          Thêm khách hàng
        </button>
      </div>
    </div>
    <div class="card-body">
      <!-- Modal -->
      <!--Add Cusomer-->
      <div class="modal formAdd" id="modalCustomer">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header border-0">
              <h5 class="modal-title">
                <span class="fw-mediumbold">Thêm khách hàng</span>
              </h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="addCustomer()">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <p class="small">Nhập thông tin khách hàng</p>
              <form action="{{route('customer.store')}}" method="post">
                @csrf
                <div class="row">
                  <div class="col-sm-6">
                    <div class="form-group form-group-default">
                      <label>Tên khách hàng</label>
                      <input id="customer_name" name="customer_name" type="text" class="form-control" placeholder="Nhập tên"/>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group form-group-default">
                      <label>Số điện thoại</label>
                      <input id="phone_number" name="phone_number" type="text" class="form-control btn-price" placeholder="Số điện thoại"/>
                    </div>
                  </div>

                  <div class="col-md-12">
                    <div class="form-group form-group-default">
                      <label>Địa chỉ</label>
                      <input id="address" name="address" type="text" class="form-control btn-price" placeholder="Địa chỉ"/>
                    </div>
                  </div>

                </div>
                <div class="modal-footer border-0">
                  <button type="submit" id="addRowButton" class="btn btn-primary" >
                    Add
                  </button>
                  <button type="button" class="btn btn-danger" data-dismiss="modal" id="hideTable" onclick="addCustomer()" >
                    Close
                  </button>
                </div>
              </form>
            </div>
            
          </div>
        </div>
      </div>
      <!--End Add product-->

      <div class="table-responsive">
        <table
          id="add-row"
          class="display table table-striped table-hover"
        >
          <thead>
            <tr>
              <th>Mã khách hàng</th>
              <th>Tên khách hàng</th>
              <th>Số điện thoại</th>
              <th>Tổng chi tiêu</th>
              <th>Tổng số lượng đơn</th>
            </tr>
          </thead>
          <tbody>
  
            @foreach ($customers as $customer )
              
            <tr>
              <td>{{$customer->customer_id}}</td>
              <td>{{$customer->customer_name}}</td>
              <td>{{$customer->phone_number}}</td>
              @php
                $sum = 0;
                $i = 0;
              @endphp
              @foreach ($orders as $order)
                @if ($customer->customer_id == $order->customer_id)
                  @php
                    $sum += $order->total_amount;
                    $i++;
                  @endphp
                @endif
              @endforeach
              <td>{{$sum}}</td>
              <td>{{$i}}</td>
              <td>
                <div class="form-button-action">
                  <button type="button" data-bs-toggle="tooltip" title="" class="btn btn-link btn-primary btn-lg" data-original-title="Edit Task">
                    <a href="{{route('customer.show',$customer->customer_id)}}"><i class="fa fa-edit"></i></a>
                  </button>
                  <form action="{{ route('customer.destroy', $customer->customer_id) }}" method="POST" style="display: inline-block;">
                    @csrf
                    @method('DELETE') <!-- Mô phỏng phương thức DELETE -->
                    <button type="submit" data-bs-toggle="tooltip" title="" class="btn btn-link btn-danger" data-original-title="Remove" >
                      <i class="fa fa-times"></i>
                    </button>
                  </form>
                </div>
              </td>
              
            </tr>

            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<div class="background-overlay" id="background-overlay"></div>
<script>
// Add Customer
var overlay = document.getElementById("background-overlay");
var modalCustomer = document.getElementById("modalCustomer");
var body = document.getElementsByTagName("body");

function addCustomer() {

  overlay.classList.toggle("show");
  modalCustomer.classList.toggle("show");
  if (body[0].style.overflow === "hidden") 
  {
    body[0].style.overflow = ""; // Nếu đã có thì xóa
  }
  else
  {
    body[0].style.overflow = "hidden"; // Nếu chưa có thì thêm
  }
}
// End Add Customer
</script>

@endsection