<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = ['invoice_no', 'invoice_logo', 'date', 'customer', 'subtotal', 'product_id'];

    public function items()
    {
        return $this->hasMany(InvoiceItem::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
