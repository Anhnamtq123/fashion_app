<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class OrderController extends Controller
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
        return view('admin.order.createOrder');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        dump($request->all());
        // phải chuyển đổi products về mảng do khi truyền leen đang ở dạng json
        $request->merge(['products' => json_decode($request->products, true)]);

        $validatedData = $request->validate([
            'customer_id' => 'required|exists:customers,customer_id',
            'products'    => 'required|array',
            'products.*.product_id' => 'required|exists:products,product_id',
            'products.*.quantity' => 'required|integer|min:1'
        ]);

        try {
            // Bắt đầu transaction
            DB::beginTransaction();

            // 1️⃣ Tạo đơn hàng trong bảng `orders`
            $order = Order::create([
                'customer_id' => $validatedData['customer_id'],
                'total_amount' => 0, // Chưa tính tổng
            ]);
            echo "Order";
            dump($order->id);

            $totalAmount = 0;

            // 2️⃣ Lưu các sản phẩm vào `order_details`
            foreach ($validatedData['products'] as $productData) {
                $product = Product::findOrFail($productData['product_id']);
                $subtotal = $product->price * $productData['quantity'];
                $totalAmount += $subtotal;

                OrderDetail::create([
                    'order_id' => $order->order_id,
                    'product_id' => $productData['product_id'],
                    'quantity' => $productData['quantity'],
                    'subtotal' => $subtotal
                ]);
            }

            // 3️⃣ Cập nhật tổng tiền đơn hàng
            $order->update(['total_amount' => $totalAmount]);
            echo "Order";
            dump($order);
            // Hoàn thành transaction
            DB::commit();

            return redirect()->route('admin.orders')->with('success', 'Tạo thành công!');

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'loi tao don hang',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }
}
