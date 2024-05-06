<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;

class AccountModel extends Authenticatable
{
    use HasFactory;

    public function hasRole($role)
    {
        return $this->role === $role;
    }

    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $fillable = ['id', 'nama', 'email', 'password', 'role'];

    public function admin(): HasMany
    {
        return $this->hasMany(AdminModel::class);
    }
    public function penduduk(): BelongsTo
    {
        return $this->belongsTo(UserModel::class);
    }

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
}
