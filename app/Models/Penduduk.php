<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;


class Penduduk extends Model
{
    use HasFactory;

    protected $table = 'penduduk';
    protected $primaryKey = 'id_penduduk';

    protected $fillable = ['id_user', 'urlProfile', 'no_reg', 'tgl_lahir', 'nik', 'nama', 'tempat_lahir',
                            'jenis_kelamin', 'rt', 'umur', 'status_kawin', 'status_keluarga', 'agama', 'alamat',
                            'pendidikan', 'pekerjaan', 'akseptor_kb', 'jenis_akseptor', 'aktif_posyandu', 'has_BKB',
                            'has_tabungan', 'ikut_kel_belajar', 'jenis_kel_belajar', 'ikut_paud', 'ikut_koperasi'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_user');
    }
    public function pembayaran(): HasMany
    {
        return $this->hasMany(Pembayaran::class);
    }
    public function dokumen(): HasMany
    {
        return $this->hasMany(Dokumen::class);
    }
}