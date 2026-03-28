<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class InventoryMovement extends Model {
    protected $fillable = ['product_variant_id', 'type', 'quantity', 'reason', 'reference_id', 'reference_type', 'notes', 'user_id'];
    public function variant() { return $this->belongsTo(ProductVariant::class, 'product_variant_id'); }
    protected static function booted() {
        static::created(function ($movement) {
            $variant = $movement->variant;
            if ($movement->type === 'in') {
                $variant->increment('stock', $movement->quantity);
            } elseif ($movement->type === 'out') {
                $variant->decrement('stock', $movement->quantity);
            } else {
                $variant->update(['stock' => $movement->quantity]);
            }
        });
    }
}
