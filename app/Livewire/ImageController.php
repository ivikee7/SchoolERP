<?php

namespace App\Livewire;

use App\Livewire\Alert\Notification;
use App\Models\Media;
use App\Models\User;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;

class ImageController extends Component
{
    use WithFileUploads;

    #[Validate('image|max:1024')]
    public $image;

    public $id;

    public function render()
    {
        return view('livewire.image-controller');
    }

    public function save($id)
    {
        // dd(date('c', time()));
        $image = $this->image->storeAs('public/media/image/user', $id . date('c', time()) . '.' . $this->image->getClientOriginalExtension());

        $file_name = basename($image);
        $path = "storage/media/image/user";

        $media = Media::create([
            'media_title' => $id,
            'media_path' => $path . '/' . $file_name,
            'media_type' => 'image',
            'created_by' => auth()->user()->id,
            'updated_by' => auth()->user()->id,
        ]);

        $user = User::findOrFail($id);
        $user->media_id = $media->id;
        $user->save();

        return Notification::alert($this, 'success', 'Success!', "Profile image successfully uploaded!");
    }
}
