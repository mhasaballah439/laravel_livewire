<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserSpecial extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'active'];
    protected $casts = [
        'active' => 'boolean',
    ];

    public function transalte()
    {
        return $this->morphOne(Transalte::class, 'mediable');
    }

    public function scopeActive($q)
    {
        return $q->where('active',1);
    }
}
