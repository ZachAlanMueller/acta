<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use Illuminate\Support\Facades\Auth;
use DB;

class AjaxController extends Controller
{
    public function getTags(Request $request){
    	$tags = DB::table('tags')->whereNull('deleted_at')->get();
    	return response()->json(['success'=>'Data received!', 'info' => $tags]);
    }
}
