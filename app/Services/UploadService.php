<?php

namespace App\Services;

use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class UploadService {

    protected $UserRepository;
    protected $PostPath = "/app/users/posts";
    protected $ProfilePath = "/app/users/profile";

    public function __construct()
    {
        $this->UserRepository = new UserRepository;
    }

    public function UploadPhotoProfile(int $id, $photo)
    {
        $user = $this->UserRepository->find($id);
        // delete photo if exists
        if(!empty($user['photo'])){
            Storage::delete('/public/app/users/profile/'.$user['photo']);
        }

        // compress image
        $imageCompressed = Image::make($photo->getRealPath());
        $imageCompressed->resize(500, null, function ($constraint) {
            $constraint->aspectRatio();
        });
        // convert to jpg
        $imageCompressed->encode('jpg', 90);
        // filename e destination
        $destinationPath = public_path($this->ProfilePath);
        $filename = $user['username'] . '-' . time() . '-' . rand(0,99999999) . '.jpg';
        // save
        $imageCompressed->save($destinationPath . '/' . $filename);

        return $filename;

    }

    public function UploadPost($photo)
    {
        // compress image
        $imageCompressed = Image::make($photo->getRealPath());
        $imageCompressed->resize(800, null, function ($constraint) {
            $constraint->aspectRatio();
        });
        // convert to jpg
        $imageCompressed->encode('jpg', 90);
        // filename e destination
        $destinationPath = public_path($this->PostPath);
        $filename = 'post-' . time() . '-' . rand(0,99999999) . '.jpg';
        // save
        $imageCompressed->save($destinationPath . '/' . $filename);

        return $filename;

    }
}