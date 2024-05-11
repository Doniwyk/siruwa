<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DeathFundModel extends Model
{
    use HasFactory;
    
    protected $table = 'iuran_kematian';
    protected $primaryKey = 'id_iuran_kematian';

    protected $fillable = ['id_pembayaran', 'nomor_kk', 'bulan', 'status'];

    public function pembayaran(): BelongsTo
    {
        return $this->belongsTo(PaymentModel::class, 'id_pembayaran');
    }
    public function penduduk(): BelongsTo
    {
        return $this->belongsTo(UserModel::class, 'nomor_kk');
    }
    
}
