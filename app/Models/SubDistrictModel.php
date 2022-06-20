<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubDistrictModel extends Model
{
    use HasFactory;

    protected $table = 'subdistricts';

    protected $fillable = [
        'subdis_id', 'subdis_name', 'dis_id'
    ];
}
