<?php

namespace App\Livewire\Guest;

use Livewire\Component;
use App\Models\Menu;

class MenuLivewire extends Component
{
    public $menus;

    public function mount()
    {
        // Load menus ordered by 'order' and only enabled
        $this->menus = Menu::where('enabled', true)
            ->orderBy('order')
            ->get();
    }

    public function render()
    {
        return view('livewire.guest.menu-livewire');
    }
}
