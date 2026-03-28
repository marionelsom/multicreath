<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Project extends Model {
    protected $fillable = ['customer_id', 'title', 'description', 'status', 'start_date', 'end_date', 'budget'];
    protected $casts = ['budget' => 'decimal:2', 'start_date' => 'date', 'end_date' => 'date'];
    public function customer() { return $this->belongsTo(Customer::class); }
    public function services() { return $this->hasMany(ProjectService::class); }
    public function movements() { return $this->hasMany(ProjectMovement::class)->orderBy('created_at', 'desc'); }
    public function invoices() { return $this->hasMany(Invoice::class); }
    public function getTotalCostAttribute() { return $this->services->sum('subtotal'); }
}
