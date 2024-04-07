<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AdminModel extends Model
{
    use HasFactory;

    protected $table = 'admin';
    protected $primaryKey = 'id_admin';

    protected $fillable = ['id_user', 'nama', 'email', 'noHp', 'role'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_user');
    }
    public function berita(): HasMany
    {
        return $this->hasMany(NewsModel::class);
    }
    public function berita_acara(): HasMany
    {
        return $this->hasMany(BeritaAcara::class);
    }
    public function pembayaran(): HasMany
    {
        return $this->hasMany(PaymentModel::class);
    }
}
