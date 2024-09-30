<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{


    public function Login(){
        return view('admin.login');
    }

    public function LoginPost(Request $request){
        $credentials = $request->only('user', 'password');

        if (Auth::guard('admin')->attempt($credentials)) {
            return redirect()->intended(route('admin.dashboard'));
        }

        return back()->withErrors(['email' => 'Credenciais inválidas.']);
    }

    public function Logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }

    public function Dashboard(){
        return view('admin.dashboard');
    }

    public function Creators(){
        $admin = new Admin;
        $users = $admin->GetCreators();
        return view('admin.users.creators', ['users' => $users]);
    }

    public function EditCreator(int $id){
        $user = new User;
        $admin = new Admin;
        return view('admin.users.editCreator', ['user' => $user->getUserById($id), 'count_subscribers' => $admin->CountSubscribers($id)]);
    }

    public function EditCreatorPost(Request $request, int $id){
        try {
            $user = new User();
            $user->UpdateProfile($request, $id);
            return redirect()->route('admin.edit-creator', ['id' => $id])->with(['success' => 'Perfil alterado com sucesso!']);
        } catch (Exception $e){
            return redirect()->route('admin.edit-creator', ['id' => $id])->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function Subscribers(){
        $admin = new Admin;
        $users = $admin->GetSubscribers();
        return view('admin.users.subscribers', ['users' => $users]);
    }

    public function EditSubscriber(int $id){
        $user = new User;
        $subs = new Admin;
        return view('admin.users.editSubscriber', ['user' => $user->getUserById($id), 'subscribers' => $subs->GetSubscribersByUser($id)]);
    }

    public function EditSubscriberPost(Request $request, int $id){
        try {
            $user = new User();
            $user->UpdateProfile($request, $id);
            return redirect()->route('admin.edit-subscriber', ['id' => $id])->with(['success' => 'Perfil alterado com sucesso!']);
        } catch (Exception $e){
            return redirect()->route('admin.edit-subscriber', ['id' => $id])->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function BanUser(int $id){
        $user = new User;
        return view('admin.users.ban', ['user' => $user->getUserById($id)]);
    }

    public function UnbanUser(int $id){
        $user = new User;
        return view('admin.users.unban', ['user' => $user->getUserById($id)]);
    }

    public function BanUserConfirm(int $id){
        $user = new User;
        $user->Ban($id);
        return redirect()->route('admin.banned')->with(['success' => 'Usuário foi banido com sucesso do sistema!']);
    }

    public function Banned(){
        $user = new User;
        return view('admin.users.banned', ['users' => $user->getBanned()]);
    }

    public function UnbanUserConfirm(int $id){
        $user = new User;
        $user->Unban($id);
        return redirect()->route('admin.banned')->with(['success' => 'Usuário foi desbanido com sucesso do sistema!']);
    }
}
