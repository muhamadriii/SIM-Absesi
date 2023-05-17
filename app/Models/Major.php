<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Major extends Model
{
    use HasFactory;

    protected $fillable = [
        'parent_id',
        'name',
    ];

    public function childrens(){
        
    }

    public function parent(){
        return $this->belongsTo(Major::class, 'parent_id', 'id');
    }
}
