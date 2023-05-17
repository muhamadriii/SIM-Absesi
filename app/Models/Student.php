<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Student extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'major_id',
        'rayon_id',
        'image',
        'name',
        'nis',
        'jk',
        'dob',
        'telp',
    ];

    
    public function major()
    {
        return $this->belongsTo(Major::class);
    }
    
    public function rayon()
    {
        return $this->belongsTo(Rayon::class);
    }
}
