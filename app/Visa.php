<?php

namespace app;

use Illuminate\Database\Eloquent\Model;
use DB;

class Visa extends Model
{
	protected $table = "Visas";
    public $timestamps = false;

    public static function hasVisas($resume_id){

    	$visas = static::where('idResume', $resume_id)->get();

    	if(count($visas)==0){
    		return null;
    	}
        $hasVisas = null;
    	foreach($visas as $visa){
    		$visaType = $visa->visaType;
    		$hasVisas = ['visaType' => $visaType->name, 'expiryDate' => $visa->expiryDate];
    	}
    	return $hasVisas;
    }

    public function visaType(){
    	return $this->belongsTo('app\VisaType','idVisaType');
    }
}
