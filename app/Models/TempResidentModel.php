<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TempResidentModel extends Model
{
    use HasFactory;
    protected $table = 'penduduk_temporary';
    protected $primaryKey = 'id_temporary';

    protected $fillable = [
        'id_penduduk','no_reg', 'tgl_lahir', 'nik', 'nomor_kk', 'nama', 'tempat_lahir',
        'jenis_kelamin', 'rt', 'umur', 'status_kawin', 'status_keluarga', 'agama', 'alamat',
        'pendidikan', 'pekerjaan', 'gaji', 'pajak_bumi', 'biaya_listrik', 'biaya_air',
        'jumlah_kendaraan_bermotor', 'akseptor_kb', 'jenis_akseptor', 'aktif_posyandu', 'has_BKB',
        'has_tabungan', 'ikut_kel_belajar', 'jenis_kel_belajar', 'ikut_paud', 'ikut_koperasi'
    ];
    
    public function penduduk(): BelongsTo
    {
        return $this->belongsTo(UserModel::class, 'id_penduduk');
    }
    public function umur()
    {
        return Carbon::parse($this->tgl_lahir)->age;
    }
}
