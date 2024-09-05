<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Repositories\UserRepository;
use App\Services\UploadService;
use Carbon\Carbon;
use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
use Spatie\ImageOptimizer\OptimizerChainFactory;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $UserRepository;
    protected $UploadService;

    public function __construct()
    {
        $this->UserRepository = new UserRepository;
        $this->UploadService = new UploadService;
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'birth',
        'photo',
        'cover',
        'cards',
        'token',
        'username',
        'top',
        'verify',
        'likes',
        'description',
        'cpf',
        'pix',
        'creator',
        'email_verified_at'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function getUser(){
        $user = $this->UserRepository->find(Auth::id());
        $user['link'] = env('APP_URL').'/'.$user['username'];
        if(empty($user['photo'])){
            $user['photo'] = URL::asset('app/images/user-default.jpg');
        } else {
            $user['photo'] = env('PROFILE_IMG').$user['photo'];
        }
        $user['user'] = $user['username'];
        $user['username'] = '@'.$user['username'];
        return $user;
    }

    public function getUserByUsername(string $username){
        $user = $this->UserRepository->getUserByUsername($username);
        if(empty($user['photo'])){
            $user['photo'] = URL::asset('app/images/user-default.jpg');
        } else {
            $user['photo'] = env('PROFILE_IMG').$user['photo'];
        }
        $user['username'] = '@'.$user['username'];

        return $user;
    }

    public function RegisterNewUser(array $data){
        // verify password
        if($data['password'] != $data['new-password']){
            throw new Exception('As senhas não correspondem, tente novamente.');
        }
        // verify age
        if(CalculateAge($data['birth']) < 18){
            throw new Exception('Você precisa ser maior de 18 anos.');
        }
        // verify email
        if(User::where('email', $data['email'])->count() > 0){
            throw new Exception('E-mail já cadastrado no sistema, tente outro.');
        }
        // format date
        $data['birth'] = Carbon::parse($data['birth']);
        // encrypt password
        $data['password'] = bcrypt($data['password']);

        $this->UserRepository->Register($data);

    }

    public function UpdateProfile(Request $request){
        $request->validate([
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);
        $user = $request->all();

        // verify exists username
        if($this->UserRepository->UserExists($user['username']) == true){
            throw new Exception('Esse nome de usuário já está sendo usado.');
        }

        // mount data
        $data = [
            'id' => Auth::id(),
            'username' => $user['username'],
            'description' => $user['description']
        ];

        // verify and upload photo
        if($request->hasFile('photo')){
            $data['photo'] = $this->UploadService->UploadPhotoProfile(Auth::id(), $request->file('photo'));
        }

        $this->UserRepository->update($data);

    }

}
