<?php

namespace App\Livewire\Admin\Homepage;

use App\Models\HomepageSection;
use Livewire\Component;

class Sections extends Component
{
    public function render()
    {
        $sections = HomepageSection::with('category')->orderBy('order')->get();

        return view('livewire.admin.homepage.sections', [
            'sections' => $sections,
        ])->layout('layouts.admin');
    }

    public function toggleVisibility($id)
    {
        $section = HomepageSection::findOrFail($id);
        $section->enabled = !$section->enabled;
        $section->save();
    }

    public function moveUp($id)
    {
        $section = HomepageSection::findOrFail($id);
        $section->order = max(0, $section->order - 1);
        $section->save();
    }

    public function moveDown($id)
    {
        $section = HomepageSection::findOrFail($id);
        $section->order += 1;
        $section->save();
    }
}