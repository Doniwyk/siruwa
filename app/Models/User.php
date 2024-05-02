<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Model
{
    use HasFactory;
    
    protected $table = 'user';
    protected $primaryKey = 'id_user';

    protected $fillable = ['nama', 'password', 'isAdmin'];

    public function admin(): HasMany
    {
        return $this->hasMany(Admin::class);
    }
    public function penduduk(): HasMany
    {
        return $this->hasMany(Penduduk::class);
    }
}