<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataDashboardModel extends Model
{
    use HasFactory;
    protected $table = 'data_dashboard';
    protected $primaryKey = 'id_dataDashboard';
    protected $fillable = ['total_penduduk','fasilitas_kesehatan','fasilitas_administrasi','fasilitas_pendidikan'];
}
