<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Gudang extends Model
{
    use HasFactory, Notifiable;
    protected $table = 'sma_warehouses';
    protected $primaryKey = 'id';
    protected $guarded = [];
}
