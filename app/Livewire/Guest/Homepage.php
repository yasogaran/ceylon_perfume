<?php
namespace App\Livewire\Guest;

use Livewire\Component;
use App\Models\Product;
use App\Models\HomepageSection;

class Homepage extends Component
{
    public $sections;

    public function mount()
    {
        $this->sections = HomepageSection::where('enabled', true)
            ->orderBy('order')  // this is HomepageSection's order
            ->with(['category', 'products' => function ($query) {
                $query->take(10)->with(['brand', 'tags']);
            }])
            ->get();

            // dd($this->sections); // Debugging line to check product count
    }

    public function render()
    {
        return view('livewire.guest.homepage')
            ->layout('layouts.guest', [
                'title' => 'Welcome to PerfumeCo',
                'metaDescription' => 'Discover our exclusive range of perfumes',
                'metaKeywords' => 'perfume, fragrance, beauty, gifts'
            ]);
    }
}
