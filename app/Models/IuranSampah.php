<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class IuranSampah extends Model
{
    use HasFactory;
    
    protected $table = 'iuran_sampah';
    protected $primaryKey = 'id_iuran_sampah';

    protected $fillable = ['id_pembayaran', 'bulan', 'status'];

    public function pembayaran(): BelongsTo
    {
        return $this->belongsTo(Pembayaran::class, 'id_pembayaran');
    }
}
