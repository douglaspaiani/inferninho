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
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\URL;

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
        'token',
        'username',
        'top',
        'verify',
        'likes',
        'tiktok',
        'instagram',
        'facebook',
        'twitter',
        'site',
        'telegram',
        'description',
        'cpf',
        'pix',
        'creator',
        'price_1',
        'price_3',
        'price_6',
        'hidden_name',
        'zipcode',
        'number',
        'address',
        'complement',
        'neighborhood',
        'city',
        'state',
        'email_verified_at',
        'ban'
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

    public function getUserById(int $id){
        $user = $this->UserRepository->find($id);
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

    public function getIdByUsername(string $username){
        return $this->UserRepository->getIdByUsername($username);
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

    public function UpdateProfile(Request $request, int $id = null){
        $request->validate([
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);
        $user = $request->all();

        // verify exists username
        if(!empty($user['username'])){
            if($this->UserRepository->UserExists($user['username']) == true){
                throw new Exception('Esse nome de usuário já está sendo usado.');
            }
        }
        

        // mount data
        $data = [
            'id' => $id ?? Auth::id(),
            'username' => $user['username'] ?? null,
            'name' => $user['name'],
            'cpf' => $user['cpf'] ?? null,
            'description' => $user['description'] ?? null,
            'tiktok' => $user['tiktok'] ?? null,
            'instagram' => $user['instagram'] ?? null,
            'facebook' => $user['facebook'] ?? null,
            'twitter' => $user['twitter'] ?? null,
            'telegram' => $user['telegram'] ?? null,
            'site' => $user['site'] ?? null,
            'top' => isset($user['top']) == 1 ? 1 : 0,
            'verify' => isset($user['verify']) == 1 ? 1 : 0,
        ];

        if(!empty($user['password'])){
            $data['password'] = Hash::make($user['password']);
        }

        // verify and upload photo
        if($request->hasFile('photo')){
            $data['photo'] = $this->UploadService->UploadPhotoProfile(Auth::id(), $request->file('photo'));
        }

        $this->UserRepository->update($data);

    }

    public function SaveConfig(Request $request){
        $user = $request->all();

        // mount data
        $data = [
            'id' => Auth::id(),
            'hidden_name' => empty($user['hidden_name']) ? 0 : 1,
            'zipcode' => $user['zipcode'] ?? null,
            'address' => $user['address'] ?? null,
            'number' => $user['number'] ?? null,
            'complement' => $user['complement'] ?? null,
            'neighborhood' => $user['neighborhood'] ?? null,
            'city' => $user['city'] ?? null,
            'state' => $user['state'] ?? null
        ];

        $this->UserRepository->update($data);

    }

    public function UpdateSignature(Request $request){
        $user = $request->all();

        // mount data
        $data = [
            'id' => Auth::id(),
            'price_1' => ConvertRealToFloat($user['price_1']) ?? null,
            'price_3' => ConvertRealToFloat($user['price_3']) ?? null,
            'price_6' => ConvertRealToFloat($user['price_6']) ?? null
        ];

        $this->UserRepository->update($data);

    }

    public function search(string $name){
        return $this->UserRepository->search($name);
    }

    public function VerifyCreator(){
        return $this->UserRepository->VerifyCreator();
    }

    public function getBanned(){
        return $this->UserRepository->getBanned();
    }

    public function Ban(int $id){
        return $this->UserRepository->Ban($id);
    }

    public function Unban(int $id){
        return $this->UserRepository->Unban($id);
    }

}
