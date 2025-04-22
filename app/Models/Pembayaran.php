<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pembayaran extends Model
{
    // sma_payments
    use HasFactory, Notifiable;
    protected $table = 'sma_payments';
    protected $primaryKey = 'id';
    // protected $guarded = [];
}
