@extends('admin.master')
@section('content')

<div class="row">
  <!--Customer-->
  <div class="col-md-12">
    <div class="card card-round">
      <div class="card-header">
        <h4 class="card-title">Thông tin khách hàng</h4>
        <!--Search-->
        <nav class="navbar navbar-header-left navbar-expand-lg navbar-form nav-search p-0 d-none d-lg-flex">
          <div class="input-group">
            <div class="input-group-prepend">
              <button type="submit" class="btn btn-search pe-1">
                <i class="fa fa-search search-icon"></i>
              </button>
            </div>
            <input type="text" placeholder="Search ..." class="form-control" id="searchCustomer">
          </div>
        </nav>
        <div class="d-flex bg-blu position-relative z-index10 hiden" id="customerList">
          
            <div class="w-100 position-absolute bg-blu box-items">
            
              <div class="col-md-12 d-flex item card-header">
                <button class="btn btn-primary btn-round" id="btn-addProduct" onclick="addCustomer()">
                  <i class="fa fa-plus"></i>
                  Thêm khách hàng
                </button>
              </div>
              

              <div class="parent" id="returnCustomers">

                
                

              </div>

            </div>

          </div>
        </div>
        <div class="card-body hg-200">
          <div class="row">
            <input type="hidden" id="customer_id" value="" >
            <h5 id="customer-name">Tên khách hàng</h5>
            <h5 id="customer-phone_number">Số điện thoại</h5>
          </div>
        </div>
        <!--End Search-->
      </div>
      
    </div>
  </div>
  <!--End  Customer -->

  <!-- Product -->
  <div class="col-md-12">
    <div class="card card-round">
      <div class="card-header">
        <h4 class="card-title">Thông tin sản phẩm</h4>
        <!--Search-->
        <nav class="navbar navbar-header-left navbar-expand-lg navbar-form nav-search p-0 d-none d-lg-flex">
          <div class="input-group">
            <div class="input-group-prepend">
              <button type="submit" class="btn btn-search pe-1">
                <i class="fa fa-search search-icon"></i>
              </button>
            </div>
            <input type="text" placeholder="Search ..." class="form-control" id="searchProduct">
          </div>
        </nav>
        <div class="d-flex bg-blu position-relative z-index10 hiden" id="productList">
          
            <div class="w-100 position-absolute bg-blu box-items">
            
              <div class="col-md-12 d-flex item card-header">
                <button class="btn btn-primary btn-round" id="btn-addProduct" onclick="addProduct()">
                  <i class="fa fa-plus"></i>
                  Thêm sản phẩm
                </button>
              </div>
              

              <div class="parent" id="returnProducts">

                

              </div>

            </div>

          </div>
        </div>
        <div class="card-body hg-200">
          <div class="row" id="product_table">
            
            
          </div>
          <button type="button" id="submit_order" class="btn btn-primary" >
            Tạo đơn
          </button>
        </div>
        <!--End Search-->
      </div>
    </div>
  </div>
  <!--End Product -->
</div>
<form id="order_form" action="{{ route('order.store') }}" method="POST">
  @csrf
  <input type="hidden" name="customer_id" id="hidden_customer_id">
  <input type="hidden" name="products" id="hidden_products">
</form>

<button id="submit_order">Đặt hàng</button>
<div class="background-overlay" id="background-overlay"></div>
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
<script src="/assets/js/myJS.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    
</script>
<script>
  // Xem sản phẩm
  $(document).ready(function(){
        $("#searchProduct").on("input", function()
        {
          var query = $(this).val();
          var resultsDiv = $("#returnProducts");

          if (query.length < 2) { 
            resultsDiv.empty(); // Xóa kết quả nếu nhập ít hơn 2 ký tự
            return;
          }
          $.ajax({
                    type: "GET",
                    url: "{{ route('admin.products.searchAjax') }}", // Sử dụng route name
                    data: { name: query },
                    dataType: "json", // Đảm bảo phản hồi JSON
                    success: function (response) {
                      var resultsDiv = $("#returnProducts");
                      resultsDiv.empty(); // Xoá kết quả cũ
                      if (Array.isArray(response)) {
                        response.forEach(product => {
                        resultsDiv.append(`
                                          <div class="col-md-12 d-flex item justify-content-between product-item" data-id="${product.product_id}" data-name="${product.name}" data-price="${product.price}" data-img="${product.img}">
                                            <div class="avatar">
                                              @if (!empty('${product.img}'))
                                                <img src="/uploads/${product.img}" alt="" class="avatar-img rounded">
                                              @else
                                                <img src="/assets/img/default.jpg" alt="" class="avatar-img rounded">
                                              @endif
                                            </div>
                                            <h5 class="">${product.name}</h5>
                                            <h5>Giá: ${product.price}</h5>
                                          </div>
                                          `);
                      });
                      } else {
                        console.error("Dữ liệu không hợp lệ:", response);
                      }
                    }
                });
          
        });
});

  // Xem khách hàng
$(document).ready(function(){
        $("#searchCustomer").on("input", function()
        {
          var query = $(this).val();
          var resultsDiv = $("#returnCustomers");

          if (query.length < 2) { 
            resultsDiv.empty(); // Xóa kết quả nếu nhập ít hơn 2 ký tự
            return;
          }
          $.ajax({
                    type: "GET",
                    url: "{{ route('admin.customers.searchAjax') }}", // Sử dụng route name
                    data: { name: query },
                    dataType: "json", // Đảm bảo phản hồi JSON
                    success: function (response) {
                      var resultsDiv = $("#returnCustomers");
                      resultsDiv.empty(); // Xoá kết quả cũ
                      if (Array.isArray(response)) {
                        response.forEach(customer => {
                        resultsDiv.append(`
                                          <div onclick="hidenCustomer()" class="col-md-12 d-flex item justify-content-around customer-item" data-id="${customer.customer_id}" data-name="${customer.customer_name}" data-phone="${customer.phone_number}">
                                          <h5 class="">Tên khách hàng: ${customer.customer_name}</h5>
                                          <h5>Số điện thoại: ${customer.phone_number}</h5>
                                          </div >
                                          `);
                      });
                      } else {
                        console.error("Dữ liệu không hợp lệ:", response);
                      }
                    }
                });
          
        });
});

// Chọn khách hàng
$(document).on("click", ".customer-item", function () {
        let customer_id = $(this).data("id");
        let name = $(this).data("name");
        let phone = $(this).data("phone");

        $("#customer_id").val(customer_id);
         // Lưu ID khách hàng vào input ẩn


        // Hiển thị thông tin khách hàng đã chọn
        $("#customer-name").text("Tên khách hàng: " + name);
        $("#customer-phone_number").text("Số điện thoại: " + phone);

        // ẩn show Customer sau khi chọn
        $("#customerList").addClass("hiden");

});
       
 // Chọn sản phẩm
 $(document).on("click", ".product-item", function () {
                let product_id = $(this).data("id");
                let name = $(this).data("name");
                let price = $(this).data("price");
                let img = $(this).data("img");

                let row = `
                          <div class="col-md-12 d-flex item justify-content-between" data-id="${product_id}">
                            <div class="avatar">
                              <img class="avatar-img rounded" src="/uploads/${img}" alt="">
                            </div>
                            <h5 class="">${name}</h5>
                            <p><input type="number" class="quantity" value="1"></p>
                            <h5>Giá: ${price}</h5>\
                            <button class="remove">Xóa</button>
                          </div>
                          `;
                $("#product_table").append(row);

                // ẩn show Customer sau khi chọn
                $("#productList").addClass("hiden");
            });
// Xóa sản phẩm khỏi danh sách
$(document).on("click", ".remove", function () {
                $(this).closest(".item").remove();
});

$("#submit_order").click(function () {
  // console.log("abc",$("#customer_id").val()); // ID khách hàng);
  let customer_id = $("#customer_id").val(); // ID khách hàng
  let products = [];
  
  // Duyệt qua danh sách sản phẩm đã chọn
  $("#product_table .item").each(function () {
            let product_id = $(this).data("id"); // Lấy ID từ item
            let quantity = parseInt($(this).find(".quantity").val(), 10); // Lấy số lượng

            if (product_id && quantity > 0) {
                products.push({ product_id: product_id, quantity: quantity });
            }
            console.log($(this).data("id"));
            console.log(quantity);
  });

  // Kiểm tra dữ liệu trước khi gửi
  console.log("Khách hàng:", customer_id);
  console.log("Sản phẩm:", products);

  // Kiểm tra nếu chưa chọn sản phẩm hoặc khách hàng
  if (!customer_id) {
            alert("Vui lòng chọn khách hàng!");
            return;
        }
        if (products.length === 0) {
            alert("Vui lòng chọn ít nhất một sản phẩm!");
            return;
  }

  // Gán dữ liệu vào form ẩn
  $("#hidden_customer_id").val(customer_id);
    $("#hidden_products").val(JSON.stringify(products));

    // Gửi form
     $("#order_form").submit()

    

});

</script>
@endsection