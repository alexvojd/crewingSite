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
use app\Experience;
use app\UserRequest;
use app\Visa;
use app\Passport;
use app\Certificate;

class ProfileController extends Controller
{
    
	public function show_profile(){

		$user_group = Session::get('user_group');
		$user_id = Session::get('user_id');

		switch($user_group){
			case "Sailors" :
				$user = Sailor::find($user_id);

				$user_country = DB::table('country')->where('name',$user->country)->first();
				$countries = DB::table('country')->get();

				$user_region = DB::table('region')->where('name',$user->region)->first();
				$regions = DB::table('region')->where('country_id',$user_country->id)->get();

				$cities = DB::table('city')->where('region_id',$user_region->id)->get();

				
				return view('profile.sailor', compact('user', 'countries', 'cities', 'regions'));
			case "Companies":
				$company = Company::find($user_id);
				return view('profile.company', compact('company'));
			case "Managers":
				$manager = Manager::find($user_id);
				return view('profile.manager', compact('manager'));
			default: return redirect('/');
		} 

		return redirect('/');

	}

	public function show_sailor_addresume($id=0){

		if (Session::get('user_group') == 'Гость') {
			return redirect('/register/sailor');
		}
		$user_group = Session::get('user_group');
		if($user_group=='Sailors' || $user_group=="Managers"){
			$idSailor = Session::get('user_id');
			if($id!=0){
				$idSailor = $id;
			}
			$resume = Resume::where('idSailor',$idSailor)->first();
			if(isset($resume)){
				return redirect('/profile/manageresume');
			}
			$roles = DB::table('Roles')->get();
			$levelsOfEng = DB::table('EnglishLevels')->get();
			return view('profile.addresume', compact('roles','levelsOfEng','idSailor'));
		}
		return redirect('/');

	}

	public function show_company_addvacacy($id=0){

		if (Session::get('user_group') == 'Гость') {
			return redirect('/register/company');
		}
		$user_group = Session::get('user_group');
		if($user_group=='Companies' || $user_group=="Managers"){
			$idCompany = 0;
			if(isset($id)){
				$idCompany = $id;
			}
			$roles = DB::table('Roles')->get();
			$levelsOfEng = DB::table('EnglishLevels')->get();
			$vesselTypes = DB::table('VesselTypes')->get();
			$engineTypes = DB::table('EngineTypes')->orderBy('engineType', 'ASC')->get();
			return view('profile.addvacancy', compact('roles','levelsOfEng', 'engineTypes', 'vesselTypes', 'idCompany'));
		}
		return redirect('/');
	}

	public function upd_personal(Request $request){

	    $sailor = Sailor::find(Session::get('user_id'));

	    $sailor->country = $request->country;
		$sailor->city = $request->city;
	    $sailor->region = $request->region;
	    $sailor->permAdress = $request->permAdress;
	    $sailor->nearestAirport = $request->nearestAirport;
	    $sailor->contactPhone = $request->contactPhone;
	    $sailor->save();

	    return redirect('/profile');
	}

	public function upd_company(Request $request){

		$id_company = Session::get('user_id');
		$company = Company::find($id_company);
		$company->site = $request->site;
		$company->contactPhone = $request->contactPhone;
		$company->save();
		return redirect('/profile');
	}
	//AJAX
	public function get_regions(Request $request){

		$country = DB::table('country')->where('name',$request->countryName)->first();
		$regions = DB::table('region')->where('country_id',$country->id)->get();
		return response()->json($regions);

	}
	//AJAX
	public function get_cities(Request $request){

		$region = DB::table('region')->where('name',$request->regionName)->first();
		$cities = DB::table('city')->where('region_id',$region->id)->get();
		return response()->json($cities);
	}

	public function crt_vacancy(Request $request){

		if(Session::get('user_group')=="Managers"){
			$idCompany = $request->idCompany;
			$hidden = $request->hidden;
		}else{
			$idCompany = Session::get('user_id');
			$hidden = 0;
		}

		$vacancy = new Vacancy;

		$vacancy->idRole = $request->role;
		$vacancy->idlevelOfEng = $request->levelOfEng;
		$vacancy->salary = $request->salary;
		$vacancy->landingDate = $request->landingDate;
		$vacancy->contract = $request->contract;
		$vacancy->experience = $request->experience;
		$vacancy->yearOfConstruct = $request->yearOfConstruct;
		$vacancy->idEngineType = $request->engineType;
		$vacancy->idVesselType = $request->vesselType;
		$vacancy->message = $request->additionalInfo;
		$vacancy->views = 0;
		$vacancy->publicDate = date('Y-m-d');
		$vacancy->idCompany = $idCompany;
		$vacancy->bhp = $request->bhp;
		$vacancy->dwt = $request->dwt;
		$vacancy->hidden = $hidden;

		$vacancy->save();

		return redirect('/profile');
	}

	public  function crt_resume(Request $request){

		if(Session::get('user_group')=="Managers"){
			$idSailor = $request->idSailor;
			$hidden = $request->hidden;
		}else{
			$idSailor = Session::get('user_id');
			$hidden = 0;
		}

		$resume = new Resume;

		$resume->availableDate = $request->availableDate;
		$resume->salary = $request->salary;
		$resume->idRole = $request->role;
		$resume->idLevelOfEng = $request->levelOfEng;
		$resume->idSailor = $idSailor;
		$resume->message = $request->Additionalinfo;
		$resume->hidden = $hidden;
		$resume->updateDate = date("Y-m-d");
		$resume->views = 0;

		$resume->save();

		$resumeID = DB::table('Resumes')->where('idSailor', $idSailor)->First()->id;

		if($request->hasFile('photo')){
			$file = $request->file('photo');
			$fileName = 'photo.jpeg';
			$file->move('upload/resumes/'.$resumeID, $fileName);
		}

		if($request->number_USA){

			$visa = new Visa;

			$visa->number = $request->number_USA;
			$visa->type = $request->type_USA;
			$visa->expiryDate = $request->expiryDate_USA;
			$visa->idResume = $resumeID;
			$visa->idVisaType = 1;

			if($request->hasFile('scanName_USA')){
				$file = $request->file('scanName_USA');
				$fileName = 'USA.jpeg';
				$file->move('upload/resumes/'.$resumeID, $fileName);
				$visa->scanName = $fileName;
			}
			$visa->save();
		}

		if($request->number_Schengen){
			
			$visa = new Visa;

			$visa->number = $request->number_Schengen;
			$visa->type = $request->type_Schengen;
			$visa->expiryDate = $request->expiryDate_Schengen;
			$visa->idResume = $resumeID;
			$visa->idVisaType = 2;

			if($request->hasFile('scanName_Schengen')){
				$file = $request->file('scanName_Schengen');
				$fileName = 'Schengen.jpeg';
				$file->move('upload/resumes/'.$resumeID, $fileName);
				$visa->scanName = $fileName;
			}
			$visa->save();
		}

		$passport = new Passport;

		$passport->nameOfDoc = "Civil passport";
		$passport->passCode = $request->passCode_Civil;
		$passport->passNum = $request->passNum_Civil;
		$passport->issuePlace = $request->issuePlace_Civil;
		$passport->expiryDate = null;
		$passport->idResume = $resumeID;

		if($request->hasFile('scanName_Civil')){
				$file = $request->file('scanName_Civil');
				$fileName = 'Civil.jpeg';
				$file->move('upload/resumes/'.$resumeID, $fileName);
				$passport->scanName = $fileName;
		}
		$passport->save();

		$passport = new Passport;

		$passport->nameOfDoc = "Seaman passport";
		$passport->passCode = $request->passCode_Sea;
		$passport->passNum = $request->passNum_Sea;
		$passport->issuePlace = $request->issuePlace_Sea;
		$passport->expiryDate = $request->expiryDate_Sea;
		$passport->idResume = $resumeID;

		if($request->hasFile('scanName_Sea')){
				$file = $request->file('scanName_Sea');
				$fileName = 'Sea.jpeg';
				$file->move('upload/resumes/'.$resumeID, $fileName);
				$passport->scanName = $fileName;
		}
		$passport->save();

		$passport = new Passport;

		$passport->nameOfDoc = "Tourist passport";
		$passport->passCode = $request->passCode_Tourist;
		$passport->passNum = $request->passNum_Tourist;
		$passport->issuePlace = $request->issuePlace_Tourist;
		$passport->expiryDate = $request->expiryDate_Tourist;
		$passport->idResume = $resumeID;

		if($request->hasFile('scanName_Tourist')){
				$file = $request->file('scanName_Tourist');
				$fileName = 'Tourist.jpeg';
				$file->move('upload/resumes/'.$resumeID, $fileName);
				$passport->scanName = $fileName;
		}
		$passport->save();

		$idsArray = $request->certif_ids;

		foreach($idsArray as $key => $value){

			$certif = new Certificate;

			$certif->type = $request->{'cType_'.$value};
			$certif->number = $request->{'cNumber_'.$value};
			$certif->issuePlace = $request->{'cIssuePlace_'.$value};
			$certif->expiryDate = $request->{'cExpiryDate_'.$value};
			$certif->idResume = $resumeID;

			if($request->hasFile('cScanName_'.$value)){
				$file = $request->file('cScanName_'.$value);
				$fileName = 'crtf_'.$value.'.jpeg';
				$file->move('upload/resumes/'.$resumeID, $fileName);
				$certif->scanName  = $fileName;
			}
			$certif->save();
		}

		return redirect('/');

	}

	public function view_add_exp(){

		$user_group = Session::get('user_group');
		if($user_group=='Sailors' || $user_group=="Managers"){
	
			$roles = DB::table('Roles')->get();
			$vesselTypes = DB::table('VesselTypes')->get();
			$engineTypes = DB::table('EngineTypes')->orderBy('engineType', 'ASC')->get();

			return view('profile.addexperience', compact('roles', 'engineTypes', 'vesselTypes'));
		}
		return redirect('/');
	}

	public function crt_experience(Request $request){

		if(Session::get('user_group')=="Managers"){
			$idSailor = $request->idSailor;
		}else{
			$idSailor = Session::get('user_id');
		}

		$resume = Resume::where('idSailor',$idSailor)->first();
		
		$experience = new Experience;

		$experience->nameOfVes = $request->nameOfVes;
		$experience->DWT = $request->DWT;
		$experience->BHP = $request->BHP;
		$experience->flag = $request->flag;
		$experience->shipowner = $request->shipowner;
		$experience->crewing = $request->crewing;
		$experience->dateFrom = $request->dateFrom;
		$experience->dateTo = $request->dateTo;
		$experience->idEngineType = $request->engineType;
		$experience->idVesselType = $request->vesselType;
		$experience->idResume = $resume->id;
		$experience->idRole = $request->role;

		$experience->save();

		return redirect('/profile');
	}

	public function crt_request(Request $request){

		$user_group = Session::get('user_group');

		if($user_group == 'Sailors' || $user_group == 'Companies'){

			$user_req = new UserRequest();

			$user_req->userGroup = $user_group;
			$user_req->idUser = Session::get('user_id');
			$user_req->message = $request->message;

			$user_req->save();

			return redirect('/profile');
		}
			
	}

	public function show_formrequest(){

		$user_group = Session::get('user_group');
		$user_id = Session::get('user_id');
		if($user_group == 'Sailors' || $user_group == 'Companies'){
			$isAlreadySend = false;

			$countOfreq = 0;

			$countOfReq = DB::table("UserRequests")->where([['idUser', $user_id], ['userGroup', $user_group]])->count();

			if ($countOfreq>0){
				$isAlreadySend = true;
			}

			return view('profile.userrequest', compact('isAlreadySend'));
		}

		return redirect('/profile');
	}

	public function del_vacancy(Request $request){

		$user_group = Session::get('user_group');
		if($user_group != 'Companies'){
			redirect('/vacancy');
		}
		if( isset($request->ids)){
			Vacancy::whereIn('id',$request->ids)->delete();
		}
		$company = Company::find(Session::get('user_id'));
		$vacancies = Vacancy::where('idCompany', Session::get('user_id'))->paginate(10);

			return view('profile.managevacancy', compact('vacancies'));
	}

	public function edit_resume(Request $request){

		$user_group = Session::get('user_group');
		if($user_group != 'Sailors'){
			redirect('/resume');
		}
		$self_user = true;
		$resume = Resume::where('idSailor', Session::get('user_id'))->first();
		if(!isset($resume)) return redirect('/');
		$passports = $resume->passports;
    	$certificates = $resume->certificates;
    	$roles = DB::table('Roles')->get();
    	$englishLevels = DB::table('EnglishLevels')->get();
    	$visas = $resume->visas;
        $experience = $resume->experience;

        if(isset($request->edit)){

        	$resume = Resume::where('idSailor',Session::get('user_id'))->first();
        	$resume->idRole = $request->role;
        	$resume->idLevelOfEng = $request->englishLevel;
        	$resume->updateDate = date('Y-m-d');
        	$resume->salary = $request->salary;
        	$resume->message = $request->additionalinfo;
        	$resume->availableDate = $request->availableDate;

        	$resume->save();

        	$visaUSA = Visa::where('idResume', $resume->id)->where('idVisaType',1)->first();
        	$visaSchengen = Visa::where('idResume', $resume->id)->where('idVisaType',2)->first();
        	$visaUSA->expiryDate = $request->visaUSA;
        	$visaSchengen->expiryDate = $request->visaSchengen;

        	$passportC = Passport::where('idResume', $resume->id)->where('nameOfDoc', 'Civil Passport')->first();
        	$passportS = Passport::where('idResume', $resume->id)->where('nameOfDoc', 'Seaman Passport')->first();
        	$passportT = Passport::where('idResume', $resume->id)->where('nameOfDoc', 'Tourist Passport')->first();

        	$passportC->passNum = $request->{'passNum_'.$passportC->id};
        	$passportC->passCode = $request->{'passCode_'.$passportC->id};

        	$passportS->passNum = $request->{'passNum_'.$passportS->id};
        	$passportS->passCode = $request->{'passCode_'.$passportS->id};
        	$passportS->expiryDate = $request->{'expiryDate_'.$passportS->id};

        	$passportT->passNum = $request->{'passNum_'.$passportT->id};
        	$passportT->passCode = $request->{'passCode_'.$passportT->id};
        	$passportT->expiryDate = $request->{'expiryDate_'.$passportT->id};

        	$passportC->save();
        	$passportS->save();
        	$passportT->save();
        	if(isset($request->certifs))
        		Certificate::whereIn('id',$request->certifs)->delete();
        	if(isset($request->exps))
        		Experience::whereIn('id',$request->exps)->delete();
        }
    	return view('profile.manageresume', compact('resume', 'visas', 'passports', 'certificates', 'roles', 'englishLevels', 'experience', 'self_user'));
	}

}
