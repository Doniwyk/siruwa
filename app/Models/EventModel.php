<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EventModel extends Model
{
    use HasFactory;

    protected $table = 'agenda';
    protected $primaryKey = 'id_berita_acara';

    protected $fillable = ['id_admin', 'url_gambar', 'judul', 'isi', 'tanggal'];

    public function admin(): BelongsTo
    {
        return $this->belongsTo(AccountModel::class, 'id_admin');
    }
}
