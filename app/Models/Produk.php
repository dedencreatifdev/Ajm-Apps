<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Produk extends Model
{
    // sma_warehouses_products
    use HasFactory, Notifiable;
    protected $table = 'sma_warehouses_products';
    protected $primaryKey = 'id';
    protected $guarded = [];

    /**
     * Get the user that owns the Produk
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function getProdukDetail(): BelongsTo
    {
        return $this->belongsTo(ProdukDetail::class, 'product_id', 'id');
    }

    public function getGudang(): BelongsTo
    {
        return $this->belongsTo(Gudang::class, 'warehouse_id', 'id');
    }

}
