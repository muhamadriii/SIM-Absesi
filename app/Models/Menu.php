<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Menu extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'route',
        'parent_id',
        'permission_id',
    ];

    protected $appends = ['slug'];

    public function getSlugAttribute()
    {
        return Str::slug($this->name, '_');
    }

    public function parent(){
        return $this->belongsTo(Menu::class, 'parent_id', 'id');
    }

    public function childrens()
    {
        return $this->hasMany(Menu::class, 'parent_id');
    }

    // public function permission()
    // {
    //     return $this->belongsTo(\Spatie\Permission\Models\Permission::class);
    // }
}
