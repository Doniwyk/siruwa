<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class AccountModel extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    public function hasRole($role)
    {
        return $this->role === $role;
    }

    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $fillable = ['id_penduduk', 'urlProfile', 'username', 'noHp', 'email', 'password', 'role','image_public_id'];

    public function penduduk(): BelongsTo
    {
        return $this->belongsTo(UserModel::class, 'id_penduduk');
    }
    public function pembayaran(): HasMany
    {
        return $this->hasMany(PaymentModel::class, 'id_admin');
    }
    public function pembayar(): BelongsTo
    {
        return $this->belongsTo(PaymentModel::class, 'id_penduduk');
    }
    public function berita(): HasMany
    {
        return $this->hasMany(EventModel::class, 'id_admin');
    }
    public function agenda(): HasMany
    {
        return $this->hasMany(NewsModel::class, 'id_admin');
    }
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
}
