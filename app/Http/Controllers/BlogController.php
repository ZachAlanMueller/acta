<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;

class BlogController extends Controller
{
	public function home(){
		return view('landing');
	}

	public function posts(){
        $user_id = 0;
        if(Auth::check()){
            $user_id = Auth::user()->id;
        }
		$posts = DB::table('posts')->join('users', 'users.id', '=', 'posts.author_id')->select('posts.id as id', 'status', 'title', 'content', 'author_id', 'posts.created_at as created_at', 'posts.updated_at as updated_at', 'name')->whereRaw('status = 1 OR (status = 3 and author_id = '.$user_id.")")->orderBy('posts.created_at', 'desc')->limit(10)->get();
		return view('posts')->with(['posts' => $posts]);
	}

    public function createPost(){
    	if(Auth::check() && Auth::user()->id == 1 /* TODO Fix this so that it checks if allowed to post, not ID */){
    		return view('createPost');
    	}
    	else{
    		return redirect('/')->with('notification', "You are not allowed to create a new post")->with('notificationType', 'warning');
    	}
    }

    public function viewPost($id = null){
    	$post = DB::table('posts')->join('users', 'users.id', '=', 'posts.author_id')->where('posts.id', $id)->first();
    	// var_dump($post[0]);
    	// die();
    	if(is_null($post)){
    		return view('404');
    	}
    	else{
  			return view('viewPost')->with(['post' => $post]);
    	}
    }

    public function submitPost(Request $request){

    	if(Auth::check() && Auth::user()->id == 1 /* TODO Fix this so that it checks if allowed to post, not ID */){

    		str_replace('<', '&lt;', $request['content']);
    		str_replace('>', '&gt;', $request['content']);
    		str_replace('<', '&lt;', $request['title']);
    		str_replace('>', '&gt;', $request['title']);

    		$dbIns = [ 'status' => $request['status'], 'title' => $request['title'], 'content' => $request['content'], 'author_id' => Auth::user()->id, 'created_at' => now(), 'updated_at' => now(), 'tag_id' => $request['tag_id']];
    		DB::table('posts')->insert($dbIns);
                        if($request['status'] == 3){
                return redirect('/')->with('notification', "Successfully saved draft.");
            }
    		return redirect('/')->with('notification', "Successfully created a new post!");
    	}
    	else{
    		return redirect('/')->with('notification', 'You are not allowed to create a new post');
    	}

    }

    public function editPost($id = null){
    	if(Auth::check() && Auth::user()->id == 1 /* TODO Fix this so that it checks if allowed to post, not ID */){
    		$post = DB::table('posts')->join('users', 'users.id', '=', 'posts.author_id')->where('posts.id', $id)->first();
    		return view('editPost')->with(['post' => $post, 'id' => $id]);
    	}
    	else{
    		return redirect('/')->with('notification', "You are not allowed to create a new post")->with('notificationType', 'warning');
    	}
    }

    public function updatePost(Request $request, $id = null){

    	if(Auth::check() && Auth::user()->id == 1 /* TODO Fix this so that it checks if allowed to post, not ID */){

    		str_replace('<', '&lt;', $request['content']);
    		str_replace('>', '&gt;', $request['content']);
    		str_replace('<', '&lt;', $request['title']);
    		str_replace('>', '&gt;', $request['title']);
    		$dbUpdate = [ 'status' => $request['status'], 'title' => $request['title'], 'content' => $request['content'], 'author_id' => Auth::user()->id, 'updated_at' => now()];
    		DB::table('posts')->where('id', $id)->update($dbUpdate);
            if($request['status'] == 3){
                return redirect('/')->with('notification', "Successfully saved draft.");
            }
    		return redirect('/')->with('notification', "Successfully updated a post!");
    	}
    	else{
    		return redirect('/')->with('notification', 'You are not allowed to create a new post');
    	}

    }

    public function adminEdit(){
        if(Auth::check() && Auth::user()->id == 1 /* TODO Fix this so that it checks if allowed to post, not ID */){
            $sidebarItems = DB::table('sidebar')->get();
            return view('adminEditSidebar')->with('sidebarItems', $sidebarItems);
        }
        else{
            return redirect('/')->with('notification', 'You are not allowed to view that page');
        }

    }

    public function adminEditAjax(Request $request){
        if($request->action == 'getSidebarInfo'){
            $info = DB::table('sidebar')->whereNull('deleted_at')->orderBy('order', 'asc')->get();
            return response()->json(['success'=>'Data received!', 'info' => $info]);
        }
    }
}
