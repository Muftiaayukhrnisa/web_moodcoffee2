<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'order_number', 'order_type', 'payment_method', 'payment_status', 'order_status', 'total_amount', 'qrcode_payment_token'];
    public function items() { return $this->hasMany(OrderItem::class); }
}