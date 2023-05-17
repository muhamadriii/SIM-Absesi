<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Attendance extends Model
{
    use HasFactory,SoftDeletes;
    // 0 = hadir
    // 1 = izin
    // 4 = alpa
    // 5 = sakit
    protected $fillable = [
        'teacher_id',
        'nis',
        'status',
        'date',
        'note',
    ];
}
