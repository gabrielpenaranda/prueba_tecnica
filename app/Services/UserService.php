<?php
namespace App\Services;

use Illuminate\Http\UploadedFile;

class UserService
{

    public function userPhoto(UploadedFile $photo)
    {
        $path = $photo->store('users', 'public');
        return 'storage/' . $path;
    }
}
