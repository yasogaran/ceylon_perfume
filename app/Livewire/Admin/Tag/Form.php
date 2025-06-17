<?php

namespace App\Livewire\Admin\Tag;

use App\Models\Tag;
use Livewire\Component;

class Form extends Component
{
    public ?Tag $tag = null;
    public $title;
    public $type;

    public function mount($tag = null)
    {
        $this->tag = $tag;
        $this->title = $tag?->title;
        $this->type = $tag?->type;
    }

    public function save()
    {
        $this->validate([
            'title' => 'required|string|max:255',
            'type' => 'nullable|string|max:50',
        ]);

        Tag::updateOrCreate(
            ['id' => $this->tag?->id],
            ['title' => $this->title, 'type' => $this->type]
        );

        return redirect()->route('admin.tags.index');
    }

    public function render()
    {
        return view('livewire.admin.tag.form')->layout('layouts.admin');
    }
}
