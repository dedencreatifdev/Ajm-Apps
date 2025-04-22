<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Expence extends Model
{
    use HasFactory, Notifiable;
    protected $table = 'sma_expenses';
    protected $primaryKey = 'id';
    // protected $guarded = [];

    public function getGudang(): BelongsTo
    {
        return $this->belongsTo(Gudang::class, 'warehouse_id', 'id');
    }
    public function getKategoriExpence(): BelongsTo
    {
        return $this->belongsTo(ExpenceKategori::class, 'category_id', 'id');
    }
    public function getUserPembuat(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }
}
