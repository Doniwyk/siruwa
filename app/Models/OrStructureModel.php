<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrStructureModel extends Model
{
    use HasFactory;
    protected $table = 'id_struktur';
    protected $primaryKey = 'id_struktur';

    protected $fillable = ['id_struktur', 'nama', 'jabatan'];
}
