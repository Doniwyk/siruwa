<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Dokumen extends Model
{
    use HasFactory;
    
    protected $table = 'dokumen';
    protected $primaryKey = 'id_dokumen';

    protected $fillable = ['id_penduduk', 'jenis', 'status', 'keterangan_status', 'keperluan', 'alasan_ditolak'];

    public function penduduk(): BelongsTo
    {
        return $this->belongsTo(UserModel::class, 'id_penduduk');
    }
}
