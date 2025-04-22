<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pembelian extends Model
{
    use HasFactory, Notifiable;
    protected $table = 'sma_purchases';
    protected $primaryKey = 'id';
    // protected $guarded = [];
}
