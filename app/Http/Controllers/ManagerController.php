<?php

namespace app\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use app\Resume;
use DB;
use app\Sailor;
use app\Company;
use app\Manager;
use app\Vacancy;
use app\UserRequest;

class ManagerController extends Controller
{


    public function show_sailors(Request $request){

        if(Session::get('user_group') != 'Managers'){
            return redirect('/');
        }

        $salaryFrom = $request->salaryFrom;
        $salaryTo = $request->salaryTo;
        $readyFrom = $request->readyFrom;
        $readyTo = $request->readyTo;
        $country = $request->country;
        $region = $request->region;
        $city = $request->city;
        $englishLevel = $request->englishLevel;
        $role = $request->role;
        $visaUSA = $request->visaUSA;
        $visaSchengen = $request->visaSchengen;
        $experience = $request->experience;
        $sailor_id = $request->sailorId;

        $expSign = ">=";
        $visaUSASign = "=";
        $visaSchengenSign = "=";
        $roleSign = "=";
        $countrySign = "=";
        $regionSign = "=";
        $citySign = "=";
        $englishSign = ">=";
        $visaSign = "=";
        $sailorIdSign = "=";

        $research = false;

        if(isset($visaUSA)){
            $visaType = 1;
        }
        if(isset($visaSchengen)){
            $visaType = 2;
        }
        if(!isset($request->salaryFrom)){
             $salaryFrom = 0;
        }
        if(!isset($request->salaryTo)){
             $salaryTo = 40000;
        }
        if(!isset($request->readyFrom)){
             $readyFrom = date('Y-m-d');
        }
        if(!isset($request->readyTo)){
             $readyTo = "2100-10-10";
        }
        if(!isset($request->country) || $request->country == "Any"){
            $country = "Any";
            $countrySign = ">";
        }
        if(!isset($request->region) || $request->region == "Any"){
            $region = "Any";
            $regionSign = ">";
        }
        if(!isset($request->city) || $request->city == "Any"){
            $city = "Any";
            $citySign = ">";
        }
        if(!isset($request->englishLevel) || $request->englishLevel == "Any"){
            $englishLevel = 0;
            $englishSign = ">";
        }
        if(!isset($request->role) || $request->role == "Any"){
            $role = 0;
            $roleSign = ">";
        }
        if(isset($visaUSA) && isset($visaSchengen)){
            $visaType = 0;
            $visaSign = ">";
            $research = true;
        }
        if (!isset($visaUSA) && !isset($visaSchengen)){
            $visaType = 0;
            $visaSign = ">";
        }
        if (isset($experience) && $experience != "Any"){

            $expResearch = true;

        }else{

            $expResearch = false;
        }
        if (!isset($request->sailorId)){

            $sailor_id = 0;
            $sailorIdSign = ">";
        }

    	$resumes = Resume::paginate(2);

    	$countries = DB::table('country')->get();	
		$roles = DB::table('Roles')->get();
		$englishLevels = DB::table('EnglishLevels')->get();
        $visaTypes = DB::table('VisaTypes')->get();
        $resumes = Resume::all();
        
        if(!$research){
                    $resumes = DB::table('Resumes')
                    ->select('Sailors.id as idS', 'Resumes.availableDate as availableDate', 'Roles.name as role', 'EnglishLevels.englishLevel as englishLevel', 'Resumes.salary as salary','Sailors.name as name', 'Sailors.surname as surname', 'Sailors.patronymic as patronymic', 'Sailors.birthDate as birthDate', 'Resumes.id as id')
                    ->join('Roles', 'Roles.id', '=', 'Resumes.idRole')
                    ->join('Sailors', 'Sailors.id', '=', 'Resumes.idSailor')
                    ->join('Visas', 'Visas.idResume', '=', 'Resumes.id')
                    ->join('Experience', 'Experience.idResume', '=', 'Resumes.id')
                    ->join('EnglishLevels', 'EnglishLevels.id', '=', 'Resumes.idLevelOfEng')
                    ->where('Sailors.id', $sailorIdSign, $sailor_id)
                    ->whereBetween('Resumes.salary', [$salaryFrom, $salaryTo])
                    ->whereBetween('Resumes.availableDate', [$readyFrom, $readyTo])
                    ->where('Sailors.country',$countrySign, $country)
                    ->where('Sailors.region',$regionSign, $region)
                    ->where('Sailors.city',$citySign, $city)
                    ->where('Resumes.idLevelOfEng', $englishSign, $englishLevel)
                    ->where('Resumes.idRole', $roleSign, $role)
                    ->where('Visas.idVisaType', $visaSign, $visaType)
                    ->groupBy('Resumes.id')
                    //->distinct('id')
                    ->paginate(10);
        }else{

                    $resumes = DB::table('Resumes')
                    ->select('Resumes.id as id')
                    ->join('Roles', 'Roles.id', '=', 'Resumes.idRole')
                    ->join('Sailors', 'Sailors.id', '=', 'Resumes.idSailor')
                    ->join('Experience', 'Experience.idResume', '=', 'Resumes.id')
                    ->join('EnglishLevels', 'EnglishLevels.id', '=', 'Resumes.idLevelOfEng')
                    ->where('Sailors.id', $sailorIdSign, $sailor_id)
                    ->whereBetween('Resumes.salary', [$salaryFrom, $salaryTo])
                    ->whereBetween('Resumes.availableDate', [$readyFrom, $readyTo])
                    ->where('Sailors.country',$countrySign, $country)
                    ->where('Sailors.region',$regionSign, $region)
                    ->where('Sailors.city',$citySign, $city)
                    ->where('Resumes.idLevelOfEng', $englishSign, $englishLevel)
                    ->where('Resumes.idRole', $roleSign, $role)
                    ->groupBy('Resumes.id')
                    ->get();

                    $resumesIds = ManagerController::ToArray($resumes);
                        $filteredIds = [];
                        foreach ($resumesIds as $key => $id) {
                            $countOfVisa = DB::table('Visas')->where('idResume',$id)->count();
                            if($countOfVisa == 2){
                                array_push($filteredIds, $id);
                            }
                        }
                    $resumes = DB::table('Resumes')
                    ->select('Sailors.id as idS', 'Resumes.availableDate as availableDate', 'Roles.name as role', 'EnglishLevels.englishLevel as englishLevel', 'Resumes.salary as salary','Sailors.name as name', 'Sailors.surname as surname', 'Sailors.patronymic as patronymic', 'Sailors.birthDate as birthDate', 'Resumes.id as id')
                    ->join('Roles', 'Roles.id', '=', 'Resumes.idRole')
                    ->join('Sailors', 'Sailors.id', '=', 'Resumes.idSailor')
                    ->join('EnglishLevels', 'EnglishLevels.id', '=', 'Resumes.idLevelOfEng')
                    ->whereIn('Resumes.id', $filteredIds)
                    ->groupBy('Resumes.id')
                    ->paginate(10);

        } 

        if($expResearch){

            $resumeIds = [];
            $rolesArr = [];

            foreach ($resumes as $resume) {
               
                array_push($resumeIds, $resume->id);
                array_push($rolesArr, $resume->role);
            }

            $rolesIter = 0;
            $filteredIds = [];
            foreach($resumeIds as $key => $id){

                $countOfExp = DB::table('Experience')
                ->join('Roles', 'Roles.id', '=', 'Experience.idRole')
                ->where('Roles.name',$rolesArr[$rolesIter])
                ->count();

                if($countOfExp >= $experience){
                    array_push($filteredIds,$id);
                }

                $rolesIter++;
            }
            $resumes = DB::table('Resumes')
                    ->select('Sailors.id as idS', 'Resumes.availableDate as availableDate', 'Roles.name as role', 'EnglishLevels.englishLevel as englishLevel', 'Resumes.salary as salary','Sailors.name as name', 'Sailors.surname as surname', 'Sailors.patronymic as patronymic', 'Sailors.birthDate as birthDate', 'Resumes.id as id')
                    ->join('Roles', 'Roles.id', '=', 'Resumes.idRole')
                    ->join('Sailors', 'Sailors.id', '=', 'Resumes.idSailor')
                    ->join('EnglishLevels', 'EnglishLevels.id', '=', 'Resumes.idLevelOfEng')
                    ->whereIn('Resumes.id', $filteredIds)
                    ->groupBy('Resumes.id')
                    ->paginate(10);
        }


    	return view('manager.sailorssearch', compact('resumes', 'roles', 'countries', 'englishLevels', 'visaTypes'));
    }


    public function show_companies(Request $request){

        if(Session::get('user_group') != 'Managers'){
            return redirect('/');
        }

        $salaryFrom = $request->salaryFrom;
        $salaryTo = $request->salaryTo;
        $landingFrom = $request->landingFrom;
        $landingTo = $request->landingTo;
        $englishLevel = $request->englishLevel;
        $role = $request->role;
        $vesselType = $request->vesselType;
        $engineType = $request->engineType;
        $contractTo = $request->contractTo;
        $contractFrom = $request->contractFrom;
        $expFrom = $request->expFrom;
        $expTo = $request->expTo;

        $roleSign = "=";
        $vesTypeSign = "=";
        $engTypeSign = "=";
        $englishSign = "=";

        $research = false;


        if(!isset($request->salaryFrom)){
             $salaryFrom = 0;
        }
        if(!isset($request->salaryTo)){
             $salaryTo = 40000;
        }
        if(!isset($request->contractFrom)){
             $contractFrom = 0;
        }
        if(!isset($request->contractTo)){
             $contractTo = 10000;
        }
        if(!isset($request->expFrom)){
             $expFrom = 0;
        }
        if(!isset($request->expTo)){
             $expTo = 10000;
        }
        if(!isset($request->landingFrom)){
             $landingFrom = date('Y-m-d');
        }
        if(!isset($request->landingTo)){
             $landingTo = "2100-10-10";
        }
        if(!isset($request->englishLevel) || $request->englishLevel == "Any"){
            $englishLevel = 0;
            $englishSign = ">";
        }
        if(!isset($request->role) || $request->role == "Any"){
            $role = 0;
            $roleSign = ">";
        }
        if(!isset($request->vesselType) || $request->vesselType == "Any"){
            $vesselType = 0;
            $vesTypeSign = ">";
        }
        if(!isset($request->engineType) || $request->engineType == "Any"){
            $engineType = 0;
            $engTypeSign = ">";
        }


        $roles = DB::table('Roles')->get();
        $englishLevels = DB::table('EnglishLevels')->get();
        $vesselTypes = DB::table('VesselTypes')->get();
        $engineTypes = DB::table('EngineTypes')->orderBy('engineType', 'ASC')->get();
        $vacancies = DB::table('Vacancies')
                        ->select('Vacancies.id as id', 'Companies.name as name', 'Roles.name as role', 'VesselTypes.vesselType as vesselType', 'Vacancies.salary as salary', 'Vacancies.landingDate as landingDate', 'Vacancies.publicDate as publicDate', 'Companies.id as idC')
                        ->join('Companies', 'Companies.id', '=', 'Vacancies.idCompany')
                        ->join('Roles', 'Roles.id', '=', 'Vacancies.idRole')
                        ->join('VesselTypes', 'VesselTypes.id', '=', 'Vacancies.idVesselType')
                        ->join('EngineTypes', 'EngineTypes.id', '=', 'Vacancies.idEngineType')
                        ->join('EnglishLevels', 'EnglishLevels.id', '=', 'Vacancies.idLevelOfEng')
                        ->whereBetween('Vacancies.salary', [$salaryFrom, $salaryTo])
                        ->whereBetween('Vacancies.landingDate', [$landingFrom, $landingTo])
                        ->whereBetween('Vacancies.contract', [$contractFrom, $contractTo])
                        ->whereBetween('Vacancies.experience', [$expFrom, $expTo])
                        ->where('Vacancies.idLevelOfEng', $englishSign, $englishLevel)
                        ->where('Vacancies.idRole', $roleSign, $role)
                        ->where('Vacancies.idVesselType', $vesTypeSign, $vesselType)
                        ->where('Vacancies.idEngineType', $engTypeSign, $engineType)
                        ->paginate(10);

        return view('manager.companysearch', compact('vacancies', 'roles', 'englishLevels', 'engineTypes', 'vesselTypes'));
    }

    public static function ToArray($data){
        $array = [];
       foreach($data as $item){
           array_push($array,$item->id);
       }
       return $array;
    }

    public function show_requests(){

        if(Session::get('user_group') != 'Managers'){
            return redirect('/');
        }

        $reqs = UserRequest::paginate(10);
        return view('manager.requestsview', compact('reqs'));
    }
}
