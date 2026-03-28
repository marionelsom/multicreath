<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class ServiceVariant extends Model {
    protected $fillable = ['service_id', 'name', 'sku', 'cost_price', 'sale_price', 'features', 'delivery_days', 'revisions_included', 'active'];
    protected $casts = ['active' => 'boolean', 'features' => 'array', 'cost_price' => 'decimal:2', 'sale_price' => 'decimal:2'];
    public function service() { return $this->belongsTo(Service::class); }
    public function projectServices() { return $this->hasMany(ProjectService::class); }
}
