<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Models\post;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;

class PostController extends Controller
{
    public function index(){
        return post::all();
    }

    public function store(user $user, post $post, PostRequest $PostRequest){

        $time=Carbon::now();

        $time = $time->addDays(8)->format('Y-m');

        //$post->created_at = $post->created_at->addDays(8)->format('Y-m');

        $post = post::create([
            'author_id'=>$PostRequest->author_id = $user->id,
            'subject'=>$PostRequest->subject,
            'content'=>$PostRequest->content,
            'like'=>$PostRequest->like,
            'date'=>$PostRequest->date = $time,
        ]);

        // dd($post->created_at->addDays(8)->format('Y-m'));



        return $post;
    }

    public function PopuliarPosts(post $post){

        return $post->orderBy('like', 'DESC')->get();
    }

    public function topPopuliarPosts(post $post){

        return $post->orderBy('like', 'DESC')->take(5)->get();
    }

    public function like(post $post, PostRequest $PostRequest){
        $post->update(['like'=>$post->like+1]);

        return $post;
    }

    public function update(post $post, PostRequest $PostRequest){

        $post->update($PostRequest->all());

        return $post;
    }

    public function delete(post $post){

        $post->delete();

        return response()->json(['message'=>"post has been delete"]);
    }

}
