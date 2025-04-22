<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Penjualan extends Model
{
    use HasFactory, Notifiable;
    protected $table = 'sma_sales';
    protected $primaryKey = 'id';
    // protected $guarded = [];
}
