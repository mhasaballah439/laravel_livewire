<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Addition extends Model
{
    use HasFactory;

    protected $casts = [
        'active' => 'boolean',
    ];

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
