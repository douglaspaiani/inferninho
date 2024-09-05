<?php

namespace App\Http\Controllers;

use App\Models\Posts;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;

class UserController extends Controller
{

    public function HomePage(){
        $posts = new Posts();
        return view('app.home', ['posts' => $posts->getPostsHome()]);
    }

    public function UserProfilePage(string $username){
        $user = new User();
        $post = new Posts();
        $user = $user->getUserByUsername($username);
        $posts = $post->getPostsByUsername($username);
        $counts = $post->getCounts($username);
        return view('app.userProfile', ['user' => $user, 'posts' => $posts, 'counts' => $counts]);
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

    public function FollowingPage(){
        return view('app.following');
    }

    public function CreditCardsPage(){
        return view('app.creditCards');
    }

    public function AddCreditCardPage(){
        return view('app.addCreditCard');
    }
}
