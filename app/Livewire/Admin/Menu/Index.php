<?php

namespace App\Livewire\Admin\Menu;

use App\Models\Menu;
use Livewire\Component;

class Index extends Component
{
    public $menus;

    protected $listeners = ['menuUpdated' => 'loadMenus'];

    public function mount()
    {
        $this->loadMenus();
    }

    public function loadMenus()
    {
        $this->menus = Menu::with(['category', 'brand'])->orderBy('order')->get();
    }

    public function toggleEnabled($id)
    {
        $menu = Menu::findOrFail($id);
        $menu->enabled = !$menu->enabled;
        $menu->save();

        $this->loadMenus();
    }

    public function deleteMenu($id)
    {
        $menu = Menu::findOrFail($id);
        $menu->delete();
        $this->loadMenus();
    }

    public function moveUp($id)
    {
        $current = Menu::findOrFail($id);
        $above = Menu::where('order', '<', $current->order)->orderBy('order', 'desc')->first();
        if ($above) {
            [$current->order, $above->order] = [$above->order, $current->order];
            $current->save();
            $above->save();
            $this->loadMenus();
        }
    }

    public function moveDown($id)
    {
        $current = Menu::findOrFail($id);
        $below = Menu::where('order', '>', $current->order)->orderBy('order')->first();
        if ($below) {
            [$current->order, $below->order] = [$below->order, $current->order];
            $current->save();
            $below->save();
            $this->loadMenus();
        }
    }

    public function render()
    {
        return view('livewire.admin.menu.index')->layout('layouts.admin');
    }
}
