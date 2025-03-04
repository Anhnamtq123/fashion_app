<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    public function searchAjax(Request $request)
    {
        $name = $request->input('name');
        // Tìm sản phẩm theo tên
        if (!$name) {
            $products = Product::all();
        } else {
            // Tìm sản phẩm theo tên
            $products = Product::where('name', 'LIKE', "%$name%")->get();
        }
        return response()->json($products);
    }

    public function search(Request $request)
    {
        $name = $request->input('name');
        // Tìm sản phẩm theo tên
        if (!$name) {
            $products = Product::all();
        } else {
            // Tìm sản phẩm theo tên
            $products = Product::where('name', 'LIKE', "%$name%")->get();
        }
        return view('admin.product.productManage',compact('products'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'img' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048' // Kiểm tra file ảnh
        ]);
    
        // Lấy tên file gốc
        $imageName = "defaulut.jpg";
        if(!empty($request->file('img')))
        {
            $imageName = $request->file('img')->getClientOriginalName();
            $path = $request->file('img')->move(public_path('uploads/'), $imageName); // Lưu vào thư mục public
        }

        // Tạo sản phẩm mới
        $product = Product::create([
            'name' => $request->input('name'),
            'price' => $request->input('price'),
            'description' => $request->input('description'),
            'img' => $imageName // Lưu tên file vào database
        ]);

        return back()->with('success', 'Sản phẩm đã được cập nhật!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return view('admin.product.infoProducts', ['product' => $product]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        return view('admin.product.updateProducts', ['product' => $product]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {

        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'img' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048' // Kiểm tra file ảnh
        ]);
    
        $product = Product::findOrFail($product->product_id); // Tìm sản phẩm cần cập nhật
    
        // Kiểm tra nếu người dùng chọn file ảnh mới
        if ($request->hasFile('img')) {
            // Xóa ảnh cũ nếu có
            if ($product->img && file_exists(public_path('uploads/' . $product->img))) {
                unlink(public_path('uploads/' . $product->img));
            }
    
            // Lưu ảnh mới
            $file = $request->file('img');
            $fileName = $file->getClientOriginalName();
            $file->move(public_path('uploads'), $fileName);
        } else {
            // Nếu không có ảnh mới, giữ lại tên ảnh cũ
            $fileName = $product->img;
        }
    
        // Cập nhật thông tin sản phẩm
        $product->update([
            'name'  => $request->name,
            'price' => $request->price,
            'img'   => $fileName, // Lưu tên ảnh vào database
            'description' => $request->description
        ]);
    
        return back()->with('success', 'Sản phẩm đã được cập nhật!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
                // Tìm sản phẩm theo ID
        $product = Product::findOrFail($product->product_id);
    
        // Nếu sản phẩm có ảnh, xóa ảnh khỏi thư mục public/uploads
        if ($product->img && file_exists(public_path('uploads/' . $product->img))) {
            unlink(public_path('uploads/' . $product->img));  // Xóa ảnh
        }
    
        // Xóa sản phẩm khỏi cơ sở dữ liệu
        $product->delete();
    
        // Trả về thông báo thành công và quay lại trang trước
        return back()->with('success', 'Sản phẩm đã được xóa!');
    }
}
