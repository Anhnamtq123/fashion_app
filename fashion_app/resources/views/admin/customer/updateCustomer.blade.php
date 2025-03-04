@extends('admin.master')
@section('content')

<div class="card">
  <div class="modal-dialog card-body" role="document">
    <div class="modal-content">
      <div class="modal-header border-0">
        <h1>Sửa thông tin khách hàng</h1>
      </div>
      <div class="modal-body">
        <form action="{{route('customer.update',$customer->customer_id)}}" method="POST">
          @csrf
          <input type="hidden" name="_method" value="PUT">
          <div class="row">

            <div class="col-sm-6">
                <div class="form-group form-group-default">
                  <label>Tên khách hàng</label>
                  <input id="customer_name" name="customer_name" type="text" class="form-control" placeholder="Nhập tên" value="{{$customer->customer_name}}"/>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group form-group-default">
                  <label>Số điện thoại</label>
                  <input id="phone_number" name="phone_number" type="text" class="form-control btn-price" placeholder="Số điện thoại" value="{{$customer->phone_number}}" />
                </div>
              </div>

              <div class="col-md-12">
                <div class="form-group form-group-default">
                  <label>Địa chỉ</label>
                  <input id="address" name="address" type="text" class="form-control btn-price" placeholder="Địa chỉ" value="{{$customer->address}}" />
                </div>
              </div>
      
          </div>
          <div class="modal-footer border-0 justify-content-between">
            <button type="submit" id="addRowButton" class="btn btn-primary" >
              Cập nhật
            </button>
            <a href="{{route('admin.customers')}}">
            <button type="button" class="btn btn-danger" data-dismiss="modal" id="hideTable" onclick="addProduct()" >
              Quay lại
            </button>
            </a>
          </div>
        </form>
      </div>
      
    </div>
  </div>
</div>

<script>
  //Add image
  var btnImg = document.getElementById("btn-addImg");
  var fileInput = document.getElementById("fileInput");
  function addImg()
  {
    fileInput.click();
  }
  function previewImage(event) {
  const file = event.target.files[0]; // Lấy file ảnh đầu tiên được chọn
  if (file) {
    const reader = new FileReader(); // Tạo FileReader để đọc file ảnh
    const img = document.getElementById('previewImg');
    reader.onload = function(e) {
       // Lấy thẻ img
      img.src = e.target.result; // Gán đường dẫn ảnh vừa chọn
      img.classList.remove('hidden'); // Hiển thị ảnh (bỏ class hidden)
      // Hiển thị thông tin trên console
      console.log("Tên file:", file.name);
      console.log("Đường dẫn (base64):", e.target.result);
    };
    reader.readAsDataURL(file); // Đọc file ảnh dưới dạng URL
    btnImg.classList.add("hiden");
    img.classList.remove("hiden");
  }
}
</script>
@endsection