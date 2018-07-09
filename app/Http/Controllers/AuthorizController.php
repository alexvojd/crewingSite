<?php

namespace app\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use app\Sailor;
use app\Company;
use app\Manager;

class AuthorizController extends Controller
{
 	public function show_view(){
 		$msg="";
 		return view('authorization',compact('msg'));
 	}

 	public function authorization(Request $request){

 		$user_group = $request->user_group;

 		$msg="Неверный логин или пароль!";

 		switch($user_group){

 			case "Sailors":
 				$user = Sailor::checkAndGetUser($request->email,$request->password);
 				if(!$user){
 					$user = Manager::checkAndGetUser($request->email,$request->password);
 					if(!$user) return view('authorization',compact('msg'));
		 			Session::put('user_group', 'Managers');
		 			Session::put('user_id', $user->id);
		 			Session::put('fullname', $user->surname." ".$user->name." ".$user->patronymic);
		 			Session::put('jobID', $user->jobID);
		 			break;
 				}
 				
 				Session::put('user_group', $user_group);
	 			Session::put('user_id', $user->id);
	 			Session::put('fullname', $user->surname." ".$user->name." ".$user->patronymic);
	 			break;
	 				
	 		case "Companies":
	 			$user = Company::checkAndGetUser($request->email,$request->password);
	 			if(!$user){ return view('authorization', compact('msg'));}
	 			Session::put('user_group', $user_group);
	 			Session::put('user_id', $user->id);
	 			Session::put('fullname', $user->name);
	 			Session::put('accepted', $user->accepted);
	 			break;

	 		//default: view('authorization');
 		}
 		return redirect("/profile");
 	}

 	public function logout(){
 		Session::flush();
 		Session::put('user_group', 'Гость');
 		return redirect("/");
 	}   
}
