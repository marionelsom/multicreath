<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model {
    protected $fillable = ['company_name', 'contact_person', 'phone', 'email', 'address', 'product_category'];
    public function products() { return $this->hasMany(Product::class); }
}
