<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Order extends Model {
    protected $fillable = ['customer_id', 'order_number', 'status', 'subtotal', 'tax', 'total', 'payment_method', 'payment_status', 'shipping_address', 'notes'];
    protected $casts = ['subtotal' => 'decimal:2', 'tax' => 'decimal:2', 'total' => 'decimal:2'];
    public function customer() { return $this->belongsTo(Customer::class); }
    public function items() { return $this->hasMany(OrderItem::class); }
    public function invoices() { return $this->hasMany(Invoice::class); }

    protected static function booted() {
        static::creating(function ($order) {
            if (!$order->order_number) {
                $order->order_number = 'ORD-' . strtoupper(uniqid());
            }
        });
    }
}
