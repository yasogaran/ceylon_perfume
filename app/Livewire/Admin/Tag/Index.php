<?php

namespace App\Livewire\Admin\Tag;

use App\Models\Tag;
use Livewire\Component;

class Index extends Component
{
    public function delete($id)
    {
        Tag::findOrFail($id)->delete();
    }

    public function render()
    {
        return view('livewire.admin.tag.index', [
            'tags' => Tag::latest()->get()
        ])->layout('layouts.admin');
    }
}
