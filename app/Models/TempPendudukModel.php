<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TempPendudukModel extends Model
{
    use HasFactory;
    protected $table = 'temporary_penduduk';

    protected $fillable = ['nik', 'no_reg', 'tgl_lahir', 'nama', 'tempat_lahir',
                            'jenis_kelamin', 'rt', 'umur', 'status_kawin', 'status_keluarga', 'agama', 'alamat',
                            'pendidikan', 'pekerjaan', 'akseptor_kb', 'jenis_akseptor', 'aktif_posyandu', 'has_BKB',
                            'has_tabungan', 'ikut_kel_belajar', 'jenis_kel_belajar', 'ikut_paud', 'ikut_koperasi', 'status'];
}
