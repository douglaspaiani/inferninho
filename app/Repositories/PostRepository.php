<?php 

namespace App\Repositories;

use App\Models\Posts;

class PostRepository {

    public function UploadPhoto(array $data){
        return Posts::create($data);
    }
}