<?php

namespace App\Livewire;

use App\Http\Controllers\Google\GoogleApiAuth;
use App\Livewire\Alert\Notification;
use App\Models\Media;
use App\Models\User;
use Google\Service\Classroom;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;

class ImageController extends Component
{
    use WithFileUploads;

    #[Validate('required|image|max:1024')]
    public $image;

    public $id;

    public function render()
    {
        return view('livewire.image-controller', ['user' => self::user($this->id)]);
    }

    public function save($id)
    {
        $user_details = self::user($id);
        $user_full_name = preg_replace('/\s\s+/', '-', $user_details->first_name . ' ' . $user_details->middle_name . ' ' . $user_details->last_name);

        if ($this->image == null) {
            return Notification::alert($this, 'warning', 'Select image!', "Please select the image file!");
        }

        $image = $this->image->storeAs('public/media/image/user', $id . '_' . $user_full_name . '_' . date('c', time()) . '.' . $this->image->getClientOriginalExtension());

        $file_name = basename($image);
        $path = "storage/media/image/user";

        if (!empty($user_details->media_id)) {
            return Notification::alert($this, 'warning', 'Image upload!', "media already exists!");

            // if (Media::findOrFail($user_details->media_id)->exists()) {
            //     $media = Media::findOrFail($user_details->media_id);
            // }
        }

        if (empty($user_details->media_id)) {
            $media = Media::create([
                'media_title' => $id,
                'media_path' => $path . '/' . $file_name,
                'media_type' => 'image',
                'created_by' => auth()->user()->id,
                'updated_by' => auth()->user()->id,
            ]);
        }

        $user = User::findOrFail($id);
        $user->media_id = $media->id;
        $user->save();

        $this->image = null;
        return Notification::alert($this, 'success', 'Profile Image Uploaded!', "Profile image successfully uploaded!");
    }

    public function user($user_id)
    {
        return User::findOrFail($user_id);
    }

    public function cancel()
    {
        $this->image = null;
        return Notification::alert($this, 'warning', 'Successfully cancelled!', "Successfully cancelled image uploading!");
    }
}
