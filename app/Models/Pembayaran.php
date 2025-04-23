<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pembayaran extends Model
{
    // sma_payments
    use HasFactory, Notifiable;
    protected $table = 'sma_payments';
    protected $primaryKey = 'id';
    // protected $guarded = [];

    public function getUserPembuat(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }
    public function getPenjualan(): BelongsTo
    {
        return $this->belongsTo(Penjualan::class, 'sale_id', 'id');
    }
    public function getPembelian(): BelongsTo
    {
        return $this->belongsTo(Pembelian::class, 'purchase_id', 'id');
    }
}
