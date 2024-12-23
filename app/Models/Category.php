<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory,SoftDeletes;

    protected $casts = [
        'active' => 'boolean',
        'active_in_menu' => 'boolean',
    ];

    public function transalte()
    {
        return $this->morphOne(Transalte::class, 'mediable');
    }

    public function image()
    {
        return $this->morphOne(TenantMedia::class, 'mediable')->orderByDesc('id');
    }

    public function image_path($tenant)
    {
        $image = null;

        if ($tenant) {
            $tenant->run(function () use (&$image) {
                $image = isset($this->image) ? asset($this->image->file_path) : '';
            });
        }

        return $image;
    }
}
