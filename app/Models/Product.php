<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Product extends Model {
    protected $fillable = ['name', 'category_id', 'unit_id', 'supplier_id', 'description', 'type', 'image_url', 'active'];
    protected $casts = ['active' => 'boolean'];
    public function category() { return $this->belongsTo(Category::class); }
    public function unit() { return $this->belongsTo(Unit::class); }
    public function supplier() { return $this->belongsTo(Supplier::class); }
    public function variants() { return $this->hasMany(ProductVariant::class); }
    public function getTotalStockAttribute() { return $this->variants->sum('stock'); }
}
