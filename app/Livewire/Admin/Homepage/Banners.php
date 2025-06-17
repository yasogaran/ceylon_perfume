<?php
namespace App\Livewire\Admin\Homepage;

use App\Models\HomepageBanner;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class Banners extends Component
{
    use WithFileUploads;

    public $bannerImage;

    public function save()
    {
        $this->validate([
            'bannerImage' => 'required|image|max:2048',
        ]);

        $path = $this->bannerImage->store('banners', 'public');

        HomepageBanner::create([
            'image_path' => $path,
            'order' => HomepageBanner::max('order') + 1,
        ]);

        $this->reset('bannerImage');
    }

    public function delete($id)
    {
        $banner = HomepageBanner::findOrFail($id);
        Storage::disk('public')->delete($banner->image_path);
        $banner->delete();
    }

    public function render()
    {
        return view('livewire.admin.homepage.banners', [
            'banners' => HomepageBanner::orderBy('order')->get(),
        ])->layout('layouts.admin');
    }
}
