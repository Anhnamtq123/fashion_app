@extends('admin.master')
@section('content')

<div class="card">
  <div class="modal-dialog card-body" role="document">
    <div class="modal-content">
      <div class="modal-header border-0">
        <h1>Sửa sản phẩm</h1>
      </div>
      <div class="modal-body">
        <form action="{{route('product.update',$product->product_id)}}" method="POST" enctype="multipart/form-data">
          @csrf
          <input type="hidden" name="_method" value="PUT">
          <div class="row">
            <div class="col-sm-6">
              <div class="form-group form-group-default">
                <label>Tên sản phẩm</label>
                <input id="name" name="name" type="text" class="form-control" placeholder="Nhập tên sản phẩm" value="{{$product->name}}"/>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group form-group-default">
                <label>Giá sản phẩm</label>
                <input id="price" name="price" type="text" class="form-control btn-price" placeholder="Nhập giá sản phẩm" value="{{$product->price}}" />
              </div>
            </div>

            <div class="col-md-12">
              <div class="form-group form-group-default">
                <label>Mô tả</label>
                <textarea id="description" name="description " class="w-100" rows="5">{{$product->discription}}</textarea>
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-group form-group-default text-center">
                <label>Ảnh sản phẩm</label>
                <div class="avatar w-100 h-100">
                  @if (!empty($product->img))
                    <img src="/uploads/{{$product->img}}" alt="" class="wd-200 hg-200 mx-auto rounded picture-img">
                  @else
                    <img src="/assets/img/default.jpg" alt="" class="wd-200 hg-200 mx-auto rounded picture-img">
                  @endif
                </div>
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-group form-group-default text-center">
                <label>Ảnh mới</label>
                <div class="avatar w-100 h-100">
                  <div class="wd-200 hg-200 mx-auto picture-frame" id="btn-addImg" onclick="addImg()">+</div>
                  <img id="previewImg" src="/assets/img/default.jpg" alt="" class="wd-200 hg-200 mx-auto rounded hiden picture-img">
                  <input id="fileInput" name="img" accept="image/*" type="file" class="form-control" onchange="previewImage(event)" hidden />
                </div>
              </div>
            </div>
      
          </div>
          <div class="modal-footer border-0 justify-content-between">
            <button type="submit" id="addRowButton" class="btn btn-primary" >
              Cập nhật
            </button>
            <a href="{{route('admin.products')}}">
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