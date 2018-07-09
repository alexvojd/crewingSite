<?php

namespace app\Http\Controllers;

use Illuminate\Http\Request;
use Exception;
use app\Resume;
use app\Visa;
use app\Experience;
use app\Passport;
use app\Certificate;
use app\Sailor;
use app\Company;
use app\Vacancy;
use DB;

class GenerDOCXController extends Controller
{
    
	public function generate_docx($id){

		//Вообще эта херня со стилями толком не работает, кроме размера шрифта, цвета текста и названия шрифта

		$phpWord = new \PhpOffice\PhpWord\PhpWord();

		$phpWord->addTableStyle('tStyle',  array(
		    'borderSize' => 6,
		    'borderColor' => '999999',
		    'cellMarginTop' => 40,
		    'cellMarginRight' => 20,
		    'cellMarginBottom' => 40,
		    'cellMarginLeft' => 20,
		    'cellWidth' => 200,
		), array(
		    'borderSize' => 12,
		    'borderColor' => '000000',
		    'cellMargin' => 100
		));

		$phpWord->addFontStyle('fStyle', array(
		    'name' => 'Times New Roman',
		    'color' => '000000',
		    'size' => 14,
		    'alignment' => 'center',
		));

		$phpWord->addFontStyle('expTStyle', array(
		    'name' => 'Times New Roman',
		    'color' => '000000',
		    'size' => 10,
		    'alignment' => base_path() . \PhpOffice\PhpWord\SimpleType\Jc::CENTER
		));

		$phpWord->addFontStyle('tableStyle', array(
		    'name' => 'Times New Roman',
		    'color' => '000000',
		    'size' => 12,
		));

		$phpWord->addFontStyle('mesStyle', array(
		    'name' => 'Times New Roman',
		    'color' => '000000',
		    'size' => 14,
		));

		$resume = Resume::find($id);

		$nodes[0] = "                                          Резюме моряка";

		$sailor = $resume->sailor;

		$nodes[1] = $sailor->surname . " " . $sailor->name . " " . $sailor->patronymic;

		$nodes[2] = "Дата последнего обновления: " . $resume->updateDate;

		$nodes[3] = "Должность: " . $resume->role->name;

		$nodes[4] = "Минимальная зарплата: " . $resume->salary . "$";

		$nodes[5] = "Дата готовности: " . $resume->availableDate;

		$nodes[6] = "Уровень английского " . $resume->englishLevel->englishLevel;

		$nodes[7] = "Дата рождения " . $sailor->birthDate;

		$nodes[8] = "Страна: " . $sailor->country;

		$nodes[9] = "Регион: " . $sailor->region;

		$nodes[10] = "Город: " . $sailor->city;

		$nodes[11] = "Ближайший аэропорт: " . $sailor->nearestAirport;

		$nodes[12] = "Адрес проживания: " . $sailor->permAdress;

		$nodes[13] = "Национальность: " . $sailor->nationality;

		$nodes[14] = "Контактный телефон: " . $sailor->contactPhone;

		$nodes[15] = "Email: " . $sailor->email;

        $section = $phpWord->addSection();

        $section->addText($nodes[0],'hStyle');
        $section->addTextBreak(1);

        $imageStyle = array(
		    'width' => '120', // в пикселях
		    'height' => '160', // в пикселях
		    'align' => 'center', // left || right || center
		);

		$section->addImage('http://diplom/upload/resumes/'.$resume->id.'/photo.jpeg', $imageStyle);

        $section->addTextBreak(1);

		for($i = 1 ; $i < 16 ; $i++){
			$section->addText($nodes[$i],'fStyle');
		}

		$section->addTextBreak(4);
		$section->addText('Таблица - Визы','fStyle');

		$visas = Visa::where('idResume', $resume->id)->get();

		$table = $section->addTable('tStyle');
		$table->addRow();
			$table->addCell()->addText("Название", 'tableStyle');
			$table->addCell()->addText("Тип", 'tableStyle');
			$table->addCell()->addText("Номер", 'tableStyle');
			$table->addCell()->addText("Годна до", 'tableStyle');

		// Цифры в скобках это кол-во каких то там единиц измерения, которые задают ширину ячейки
		// но работает все равно очень стремно на самом деле

		foreach($visas as $visa){
			$table->addRow();
			$table->addCell(8000)->addText($visa->visaType->name, 'tableStyle');
			$table->addCell(8000)->addText($visa->type, 'tableStyle');
			$table->addCell(8000)->addText($visa->number, 'tableStyle');
			$table->addCell(8000)->addText($visa->expiryDate, 'tableStyle');
		}    

		$passports = Passport::where('idResume', $resume->id)->get();

		$section->addTextBreak(1);
		$section->addText('Таблица - Пасспорта','fStyle');

		$table = $section->addTable('tStyle');
		$table->addRow();
			$table->addCell()->addText("Название", 'tableStyle');
			$table->addCell()->addText("Код", 'tableStyle');
			$table->addCell()->addText("Номер", 'tableStyle');
			$table->addCell()->addText("Место выдачи", 'tableStyle');
			$table->addCell()->addText("Годен до", 'tableStyle');

		foreach($passports as $passport){
			$table->addRow();
			$table->addCell(6000)->addText($passport->nameOfDoc, 'tableStyle');
			$table->addCell(6000)->addText($passport->passCode, 'tableStyle');
			$table->addCell(6000)->addText($passport->passNum, 'tableStyle');
			$table->addCell(6000)->addText($passport->issuePlace, 'tableStyle');
			$table->addCell(6000)->addText($passport->expiryDate, 'tableStyle');
		}

		$certificates = Certificate::where('idResume', $resume->id)->get();

		$section->addTextBreak(1);
		$section->addText('Таблица - Сертификаты','tableStyle');

		$table = $section->addTable('tStyle');
		$table->addRow();
			$table->addCell()->addText("Название", 'tableStyle');
			$table->addCell()->addText("Номер", 'tableStyle');
			$table->addCell()->addText("Место вы дачи", 'tableStyle');
			$table->addCell()->addText("Годен до", 'tableStyle');

		foreach($certificates as $certificate){
			$table->addRow();
			$table->addCell(8000)->addText($certificate->type, 'tableStyle');
			$table->addCell(8000)->addText($certificate->number, 'tableStyle');
			$table->addCell(8000)->addText($certificate->issuePlace, 'tableStyle');
			$table->addCell(8000)->addText($certificate->expiryDate, 'tableStyle');
		}

		$experience = Experience::where('idResume', $resume->id)->get();

		$section->addTextBreak(1);
		$section->addText('Таблица - Опыт работы','fStyle');

		$table = $section->addTable('tStyle');
		$table->addRow();
			$table->addCell()->addText("Должность", 'expTStyle');
			$table->addCell()->addText("Название судна", 'expTStyle');
			$table->addCell()->addText("Тип судна", 'expTStyle');
			$table->addCell()->addText("DWT", 'expTStyle');
			$table->addCell()->addText("Двигатель", 'expTStyle');
			$table->addCell()->addText("BHP", 'expTStyle');
			$table->addCell()->addText("Судовладелец", 'expTStyle');
			$table->addCell()->addText("Флаг", 'expTStyle');
			$table->addCell()->addText("Крюинг", 'expTStyle');
			$table->addCell()->addText("Дата начала", 'expTStyle');
			$table->addCell()->addText("Дата конца", 'expTStyle');

		foreach($experience as $exp){
			$table->addRow();
			$table->addCell(3000)->addText($exp->role->name, 'expTStyle');
			$table->addCell(3000)->addText($exp->nameOfVes, 'expTStyle');
			$table->addCell(4000)->addText($exp->vesselType->vesselType, 'expTStyle');
			$table->addCell(1500)->addText($exp->DWT, 'expTStyle');
			$table->addCell(2000)->addText($exp->engineType->engineType, 'expTStyle');
			$table->addCell(1500)->addText($exp->BHP, 'expTStyle');
			$table->addCell(2000)->addText($exp->shipowner, 'expTStyle');
			$table->addCell(2000)->addText($exp->flag, 'expTStyle');
			$table->addCell(3000)->addText($exp->crewing, 'expTStyle');
			$table->addCell(2000)->addText($exp->dateFrom, 'expTStyle');
			$table->addCell(2000)->addText($exp->dateTo, 'expTStyle');
		}

		$section->addTextBreak(1);
		$section->addText('Дополнительная информация', 'mesStyle');
		$section->addText($resume->message, 'fStyle');

        $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
        try {
            $objWriter->save(storage_path($sailor->id . '_resume' . '.docx'));
        } catch (Exception $e) {
        }

        return response()->download(storage_path($sailor->id . '_resume' . '.docx'));
	}

	public function getOffer(Request $request){

		$company_id = $request->company_id;
		$sailor_id = $request->sailor_id;

		$sailor = Sailor::find($sailor_id);

		$resume = $sailor->resume;

		$fileName = 'Dogovor_'.$sailor->id.'_to_'.$company_id.'.docx';

		$company = Company::find($company_id);

		$vacancy = Vacancy::where('idCompany',$company_id)->where('idRole',$resume->idRole)->first();

		//$phpWord = new \PhpOffice\PhpWord\PhpWord();

		$document = new \PhpOffice\PhpWord\TemplateProcessor('templateRus2.docx');

		$nodes['day'] = date("d",time()+(60*60*2));
		$nodes['month'] = date("m");
		$nodes['year'] = date("Y");

		$nodes['landingDate'] = $vacancy->landingDate;
		$nodes['sailor_datebirth'] = $sailor->birthDate;
		$nodes['sailor_fio'] = $sailor->surname . " " . $sailor->name . " " . $sailor->patronymic;
		$nodes['company_name'] = $company->name;
		$nodes['company_fio'] = $company->fio;

		$nodes['role'] = $resume->role->name;

		$nodes['year_contract'] = ($vacancy->contract > 12)? 1 : 0;
		$nodes['mounth_contract'] = ($vacancy->contract > 12)? $vacancy->contract - 12 : $vacancy->contract;

		$nodes['end_date'] = date("Y-m-d", time()+(60*60*24*30*$vacancy->contract));

		$date = strtotime("+".$vacancy->contract." month", strtotime($vacancy->landingDate));

		$nodes['end_date'] = date('Y-m-d', $date);

		$nodes['sailor_address'] = $sailor->city . " " . $sailor->permAdress;
		$civil_passport = DB::table('Passports')->where('nameOfDoc','Civil Passport')->where('idResume',$resume->id)->first();

		 $nodes['civil_passport'] = $civil_passport->passCode . " " . $civil_passport->passNum;

		foreach($nodes as $key => $value){

			$document->setValue($key, $value);
		}

		$document->saveAs($fileName);

		$phpWord = \PhpOffice\PhpWord\IOFactory::load($fileName);

		$xmlWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord , 'Word2007');
        try {
            $xmlWriter->save(storage_path($fileName));
        } catch (Exception $e) {
        	echo "$e";
        }

        return response()->download(public_path($fileName));

        // С сохранением что-то не очень ясное в Ларе, или может быть я где-то что-то не то сделал
        // Но оно, чтобы сохранить в storage_path сначала сохраняет его в public_path
        // Потом оттуда копирует, не удаляя, в storage, при этом файл из storage поврежден и не читается, а в паблике норм
        // В общем я заморачиваться и разбираться не стал, но если очень нужно будет попросите

	}

}
