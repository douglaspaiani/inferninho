<?php

namespace App\Http\Controllers;

use App\Models\Posts;
use Illuminate\Http\Request;

class PhotosSoldController extends Controller
{
    public function PhotosPurchasedPage(){
        $post = new Posts();
        $posts = $post->getPostsPurchased();
        return view('app.purchased', ['posts' => $posts]);
    }
}
