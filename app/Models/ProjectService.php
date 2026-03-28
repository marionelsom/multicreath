<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class ProjectService extends Model {
    protected $fillable = ['project_id', 'service_variant_id', 'quantity', 'unit_price', 'subtotal', 'status'];
    protected $casts = ['unit_price' => 'decimal:2', 'subtotal' => 'decimal:2'];
    public function project() { return $this->belongsTo(Project::class); }
    public function serviceVariant() { return $this->belongsTo(ServiceVariant::class, 'service_variant_id'); }
}
