<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DosenModel extends Model
{
    use HasFactory;

    protected $table = 'dosen';

    protected $fillable = [
        'id', 'name', 'status_id', 'address', 'fakultas_id', 'jurusan_id', 'prov_id', 'city_id', 'dis_id', 'subdis_id', 'Rt'
    ];

    public function status(): BelongsTo
    {
        return $this->belongsTo(StatusModel::class, 'status_id');
    }

    public function fakultas(): BelongsTo
    {
        return $this->belongsTo(FakultasModel::class, 'fakultas_id');
    }

    public function jurusan(): BelongsTo
    {
        return $this->belongsTo(JurusanModel::class, 'jurusan_id');
    }
}
