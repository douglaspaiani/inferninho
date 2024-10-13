<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Gifts;
use App\Models\Support;
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
            session(['admin' => true]);
            return redirect()->intended(route('admin.dashboard'));
        }

        return back()->withErrors(['email' => 'Credenciais inválidas.']);
    }

    public function Logout()
    {
        Auth::guard('admin')->logout();
        session(['admin' => false]);
        return redirect()->route('admin.login');
    }

    public function Dashboard(){
        $admin = new Admin;
        $support = new Support;
        $creators = $admin->CountAllCreators();
        $subscribers = $admin->CountAllSubscribers();
        $countGifts = $admin->CountAllGifts();
        $subscriptions = $admin->CountAllSubscriptions();
        $views = $admin->CountAllViews();
        $supports = $support->ListAllSupport();
        return view('admin.dashboard', ['countGifts' => $countGifts, 'subscribers' => $subscribers, 'creators' => $creators, 'subscriptions' => $subscriptions, 'views' => $views, 'supports' => $supports]);
    }

    public function Invoicing(Request $request){
        $date = null;
        if(!empty($request->get('month'))){
            $month = $request->get('month');
            $year = $request->get('year');
            $date = $month."-".$year;
        } else {
            $month = date('m');
            $year = date('Y');
            $date = $month."-".$year;
        }
        $admin = new Admin;
        $support = new Support;
        $creators = $admin->CountAllCreators($date);
        $subscribers = $admin->CountAllSubscribers($date);
        $countGifts = $admin->CountAllGifts($date);
        $subscriptions = $admin->CountAllSubscriptions($date);
        $views = $admin->CountAllViews($date);
        $supports = $support->ListAllSupport();
        $invoiceSubs = $admin->GetInvoicingSubscriptions($date);
        $photos = $admin->GetInvoicingPhotos($date);
        $gifts = $admin->GetInvoicingGifts($date);
        return view('admin.invoice.invoicing', ['countGifts' => $countGifts, 'photos' => $photos, 'gifts' => $gifts, 'year' => $year ?? null, 'month' => $month ?? null, 'invoiceSubs' => $invoiceSubs, 'subscribers' => $subscribers, 'creators' => $creators, 'subscriptions' => $subscriptions, 'views' => $views, 'supports' => $supports]);
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

    public function SupportPage(){
        $support = new Support;
        return view('admin.support.support', ['supports' => $support->ListSupport(), 'closeds' => $support->ListSupportClosedAdmin()]);
    }

    public function SupportClosedPage(){
        $support = new Support;
        return view('admin.support.supportClosed', ['supports' => $support->ListSupportClosedAdmin()]);
    }

    public function ReadSupport(int $id){
        $support = new Support;
        $sup = $support->GetSupport($id);
        return view('admin.support.readSupport', ['support' => $sup['support'], 'messages' => $support->GetMessagesSupport($id), 'photo' => $sup['photo'], 'name' => $sup['name'], 'email' => $sup['email'], 'username' => $sup['username']]);
    }

    public function AddResponseSupport(int $id, Request $request){
        $support = new Support;
        try {
            $support->ResponseSupportAdmin($id, $request);
        } catch (Exception $e){
            return redirect()->route('admin.support')->withErrors(['error' => $e->getMessage()]);
        }
        
        return redirect()->route('admin.support')->with(['success' => 'Resposta enviada com sucesso!']);
    }

    public function CloseSupport(int $id){
        $support = new Support;
        $support->CloseSupport($id);
        return redirect()->route('admin.support')->with(['success' => 'Chamado fechado com sucesso!']);
    }

    public function Gifts(){
        $gift = new Gifts;
        $gifts = $gift->getAll();
        return view('admin.gifts.gifts', ['gifts' => $gifts]);
    }
}
