<?php

namespace app\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use app\Sailor;
use app\Company;
use Session;

class RegisterController extends Controller
{
    public function regSailor(){

    	$countries = DB::table('country')->get();
        $regions = DB::table('region')->where('country_id',0)->get();
        $cities = DB::table('city')->where('region_id',0)->get();
    	return view('regsailor', compact('countries','cities','regions'));

    }

    public function regCompany(){


    	return view('regcompany');

    }

    public function addSailor(Request $request){

    	$sailor = new Sailor;

    	/*$sailor->surname = $request->surname;
    	$sailor->name = $request->name;
    	$sailor->patronymic = $request->patronymic;
    	$sailor->birthDate = $request->birthDate;
    	$sailor->country = $request->country;
    	$sailor->region = $request->region;
    	$sailor->city = $request->city;
    	$sailor->region = $request->region;
    	$sailor->nationality = $request->nationality;
    	$sailor->permAdress = $request->permAdress;
    	$sailor->nearestAirport = $request->nearestAirport;
     	$sailor->contactPhone = $request->contactPhone;
    	$sailor->email = $request->email;
    	$sailor->password = $request->password;
    	$sailor->expirySubscDate = "0000-00-00";
    	$sailor->idSubscript = 1;
        $sailor->save();*/

        $validatedData = $request->validate([
        'surname' => 'required|alpha_dash',
        'name' => 'required|alpha',
        'patronymic' => 'required|alpha',
        'email' => 'required|email|unique:Sailors',
        'password' => 'required|min:4|max:16',
        'birthDate' => 'required|date',
        'country' => 'required',
        'region' => 'required',
        'city' => 'required',
        'permAdress' => 'required',
        'nationality' => 'required|alpha',
        'nearestAirport' => 'required',
        'contactPhone' => 'required|unique:Sailors|min:10|max:14',

        ]);


    	$sailor->insert($request);

        if(Session::get('user_group') == "Managers"){
            $sailor = Sailor::where('email',$request->email)->first();
            $idSailor = $sailor->id;
            return redirect('/profile/addresume/'.$idSailor);
        }

    	return redirect('/authorization');
    }
	public function addCompany(Request $request){

	    $company = new Company;

        $validatedData = $request->validate([
        'name' => 'required|alpha_dash',
        'email' => 'required|email',
        'password' => 'required|min:4|max:16',
        'site' => 'required',
        'contactPhone' => 'required|min:10|max:14',

        ]);

	    $company->insert($request);

	    if(Session::get('user_group') == "Managers"){
            $company = Company::where('email',$request->email)->first();
            $idCompany = $company->id;
            return redirect('/profile/addvacancy/'.$idCompany);
        }

        return redirect('/authorization');
	}
	
}