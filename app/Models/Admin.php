<?php

namespace App\Models;

use App\Models\Media;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    use HasFactory,Notifiable,SoftDeletes;

    protected $guarded = [];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function image()
    {
        return $this->morphOne(Media::class, 'mediable')->orderByDesc('id');
    }

    public function permition_group()
    {
        return $this->belongsTo(PermitionGroup::class,'permition_group_id');
    }
}
