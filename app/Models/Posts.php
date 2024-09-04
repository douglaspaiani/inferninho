<?php

namespace App\Models;

use App\Jobs\ProcessPosts;
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

    public function NewPostMedia(Request $request): void
    {
        $photosArray = [];
        $request->validate([
            'photos.*' => 'image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $photos = $request->file('photos');
        $video = $request->file('video');

        // verify empty
        if(empty($photos) && empty($video)){
            throw new Exception('Você deve escolher uma foto ou vídeo para publicar.');
        }

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
                'photos' => serialize($photosArray),
                'description' => $request->get('description') ?? null
            ];

        }

        $this->PostRepository->setPost($data);

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
