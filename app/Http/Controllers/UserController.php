<?php

namespace App\Http\Controllers;

use App\Models\Posts;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    public function HomePage(){
        $posts = new Posts();
        return view('app.home', ['posts' => $posts->getPostsHome()]);
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
