<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;


class UserModel extends Authenticatable
{
    use HasFactory;

    protected $table = 'penduduk';
    protected $primaryKey = 'id_penduduk';

    protected $fillable = [ 'tgl_lahir', 'nik', 'nomor_kk', 'nama', 'tempat_lahir',
                            'jenis_kelamin', 'rt', 'status_kawin', 'status_keluarga', 
                            'agama', 'alamat','pendidikan', 'pekerjaan', 'gaji',
                            'pajak_bumi', 'biaya_listrik', 'biaya_air', 'jumlah_kendaraan_bermotor', 'akseptor_kb',
                            'jenis_akseptor', 'aktif_posyandu', 'has_BKB','has_tabungan', 'ikut_kel_belajar',
                            'jenis_kel_belajar', 'ikut_paud', 'ikut_koperasi','jumlah_tanggungan'];

    // public function account(): BelongsTo
    // {
    //     return $this->belongsTo(AccountModel::class, 'id_user');
    // }
    public function pembayaran(): HasMany
    {
        return $this->hasMany(PaymentModel::class, 'nomor_kk');
    }
    public function dokumen(): HasMany
    {
        return $this->hasMany(DocumentModel::class);
    }
    public function temporary_penduduk(): HasMany
    {
        return $this->hasMany(TempResidentModel::class, 'id_penduduk');
    }
    public function akun(): HasMany
    {
        return $this->hasMany(AccountModel::class);
    }
    public function iuran_kematian(): HasMany
    {
        return $this->hasMany(DeathFundModel::class, 'nomor_kk');
    }
    public function iuran_sampah(): HasMany
    {
        return $this->hasMany(GarbageFundModel::class, 'nomor_kk');
    }
}
