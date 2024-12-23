<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;
    protected $fillable = ['name','code', 'active'];
    protected $casts = [
      'active' => 'boolean',
      'is_default' => 'boolean',
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
