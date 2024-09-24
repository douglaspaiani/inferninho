<?php

namespace App\Http\Controllers;

use App\Models\Posts;
use App\Models\Subscriptions;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function HomePage(){
        $posts = new Posts();
        return view('app.home', ['posts' => $posts->getPostsHome()]);
    }

    public function UserProfilePage(string $username){
        $user = new User();
        $post = new Posts();
        $subs = new Subscriptions();
        $user = $user->getUserByUsername($username);
        $posts = $post->getPostsByUsername($username);
        $counts = $post->getCounts($username);
        $price = number_format($user['price_1'], 2, ',', '.');
        return view('app.userProfile', ['user' => $user, 'posts' => $posts, 'counts' => $counts, 'price' => $price, 'subscriber' => $subs->validSubscription($user['id'])]);
    }

    public function UserProfilePageGrid(string $username){
        $user = new User();
        $post = new Posts();
        $subs = new Subscriptions();
        $user = $user->getUserByUsername($username);
        $posts = $post->getPostsByUsername($username);
        if($subs->validSubscription($user['id']) == false){
            return redirect()->route('username', ['username' => str_replace('@', '', $user['username'])]);
        }
        return view('app.userProfileGrid', ['user' => $user, 'posts' => $posts]);
    }

    public function ProfilePage(){
        $user = new User();
        $user = $user->getUser();
        return view('app.profile', ['user' => $user]);
    }

    public function ProfilePost(Request $request){
        try {
            $user = new User();
            $user->UpdateProfile($request);
            return redirect()->route('home')->with(['success' => 'Perfil alterado com sucesso!']);
        } catch (Exception $e){
            return redirect()->route('profile')->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function SignaturePage(){
        $user = new User();
        $user = $user->getUser();
        return view('app.signature', ['user' => $user]);
    }

    public function SignaturePost(Request $request){
        try {
            $user = new User();
            $user->UpdateSignature($request);
            return redirect()->route('home')->with(['success' => 'Assinatura alterada com sucesso!']);
        } catch (Exception $e){
            return redirect()->route('signature')->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function ConfigurationsPage(){
        $user = new User;
        return view('app.configurations', ['user' => $user->getUser()]);
    }

    public function ConfigurationsPost(Request $request){
        try {
            $user = new User;
            $user->SaveConfig($request);
            return redirect()->route('configurations')->with(['success' => 'Configurações alteradas com sucesso!']);
        } catch (Exception $e){
            return redirect()->route('configurations')->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function SearchPost(string $search){
        $user = new User;
        return response()->json($user->search($search));
    }
    
}
