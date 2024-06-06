<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class NewsModel extends Model
{
    use HasFactory;

    protected $table = 'berita';
    protected $primaryKey = 'id_berita';

    protected $fillable = ['id_admin', 'url_gambar', 'judul', 'isi', 'status', 'image_public_id'];

    public function admin(): BelongsTo
    {
        return $this->belongsTo(AccountModel::class, 'id_admin');
    }

}
