<?php

namespace app\Http\Controllers;

use Illuminate\Http\Request;
use app\Resume;
use DB;
use Session;
use app\Sailor;
use app\Visa;
use app\Vacancy;

class CatalogViewController extends Controller
{
    public function show_resumes(Request $request){

        $englishLevel = $request->englishLevel;
        $role = $request->role;
        
        $roleSign = "=";
        $engSign = "=";

        if(!isset($request->englishLevel) || $request->englishLevel == "Any"){
            $englishLevel = 0;
            $engSign = ">";
        }
        if(!isset($request->role) || $request->role == "Any"){
            $role = 0;
            $roleSign = ">";
        }

        $resumes = Resume::where('idLevelOfEng',$engSign, $englishLevel)
                    ->where('idRole', $roleSign, $role)
                    ->where('hidden','0')
                    ->paginate(10);

        $englishLevels = DB::table('EnglishLevels')->get();   
        $roles = DB::table('Roles')->get();

    	return view('resumeview', compact('resumes', 'roles', 'englishLevels'));
    }

    public function show_resume($id){

    	$user_group = Session::get('user_group');
    	$isAuthorized = false;
        $self_user = false;
    	if($user_group!='Гость' && isset($user_group)){
    		$isAuthorized = true;
    	}
    	$sailor = Sailor::find($id);
    	if($sailor==null){
            redirect('/resume');
        }
    	$resume = $sailor->resume;

    	
        if($resume==null){
            redirect('/resume');
        }
        if($resume->hidden == 1 && $user_group != "Managers"){
            redirect('/resume');
        }

        if ($id == Session::get('user_id')){
            $self_user = true;
        }else{
            $resume->views = $resume->views + 1;
            $resume->save();
        }

    	$passports = $resume->passports;
    	$certificates = $resume->certificates;
    	$role = $resume->role;
    	$englishLevel = $resume->englishLevel;
    	$visas = $resume->visas;
        $experience = $resume->experience;
    	return view('resume', compact('resume', 'sailor', 'visas', 'passports', 'certificates', 'isAuthorized', 'role', 'englishLevel', 'experience', 'self_user'));
    }

    public function show_vacancies(Request $request){

        $englishLevel = $request->englishLevel;
        $role = $request->role;
        
        $roleSign = "=";
        $engSign = "=";

        if(!isset($request->englishLevel) || $request->englishLevel == "Any"){
            $englishLevel = 0;
            $engSign = ">";
        }
        if(!isset($request->role) || $request->role == "Any"){
            $role = 0;
            $roleSign = ">";
        }

        $vacancies = Vacancy::where('idLevelOfEng',$engSign, $englishLevel)
                    ->where('idRole', $roleSign, $role)
                    ->where('hidden','0')
                    ->paginate(10);

        $englishLevels = DB::table('EnglishLevels')->get();   
        $roles = DB::table('Roles')->get();

        return view('vacancyview', compact('vacancies', 'roles', 'englishLevels'));
    }

    public function show_vacancy($id){

        $user_group = Session::get('user_group');
        $isAuthorized = false;
        if($user_group!='Гость' && isset($user_group)){
            $isAuthorized = true;
        }
        $vacancy = Vacancy::find($id);
        if($vacancy==null){
            redirect('/vacancy');
        }
        $company = $vacancy->company;
        if($company==null){
            redirect('/vacancy');
        }
        $engineType = $vacancy->engineType;
        $vesselType = $vacancy->vesselType;
        $role = $vacancy->role;
        $englishLevel = $vacancy->englishLevel;
        return view('vacancy', compact('vacancy', 'company', 'engineType', 'vesselType', 'englishLevel', 'role', 'isAuthorized'));
    }

}
