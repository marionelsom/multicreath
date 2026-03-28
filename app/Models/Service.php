<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Service extends Model {
    protected $fillable = ['name', 'category_id', 'unit_id', 'description', 'active'];
    protected $casts = ['active' => 'boolean'];
    public function category() { return $this->belongsTo(Category::class); }
    public function unit() { return $this->belongsTo(Unit::class); }
    public function variants() { return $this->hasMany(ServiceVariant::class); }
}
