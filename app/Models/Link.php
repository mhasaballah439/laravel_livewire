<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Lang;

class Link extends Model
{
    use HasFactory,SoftDeletes;

    public function sub_links()
    {
        return $this->hasMany(Link::class,'parent_id')->orderBy('sort_id');
    }

    public function getNameAttribute()
    {
        if (Lang::getLocale() == 'en')
            return $this->name_en;
        else
            return $this->name_ar;
    }
}
