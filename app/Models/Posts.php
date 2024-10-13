<?php

namespace App\Models;

use App\Repositories\PostRepository;
use App\Services\UploadService;
use Carbon\Carbon;
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
        'photos',
        'value',
        'schedule',
        'likes',
        'video',
        'nocomments',
        'private',
        'due_date',
        'public',
        'timer',
        'views'
    ];

    protected $PostRepository;
    protected $UploadService;

    public function __construct()
    {
        $this->PostRepository = new PostRepository;
        $this->UploadService = new UploadService;
    }

    public function comments()
    {
        return $this->hasMany(Comments::class, 'post');
    }

    public function getPost(int $id){
        return $this->PostRepository->getPost($id);
    }

    public function NewPostMedia(Request $request): void
    {
        $photosArray = [];
        $public = 0;
        $timer = 0;
        $due_date = Carbon::parse('2999-12-01 00:00:00');
        $request->validate([
            'photos.*' => 'image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $photos = $request->file('photos');
        $video = $request->file('video');

        if($request->get('24h') == 1){
            if($request->get('schedule')){
                $due_date = Carbon::parse($request->get('schedule'))->addHours(24);
            } else {
                $due_date = Carbon::now()->addHours(24);
            }
            $timer = 1;
        }
        if($request->get('announce') > 0){
            $due_date = Carbon::now()->addDays((int)$request->get('announce'));
            $public = 1;
        }

        if(!empty($request->get('value')) && ConvertRealToFloat($request->get('value')) < env('MIN_PHOTO_PRIVATE')){
            throw new Exception('O valor mínimo da foto é de R$ '.env('MIN_PHOTO_PRIVATE').'.');
        }

        // mout data
        $data = [
            'user' => Auth::id(),
            'description' => $request->get('description') ?? null,
            'schedule' => $request->get('schedule') ? Carbon::parse($request->get('schedule'))->format('Y-m-d H:i:s') : Carbon::now(),
            'nocomments' => $request->get('nocomments') ?? 0,
            'value' => $request->get('value') ? ConvertRealToFloat($request->get('value')) : 0,
            'private' => $request->get('value') ? 1 : 0,
            'due_date' => $due_date,
            'public' => $public,
            'timer' => $timer
        ];

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

            $data['photos'] = serialize($photosArray);

        }

        $this->PostRepository->setPost($data);
    }

    public function EditPost(int $id, Request $request){
        $data = [
            'id' => $id,
            'description' => $request->get('description')
        ];
        $this->PostRepository->update($data);
    }

    public function DeletePost(int $id){
        $this->PostRepository->DeletePost($id);
    }

    public function getPostsHome(){
        return $this->PostRepository->getPostsHome();
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

    public function getIdUserByPost(int $id){
        return $this->PostRepository->getIdUserByPost($id);
    }

    public function getPostsPurchased(){
        return $this->PostRepository->getPostsPurchased();
    }

    public function getValue(int $id){
        return $this->PostRepository->getValue($id);
    }
}
