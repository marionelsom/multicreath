<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Quotation extends Model {
    protected $fillable = ['customer_id', 'quotation_number', 'type', 'status', 'items', 'subtotal', 'discount', 'tax', 'total', 'valid_until'];
    protected $casts = ['items' => 'array', 'subtotal' => 'decimal:2', 'discount' => 'decimal:2', 'tax' => 'decimal:2', 'total' => 'decimal:2', 'valid_until' => 'date'];
    public function customer() { return $this->belongsTo(Customer::class); }

    protected static function booted() {
        static::creating(function ($q) {
            if (!$q->quotation_number) {
                $q->quotation_number = 'COT-' . date('Y') . '-' . str_pad(static::count() + 1, 4, '0', STR_PAD_LEFT);
            }
        });
    }
}
