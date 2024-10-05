<?php

namespace App\Models;

use App\Repositories\SupportRepository;
use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;

class Support extends Model
{
    use HasFactory;

    protected $fillable = [
        'user',
        'title',
        'view_admin',
        'view_user',
        'status'
    ];

    protected $SupportRepository;

    public function __construct()
    {
        $this->SupportRepository = new SupportRepository;
    }

    public function ListSupport(){
        return $this->SupportRepository->ListSupport();
    }

    public function ListAllSupport(){
        return $this->SupportRepository->ListAllSupport();
    }

    public function ListSupportClosedAdmin(){
        return $this->SupportRepository->ListSupportClosedAdmin();
    }

    public function ListSupportOpen(){
        return $this->SupportRepository->ListSupportOpen();
    }

    public function ListSupportClosed(){
        return $this->SupportRepository->ListSupportClosed();
    }

    public function CreateSupport(Request $request):void
    {
        $data = $request->all();

        $support = $this->SupportRepository->CreateSupport([
            'title' => $data['title'],
            'user' => Auth::id()
        ]);

        if($support){
            $this->SupportRepository->MessageSupport([
                'support_id' => $support->id,
                'message' => $data['message'],
                'user' => 1,
                'admin' => 0
            ]);
        } else {
            throw new Exception('Erro ao abrir o chamado.');
        }

    }

    public function ResponseSupportUser(int $id, Request $request):void
    {

        $data = $request->all();

        $support = $this->SupportRepository->update([
            'id' => $id,
            'view_user' => 1,
            'view_admin' => 0
        ]);
        if($support){
            $this->SupportRepository->MessageSupport([
                'support_id' => $id,
                'message' => $data['message'],
                'user' => 1,
                'admin' => 0
            ]);
        } else {
            throw new Exception('Erro ao responder o chamado.');
        }

    }

    public function ResponseSupportAdmin(int $id, Request $request):void
    {

        $data = $request->all();

        $support = $this->SupportRepository->update([
            'id' => $id,
            'view_user' => 0,
            'view_admin' => 1
        ]);
        if($support){
            $this->SupportRepository->MessageSupport([
                'support_id' => $id,
                'message' => $data['message'],
                'user' => 0,
                'admin' => 1
            ]);
        } else {
            throw new Exception('Erro ao responder o chamado.');
        }
        
    }

    public function GetSupport(int $id){
        $support = $this->SupportRepository->GetSupport($id);

        if($support->photo){
            $photo = env('PROFILE_IMG').$support->photo;
        } else {
            $photo = URL::asset('app/images/user-default.jpg');
        }
        
        return [
            'support' => $support,
            'photo' => $photo,
            'name' => $support->name,
            'email' => $support->email,
            'username' => $support->username
        ];
    }

    public function MarkReadUser(int $id){
        return $this->SupportRepository->MarkReadUser($id);
    }

    public function GetMessagesSupport(int $id){
        return $this->SupportRepository->GetMessagesSupport($id);
    }

    public function CloseSupport(int $id){
        return $this->SupportRepository->CloseSupport($id);
    }

    public function CountSupport(){
        return $this->SupportRepository->CountSupport();
    }

}
