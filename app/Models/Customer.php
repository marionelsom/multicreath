<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model {
    protected $fillable = ['full_name', 'email', 'phone', 'address', 'customer_type_id', 'nit', 'company_name', 'contact_person', 'credit_limit', 'credit_used', 'active'];
    protected $casts = ['active' => 'boolean', 'credit_limit' => 'decimal:2', 'credit_used' => 'decimal:2'];
    public function type() { return $this->belongsTo(CustomerType::class, 'customer_type_id'); }
    public function orders() { return $this->hasMany(Order::class); }
    public function projects() { return $this->hasMany(Project::class); }
    public function quotations() { return $this->hasMany(Quotation::class); }
    public function invoices() { return $this->hasMany(Invoice::class); }
}
