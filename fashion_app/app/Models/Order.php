<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $primaryKey = 'order_id';
    protected $fillable = 
        [
            'customer_id',
            'total_amount'
        ];
    
    protected static function boot()
    {
            parent::boot(); // Gọi boot() của lớp cha để đảm bảo các sự kiện khác vẫn hoạt động
    
            // Khi một Order mới được tạo, nếu không có customer_id, gán nó bằng order_id
            static::created(function ($order) {
                if (!$order->customer_id) {
                    $order->customer_id = $order->id;
                    $order->save(); // Cập nhật lại Order với customer_id mới
                }
            });
    }

    // Quan hệ với bảng customers
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id', 'customer_id');
    }
}
