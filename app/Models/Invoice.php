<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model {
    protected $fillable = ['customer_id', 'order_id', 'project_id', 'invoice_number', 'status', 'subtotal', 'tax', 'total', 'issued_at', 'due_date', 'payment_date'];
    protected $casts = ['subtotal' => 'decimal:2', 'tax' => 'decimal:2', 'total' => 'decimal:2', 'issued_at' => 'datetime', 'due_date' => 'date', 'payment_date' => 'date'];
    public function customer() { return $this->belongsTo(Customer::class); }
    public function order() { return $this->belongsTo(Order::class); }
    public function project() { return $this->belongsTo(Project::class); }

    protected static function booted() {
        static::creating(function ($invoice) {
            if (!$invoice->invoice_number) {
                $invoice->invoice_number = 'INV-' . date('Y') . '-' . str_pad(static::count() + 1, 5, '0', STR_PAD_LEFT);
            }
        });
    }
}
