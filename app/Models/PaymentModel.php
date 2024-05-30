<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PaymentModel extends Model
{
    use HasFactory;
    
    protected $table = 'pembayaran';
    protected $primaryKey = 'id_pembayaran';


    protected $fillable = ['id_admin', 'nomor_kk' ,'jenis', 'metode', 'urlBuktiPembayaran', 'image_public_id', 'jumlah', 'status', 'keterangan_status'];


    public function admin(): BelongsTo
    {
        return $this->belongsTo(AccountModel::class, 'id_admin');
    }
    public function penduduk(): BelongsTo
    {
        return $this->belongsTo(UserModel::class, 'nomor_kk');
    }
    public function iuran_kematian(): HasMany
    {
        return $this->hasMany(DeathFundModel::class);
    }
    public function iuran_sampah(): HasMany
    {
        return $this->hasMany(GarbageFundModel::class);
    }
}
