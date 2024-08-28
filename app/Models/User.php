<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Repositories\UserRepository;
use Carbon\Carbon;
use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $UserRepository;

    public function __construct()
    {
        $this->UserRepository = new UserRepository;
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
}
