<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BeritaAcara extends Model
{
    use HasFactory;

    protected $table = 'berita_acara';
    protected $primaryKey = 'id_berita_acara';

    protected $fillable = ['id_admin', 'url_gambar', 'judul', 'isi', 'tanggal'];

    public function admin(): BelongsTo
    {
        return $this->belongsTo(AdminModel::class, 'id_admin');
    }
}
