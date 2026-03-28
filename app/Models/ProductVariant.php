<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class ProductVariant extends Model {
    protected $fillable = ['product_id', 'name', 'sku', 'size', 'color', 'material', 'sublimation_type', 'cost_price', 'sale_price', 'stock', 'min_stock', 'active'];
    protected $casts = ['active' => 'boolean', 'cost_price' => 'decimal:2', 'sale_price' => 'decimal:2'];
    public function product() { return $this->belongsTo(Product::class); }
    public function inventoryMovements() { return $this->hasMany(InventoryMovement::class); }
    public function orderItems() { return $this->hasMany(OrderItem::class); }
    public function getLowStockAttribute() { return $this->stock <= $this->min_stock; }
}
