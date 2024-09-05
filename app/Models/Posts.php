<?php

namespace App\Models;

use App\Jobs\ProcessPosts;
use App\Repositories\PostRepository;
use App\Services\UploadService;
use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;

class Posts extends Model
{
    use HasFactory;

    protected $fillable = [
        'user',
        'description',
        'photos'
    ];

    protected $PostRepository;
    protected $UploadService;

    public function __construct()
    {
        $this->PostRepository = new PostRepository;
        $this->UploadService = new UploadService;
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
                $upload = $this->UploadService->UploadPost($photo);
                array_push($photosArray, $upload);
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

    public function getPostsByUsername(string $username){
        return $this->PostRepository->getPostsByUsername($username);
    }

    public function getCounts(string $username){
        return [
            'photos' => $this->PostRepository->countPosts($username),
            'videos' => $this->PostRepository->countVideos($username),
            'likes' => $this->PostRepository->countLikes($username)
        ];
    }

    public function like(int $idPost){
        $post = $this->PostRepository->getById($idPost);
        $post->increment('likes');
        return $post->likes;
    }
}
