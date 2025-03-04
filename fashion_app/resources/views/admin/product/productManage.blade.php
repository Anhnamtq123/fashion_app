@extends('admin.master')
@section('content')

<div class="col-md-12">
    <div class="card">
      <div class="card-header">
        <div class="item d-flex align-items-center">
          <h4 class="card-title">Danh sách sản phẩm</h4>
          <button class="btn btn-primary btn-round ms-auto" id="btn-addProduct" onclick="addProduct()">
            <i class="fa fa-plus"></i>
            Thêm sản phẩm
          </button>
        </div>

        <nav class="navbar navbar-header-left navbar-expand-lg navbar-form nav-search p-0 d-none d-lg-flex">
          <form action="{{route('admin.products.search')}}" class="input-group">
            <div class="input-group-prepend">
              <button type="submit" class="btn btn-search pe-1">
                <i class="fa fa-search search-icon"></i>
              </button>
            </div>
            <input type="text" name="name" placeholder="Search ..." class="form-control" id="searchProduct">
          </form>
        </nav>

      </div>
      <div class="card-body">
        <!-- Modal -->
        <!--Add product-->
        <div class="modal formAdd" id="modalProduct">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header border-0">
                <h5 class="modal-title">
                  <span class="fw-mediumbold"> Thêm sản phẩm</span>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="addProduct()">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <p class="small">Nhập thông tin sản phẩm</p>
                <form action="{{route('product.store')}}" method="post" enctype="multipart/form-data">
                  @csrf
                  <div class="row">
                    <div class="col-sm-6">
                      <div class="form-group form-group-default">
                        <label>Tên sản phẩm</label>
                        <input id="name" name="name" type="text" class="form-control" placeholder="Nhập tên sản phẩm"/>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group form-group-default">
                        <label>Giá sản phẩm</label>
                        <input id="price" name="price" type="text" class="form-control btn-price" placeholder="Nhập giá sản phẩm"/>
                      </div>
                    </div>

                    <div class="col-md-12">
                      <div class="form-group form-group-default">
                        <label>Mô tả</label>
                        <textarea id="description" name="description " class="w-100" rows="5"></textarea>
                      </div>
                    </div>

                    <div class="col-md-7">
                      <div class="form-group form-group-default text-center">
                        <label>Ảnh sản phẩm</label>
                        <div class="avatar w-100 h-100">
                          <div class="wd-200 hg-200 mx-auto picture-frame" id="btn-addImg" onclick="addImg()">+</div>
                          <img id="previewImg" src="/assets/img/default.jpg" alt="" class="wd-200 hg-200 mx-auto rounded hiden picture-img">
                          <input id="fileInput" name="img" accept="image/*" type="file" class="form-control" onchange="previewImage(event)" hidden />
                        </div>
                      </div>
                    </div>
              
                  </div>
                  <div class="modal-footer border-0">
                    <button type="submit" id="addRowButton" class="btn btn-primary" >
                      Add
                    </button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal" id="hideTable" onclick="addProduct()" >
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
                <th>Ảnh</th>
                <th>Sản phẩm</th>
                <th>Giá</th>
                <th>Ngày tạo</th>
                <th></th>
              </tr>
            </thead>
            <tfoot>
              <tr>
                <th>Ảnh</th>
                <th>Sản phẩm</th>
                <th>Giá</th>
                <th>Ngày tạo</th>
                <th></th>
              </tr>
            </tfoot>
            <tbody>
    
              @foreach ($products as $product )
              
              <tr>
                
                <td>
                    <div class="avatar">
                      @if (!empty($product->img))
                        <img class="avatar-img rounded" src="/uploads/{{$product->img}}" alt="">
                      @else
                        <img class="avatar-img rounded" src="/assets/img/default.jpg" alt="">
                      @endif
                    </div>
                </td>
                <td>
                  <a href="{{route('product.show',$product->product_id)}}">{{$product->name}}</a>
                </td>
                <td>{{$product->price}}</td>
                <td>{{$product->created_at}}</td>
                <td>
                  <div class="form-button-action">
                    <button type="button" data-bs-toggle="tooltip" title="" class="btn btn-link btn-primary btn-lg" data-original-title="Edit Task">
                      <a href="{{route('product.edit',$product->product_id)}}"><i class="fa fa-edit"></i></a>
                    </button>
                    <form action="{{ route('product.destroy', $product->product_id) }}" method="POST" style="display: inline-block;">
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
  // Add Product
  var overlay = document.getElementById("background-overlay");
  var modalProduct = document.getElementById("modalProduct");
  var body = document.getElementsByTagName("body");

  function addProduct() {

    overlay.classList.toggle("show");
    modalProduct.classList.toggle("show");
    if (body[0].style.overflow === "hidden") 
    {
      body[0].style.overflow = ""; // Nếu đã có thì xóa
    }
    else
    {
      body[0].style.overflow = "hidden"; // Nếu chưa có thì thêm
    }
  }

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

//End show boxSerach

</script>
@endsection