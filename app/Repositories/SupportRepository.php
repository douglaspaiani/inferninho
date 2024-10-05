<?php 

namespace App\Repositories;

use App\Models\Support;
use App\Models\SupportMessage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SupportRepository {

    public function update(array $data){
        return Support::find($data['id'])->update($data);
    }

    public function ListSupport(){
        return DB::table('supports')
        ->join('users', 'supports.user', '=', 'users.id')
        ->where('supports.status', 1)
        ->orderBy('supports.view_admin', 'asc')
        ->select('supports.*','users.name', 'users.email', 'users.username')
        ->get();
    }

    public function ListAllSupport(){
        return DB::table('supports')
        ->join('users', 'supports.user', '=', 'users.id')
        ->orderBy('supports.view_admin', 'asc')
        ->where('supports.status', 1)
        ->select('supports.*','users.name', 'users.email', 'users.username')
        ->limit(8)
        ->get();
    }

    public function ListSupportClosedAdmin(){
        return DB::table('supports')
        ->join('users', 'supports.user', '=', 'users.id')
        ->where('supports.status', 0)
        ->orderBy('supports.view_admin', 'asc')
        ->select('supports.*','users.name', 'users.email', 'users.username')
        ->get();
    }

    public function CountSupport(){
        return Support::where('view_admin', 0)->count();
    }

    public function ListSupportOpen(){
        return Support::where('user', Auth::id())->where('status', 1)->orderBy('view_user', 'asc')->get();
    }

    public function ListSupportClosed(){
        return Support::where('user', Auth::id())->where('status', 0)->orderBy('id', 'desc')->get();
    }

    public function CreateSupport($data){
        return Support::create($data);
    }

    public function MessageSupport($data){
        return SupportMessage::create($data);
    }

    public function GetSupport(int $id){
        return DB::table('supports')
        ->join('users', 'supports.user', '=', 'users.id')
        ->where('supports.id', $id)
        ->select('supports.*','users.name', 'users.photo', 'users.username', 'users.email')
        ->first();
    }

    public function GetMessagesSupport(int $id){
        return SupportMessage::where('support_id', $id)->get();
    }

    public function CloseSupport(int $id){
        return Support::find($id)->update(['status' => 0, 'view_user' => 1, 'view_admin' => 1]);
    }

    public function SupportNotifications(){
        return Support::where('status', 1)->where('user', Auth::id())->where('view_user', 0)->get();
    }

    public function MarkReadUser(int $id){
        return Support::find($id)->update(['view_user' => 1]);
    }

}