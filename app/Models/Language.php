<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    use HasFactory;

    protected $fillable = ['name','code', 'active'];
    protected $casts = [
        'active' => 'boolean',
    ];

    public function scopeActive($q)
    {
        return $q->where('active',1);
    }
}
