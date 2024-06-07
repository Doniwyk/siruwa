<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IncomeModel extends Model
{
    use HasFactory;

    protected $table = 'pemasukan';
    protected $primaryKey = 'id_pemasukan';

    protected $fillable = ['jumlah_pemasukan','jenis_pemasukan'];

}
