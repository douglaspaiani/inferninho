<?php

namespace App\Models;

use App\Repositories\PostRepository;
use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Posts extends Model
{
    use HasFactory;

    protected $fillable = [
        'user',
        'description',
        'photos'
    ];

    protected $PostRepository;

    public function __construct()
    {
        $this->PostRepository = new PostRepository;
    }

    public function NewPost(Request $request){
        $photosArray = [];
        $request->validate([
            'photos' => 'required',
            'photos.*' => 'image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $photos = $request->file('photos');

        // verify qtd photos
        if (count($photos) > 5) {
            throw new Exception('Você não pode enviar mais do que 5 fotos.');
        }

        if(count($photos) > 0){
            // upload photos
            foreach ($photos as $photo) {
                $photoName = time().'_'.md5($photo->getClientOriginalName()).'-'.rand(0,99999999).'.jpg';
                $photo->move(public_path('app/uploads'), $photoName);
                array_push($photosArray, $photoName);
            }

            $data = [
                'user' => Auth::id(),
                'description' => $request->get('description') ?? null,
                'photos' => serialize($photosArray)
            ];
            if(!$this->PostRepository->UploadPhoto($data)){
                foreach ($photosArray as $photo) {
                    $path = public_path('app/uploads/' . $photo);
                    if (file_exists($path)) {
                        unlink($path);
                    }
                }
            }
        }
    }

    public function getPostsHome(){
        return $this->PostRepository->getPostAndUser();
    }

    public function like(int $idPost){
        $post = $this->PostRepository->getById($idPost);
        $post->increment('likes');
        return $post->likes;
    }
}
