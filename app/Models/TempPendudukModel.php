<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TempPendudukModel extends Model
{
    use HasFactory;
    protected $table = 'temporary_penduduk';

    protected $fillable = ['id_penduduk', 'no_reg', 'tgl_lahir', 'nama', 'tempat_lahir',
                            'jenis_kelamin', 'rt', 'umur', 'status_kawin', 'status_keluarga', 'agama', 'alamat',
                            'pendidikan', 'pekerjaan', 'akseptor_kb', 'jenis_akseptor', 'aktif_posyandu', 'has_BKB',
                            'has_tabungan', 'ikut_kel_belajar', 'jenis_kel_belajar', 'ikut_paud', 'ikut_koperasi', 'status'];
    
    public function penduduk(): BelongsTo
    {
        return $this->belongsTo(UserModel::class, 'id_penduduk');
    }
}
