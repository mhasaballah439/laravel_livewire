<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable,SoftDeletes;

    protected $connection = 'mysql';
    protected $fillable = [
        'username',
        'name',
        'email',
        'phone',
        'store_name',
        'password',
    ];
    protected $hidden = [
        'password',
        'remember_token',
    ];
    protected $casts = [
        'active' => 'boolean',
        'email_verified_at' => 'datetime',
    ];

    public function scopeActive($q)
    {
        return $q->where('active',1);
    }

    public function image()
    {
        return $this->morphOne(Media::class, 'mediable')->orderByDesc('id');
    }
    public function language()
    {
        return $this->belongsTo(Language::class, 'default_lang_id');
    }
    public function currency()
    {
        return $this->belongsTo(Currency::class, 'currency_id');
    }
    public function special()
    {
        return $this->belongsTo(UserSpecial::class, 'special_id');
    }

}
