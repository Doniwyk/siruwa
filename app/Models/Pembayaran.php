<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Pembayaran extends Model
{
    use HasFactory;
    
    protected $table = 'pembayaran';
    protected $primaryKey = 'id_pembayaran';

    protected $fillable = ['id_penduduk', 'jenis', 'metode', 'jumlah', 'status'];

    public function admin(): BelongsTo
    {
        return $this->belongsTo(Admin::class, 'id_admin');
    }
    public function penduduk(): BelongsTo
    {
        return $this->belongsTo(Penduduk::class, 'id_penduduk');
    }
    public function iuran_kematian(): HasMany
    {
        return $this->hasMany(IuranKematian::class);
    }
    public function iuran_sampah(): HasMany
    {
        return $this->hasMany(IuranSampah::class);
    }
}
