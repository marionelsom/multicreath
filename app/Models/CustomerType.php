<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class CustomerType extends Model {
    protected $fillable = ['name', 'discount_percentage'];
    public function customers() { return $this->hasMany(Customer::class); }
}
