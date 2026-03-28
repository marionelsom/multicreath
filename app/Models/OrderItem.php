<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model {
    protected $fillable = ['order_id', 'product_variant_id', 'quantity', 'unit_price', 'subtotal', 'custom_design'];
    protected $casts = ['unit_price' => 'decimal:2', 'subtotal' => 'decimal:2', 'custom_design' => 'array'];
    public function order() { return $this->belongsTo(Order::class); }
    public function variant() { return $this->belongsTo(ProductVariant::class, 'product_variant_id'); }
}
