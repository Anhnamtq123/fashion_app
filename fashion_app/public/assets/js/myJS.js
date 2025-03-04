// show boxSerach
var searchCustomer = document.getElementById("searchCustomer");
var customerList = document.getElementById("customerList");

var searchProduct = document.getElementById("searchProduct");
var productList = document.getElementById("productList");


  // Lắng nghe sự kiện
  document.addEventListener("DOMContentLoaded", function () {

    // Hiển thị gợi ý khi click vào ô tìm kiếm
    searchProduct.addEventListener("focus", function () {
      productList.classList.remove("hiden");
    });

    searchCustomer.addEventListener("focus", function () {
      customerList.classList.remove("hiden");
    });

    // Ẩn gợi ý khi click ra ngoài
    document.addEventListener("click", function (event) {
        if (!searchProduct.contains(event.target) && !productList.contains(event.target)) {
          productList.classList.add("hiden");
        }
    });

    document.addEventListener("click", function (event) {
      if (!searchCustomer.contains(event.target) && !customerList.contains(event.target)) {
        customerList.classList.add("hiden");
      }
    });

});
//End show boxSerach

//ADD product
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
// AND Product
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