<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PosRegister extends Model
{
    use HasFactory, Notifiable;
    protected $table = 'sma_pos_register';
    protected $primaryKey = 'id';
    // protected $guarded = [];

    public function getUserClosed(): BelongsTo
    {
        return $this->belongsTo(User::class, 'closed_by', 'id');
    }
    public function getUserOpen(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
