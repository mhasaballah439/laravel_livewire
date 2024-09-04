<?php

namespace App\Livewire\Dashboard\app;

use App\Models\Link;
use Livewire\Component;

class Sidebar extends Component
{
    public function render()
    {
        $links = Link::where('parent_id',0)->orderBy('sort_id')->get();

        return view('livewire.dashboard.app.sidebar',[
            'links' => $links
        ]);
    }
}
