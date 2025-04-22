<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProdukDetail extends Model
{
    use HasFactory, Notifiable;
    protected $table = 'sma_products';
    protected $primaryKey = 'id';
    protected $guarded = [];

    /**
     * Get the user that owns the Produk
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function getSatuan(): BelongsTo
    {
        return $this->belongsTo(Satuan::class, 'unit', 'id');
    }
    public function getKategori(): BelongsTo
    {
        return $this->belongsTo(Kategori::class, 'category_id', 'id');
    }
    public function getMerk(): BelongsTo
    {
        return $this->belongsTo(Merk::class, 'brand', 'id');
    }
}
