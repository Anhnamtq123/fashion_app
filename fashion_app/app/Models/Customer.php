<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    protected $primaryKey = 'customer_id'; 
    protected $fillable = [
        'customer_name',
        'phone_number',
        'address',
        'current_debt', // Công nợ hiện tại
        'total_spent', // Tổng chi tiêu
        'total_orders', // Tổng số lượng đơn hàng
    ];
}
