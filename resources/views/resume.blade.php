@extends ('layouts.structure')

@section('content')


	<div class="form-pad">
		
		<br>
		<br>
		<h3>Персональные данные </h3>
		<br>
		<div class="center">
			<button type="button" id="resume-photo" class="btn" data-toggle="modal" data-target=".res-photo-modal" style="background-color: transparent!important;">
				<img src="/upload/resumes/{{$resume->id}}/photo.jpeg" alt="PHOTO" class="img-thumbnail" style="height: 150px">
			</button>
		</div>
		<div class="modal fade res-photo-modal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" style="padding-top: 200px">
			  <div class="modal-dialog modal-sm">
			    <div class="modal-content">
			      <img src="/upload/resumes/{{$resume->id}}/photo.jpeg" alt="PHOTO" class="img-thumbnail" style="height: 350px">
			    </div>
			  </div>
			</div>
		<br>
		@if(Session::get('user_group') == "Managers")
		<div class="center">
			<a href="/resume-docx/{{$resume->id}}" class="col-sm-3 form-control btn" id="loadFile">Загрузить DOCX</a>
			<button type="button" id="resume-photo" class="btn" data-toggle="modal" data-target=".company-id" ">Договор</button>
		</div>
		
		<div class="modal fade company-id" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" style="padding-top: 200px">
			  <div class="modal-dialog modal-sm">
			    <div class="modal-content ">
					{!!Form::open(['route' => '/resume-docx/offer','class' => 'form-control'])!!}
			      		ID компании: <input type="text" class="form-control" name="company_id">
			      		<br>
			      		<input type="hidden" name="sailor_id" value="{{$sailor->id}}">
			      		<input type="submit" class="form-control" value="Отправить" name="company-id-submit">
			      		<br>
			      	</form>
			    </div>
			  </div>
			</div>

		<br>
		@endif
		<div class="form-group flex-align-center row" >
				<label class="col-md-4 col-form-label">Просмотров</label>
				<div class="col-md-2">
					<input class="center form-control" value="{{$resume->views}}" disabled type="text" >
				</div>
				<label class="col-md-2 col-form-label" >Обновлена</label>
				<div class="col-md-3">
					<input disabled value="{{$resume->updateDate}}" class="form-control" type="text" >
				</div>
			</div>

		@if(Session::get('user_group') == "Managers")
			<div class="form-group row">
			<label for="fio" class="col-sm-4 col-form-label">Id Моряка</label>
				<div class="col-sm-7">
					<input class="form-control" type="text" name="fio" id="fio" value="<? echo $sailor->id; ?>" disabled>
				</div>
			</div>
		@endif
		<div class="form-group row">
		<label for="fio" class="col-sm-4 col-form-label">ФИО</label>
		<div class="col-sm-7">
		<input class="form-control" type="text" name="fio" id="fio" value="<?echo $sailor->surname ." " . $sailor->name . " " . $sailor->patronymic; ?>" disabled>
		</div>
		</div>

		<div class="form-group row">
		<label class="col-sm-4 col-form-label">Email</label>
		<div class="col-sm-7">
		<input class="form-control" type="text" name="email" id="email" value="{!! ($isAuthorized == true)? $sailor->email : 'register to see' !!}" disabled>
		</div>
		</div>

		<div class="form-group row">
		<label class="col-sm-4 col-form-label">День рождения</label>
		<div class="col-sm-7">
		<input class="form-control" type="text" name="birthDate" id="birthDate" value="{{$sailor->birthDate}}" disabled>
		</div>
		</div>

		<div class="form-group row">
		<label class="col-sm-4 col-form-label">Страна</label>
		<div class="col-sm-7">
		<input class="form-control" type="text" name="surname" id="surname" value="{{$sailor->country}}" disabled>
		</div>
		</div>

		<div class="form-group row">
		<label class="col-sm-4 col-form-label">Регион</label>
		<div class="col-sm-7">
		<input class="form-control" type="text" name="surname" id="surname" value="{{$sailor->region}}" disabled>
		</div>
		</div>
	
		<div class="form-group row">
			<label class="col-sm-4 col-form-label">Город</label>
			<div class="col-sm-7">
			<input class="form-control" type="text" name="surname" id="surname" value="{{$sailor->city}}" disabled>
			</div>
		</div>

		<div class="form-group row">
			<label for="permAdress" class="col-sm-4 col-form-label">Постоянный адрес</label>
			<div class="col-sm-7">
				<input class="form-control" type="text" name="permAdress" id="permAdress" value="{{$sailor->permAdress}}" disabled>
			</div>
		</div>	
		
		<div class="form-group row">
			<label for="nationality" class="col-sm-4 col-form-label">Национальность</label>
			<div class="col-sm-7">
				<input class="form-control" type="text" name="nationality" id="nationality" value="{{$sailor->nationality}}" disabled>
			</div>
		</div>
		
		<div class="form-group row">
			<label class="col-sm-4 col-form-label">Ближайший аэропорт</label>
			<div class="col-sm-7">
			<input class="form-control" type="text" name="surname" id="surname" value="{{$sailor->nearestAirport}}" disabled>
			</div>
		</div>

		
		<div class="form-group row">
			<label for="contactPhone" class="col-sm-4 col-form-label">Контактный телефон</label>
		<div class="col-sm-7">
			<input class="form-control" type="text" name="contactPhone" id="contactPhone" value="{!! ($isAuthorized == true)? $sailor->contactPhone : 'register to see' !!}" disabled>
		</div>
		</div>

		<br>
		

		
		<h3>Резюме</h3>
		<br>
		<div class="form-group row">
			<label for="role" class="col-sm-4 col-form-label">Должность</label>
			<div class="col-sm-7">
				<input class="form-control" type="text" name="role" id="role" value="{{$role->name}}" disabled>
			</div>
		</div>
		
		<div class="form-group row">
			<label for="englishLevel" class="col-sm-4 col-form-label">Уровень английского</label>
			<div class="col-sm-7">
					<input class="form-control" type="text" name="englishLevel" id="englishLevel" value="{{$englishLevel->englishLevel}}" disabled>
			</div>
		</div>
		
		<div class="form-group row">
		<label for="availableDate" class="col-sm-4 col-form-label">Дата готовности</label>
		<div class="col-sm-7">
		<input class="form-control" value="{{$resume->availableDate}}" type="text" name="availableDate" id="availableDate" disabled><br>
		</div>
		</div>

		<div class="form-group row">
		<label for="salary" class="col-sm-4 col-form-label">Минимальная зарплата</label>
		<div class="col-sm-7">
		<input class="form-control" value="{{$resume->salary}}"  type="text" name="salary" id="salary" disabled><br>
		</div>
		</div>
		<hr>
		<h4>Визы</h4>
		<hr>
		<div class="form-group row">
			<label for="visa" class="col-sm-3 col-form-label">Тип</label>
			<label for="visa" class="col-sm-3 col-form-label">Годна до</label>
		</div>
		<hr>
		<br>
		<?php
		if (count($visas)==0){
			$usa = 'none';
			$schengen = 'none';
		}elseif (count($visas)==1){
			foreach($visas as $visa){
				if($visa->idVisaType == 1){
					$usa = $visa->expiryDate;
					$schengen = 'none';
				}else{
					$usa = 'none';
					$schengen = $visa->expiryDate;
				}
			}
		}else{
			$visaname = "usa";
			foreach($visas as $visa){
				${''.$visaname} = $visa->expiryDate;
				$visaname = "schengen";
			}
		}
		?>
	
		<div class="form-group row">
			<label for="visa" class="col-sm-3 col-form-label">USA</label>
			<div class="col-sm-7">
				<input class="form-control" value="{{$usa}}" type="text" name="visa" id="visa" disabled><br>
			</div>
			@if(Session::get('user_group') == "Managers"  || $self_user)
				<div class="col-sm-2">
					<button type="button" class="btn" data-toggle="modal" data-target=".us-visa-modal" >+</button>
				</div>
			@endif
		</div>
		
		<div class="modal fade us-visa-modal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" style="padding-top: 200px">
			  <div class="modal-dialog modal-sm">
			    <div class="modal-content">
			      <img src="/upload/resumes/{{$resume->id}}/USA.jpeg" alt="PHOTO" class="img-thumbnail" style="height: 350px">
			    </div>
			  </div>
			</div>

		<div class="form-group row">
			<label for="visa" class="col-sm-3 col-form-label">Schengen</label>
			<div class="col-sm-7">
				<input class="form-control" value="{{$schengen}}" type="text" name="visa" id="visa" disabled><br>
			</div>
			@if(Session::get('user_group') == "Managers"  || $self_user)
				<div class="col-sm-2">
					<button type="button" class="btn" data-toggle="modal" data-target=".schengen-visa-modal" >+</button>
				</div>
			@endif			
		</div>
		
		<div class="modal fade schengen-visa-modal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" style="padding-top: 200px">
			  <div class="modal-dialog modal-sm">
			    <div class="modal-content">
			      <img src="/upload/resumes/{{$resume->id}}/Schengen.jpeg" alt="PHOTO" class="img-thumbnail" style="height: 350px">
			    </div>
			  </div>
		</div>

		<br>

		<hr>
		<h4>Паспорта</h4>

		<br>
		
		<table class="form-control">
			<tr>
				<td><label >Название документа</label></td>
				<td><label >Код паспорта</label></td>
				<td><label >№ паспорта</label></td>
				<td><label >Годен до</label></td>
			</tr>
			@foreach($passports as $passport)
				<tr>
					<td><input class="form-control" type="text" name="nameOfDoc" id="nameOfDoc" disabled value="{{$passport->nameOfDoc}}"></td>
					<td><input class="form-control" type="text" name="passCode" id="passCode" disabled value="{{$passport->passCode}}"></td>
					<td><input class="form-control" type="text" name="passNum" id="passNum" disabled value="{{$passport->passNum}}"></td>
					<td><input class="form-control" type="text" name="expiryDate" id="expiryDate" value="{{$passport->expiryDate}}" disabled=""></td>
					@if(Session::get('user_group') == "Managers"  || $self_user)
						<td><button type="button" class="btn" data-toggle="modal" data-target=".{{$passport->passNum}}" >+</button>
						</td>
					@endif
				</tr>

				<div class="modal fade {{$passport->passNum}}" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" style="padding-top: 200px">
					  <div class="modal-dialog modal-sm">
					    <div class="modal-content">
					      <img src="/upload/resumes/{{$resume->id}}/{{$passport->scanName}}" alt="PHOTO" class="img-thumbnail" style="height: 350px">
					    </div>
					  </div>
				</div>				
			@endforeach
		</table>
		<br>

		<hr>
		<h4>Сертификаты</h4>
		<br>
		
		<table class="form-control" id="certif" cellpadding="5px">
		<tr>
			<td><label for="cType_1" >Тип сертификата</label></td>
			<td><label for="cNumber_1">№ сертификата</label></td>
			<td><label for="cIssuePlace_1">Место выдачи</label></td>
			<td><label for="cExpiryDate_1">Годен до</label></td>
		</tr>
		@foreach($certificates as $certificate)
			<tr>
				<td>
					<input type="text" name="cType_0" id="cType_0" class="form-control" value="{{$certificate->type}}" disabled>
				</td>
				<td><input type="text" name="cNumber_0" id="cNumber_0" class="form-control" value="{{$certificate->number}}" disabled></td>
				<td><input type="text" name="cIssuePlace_0" id="cIssuePlace_0" class="form-control" value="{{$certificate->issuePlace}}" disabled></td>
				<td><input type="text" name="cExpiryDate_0" id="cExpiryDate_0" class="form-control" value="{{$certificate->expiryDate}}" disabled></td>
				@if(Session::get('user_group') == "Managers"  || $self_user)
					<td><button type="button" class="btn" data-toggle="modal" data-target=".{{$certificate->number}}" >+</button>
					</td>
				@endif
			</tr>

				<div class="modal fade {{$certificate->number}}" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" style="padding-top: 200px">
					  <div class="modal-dialog modal-sm">
					    <div class="modal-content">
					      <img src="/upload/resumes/{{$resume->id}}/{{$certificate->scanName}}" alt="PHOTO" class="img-thumbnail" style="height: 350px">
					    </div>
					  </div>
				</div>

		@endforeach
		
		</table>

		<br>
		<hr>
		
		<br>
		<h4>Опыт работы</h4>


		@foreach($experience as $exp)
		<hr>
			<div class="form-group flex-align-center row" >
				<label class="col-sm-2 col-form-label">Название судна</label>
				<div class="col-sm-4">
					<input class="form-control" value="{{$exp->nameOfVes}}" disabled type="text" >
				</div>
				<label class="col-sm-2 col-form-label" > Должность</label>
				<div class="col-sm-4">
					<input disabled value="{{$exp->role->name}}" class="form-control" type="text" >
				</div>
			</div>

			<div class="form-group flex-align-center row" >
				<label class="col-sm-2 col-form-label">Тип судна</label>
				<div class="col-sm-4">
					<input class="form-control" value="{{$exp->vesselType->vesselType}}" disabled type="text" >
				</div>
				<label class="col-sm-2 col-form-label" > DWT</label>
				<div class="col-sm-4">
					<input disabled value="{{$exp->DWT}}" class="form-control" type="text" >
				</div>
			</div>

			<div class="form-group flex-align-center row" >
				<label class="col-sm-2 col-form-label">Тип двигателя</label>
				<div class="col-sm-4">
					<input class="form-control" value="{{$exp->engineType->engineType}}" disabled type="text" >
				</div>
				<label class="col-sm-2 col-form-label" > BHP</label>
				<div class="col-sm-4">
					<input disabled value="{{$exp->BHP}}" class="form-control" type="text" >
				</div>
			</div>

			<div class="form-group flex-align-center row" >
				<label class="col-sm-2 col-form-label">Флаг</label>
				<div class="col-sm-4">
					<input class="form-control" value="{{$exp->flag}}" disabled type="text" >
				</div>
				<label class="col-sm-2 col-form-label" > Судовладелец</label>
				<div class="col-sm-4">
					<input disabled value="{{$exp->shipowner}}" class="form-control" type="text" >
				</div>
			</div>

			<div class="form-group flex-align-center row" >
				<label class="col-sm-2 col-form-label">Крюинг</label>
				<div class="col-sm-4">
					<input class="form-control" value="{{$exp->crewing}}" disabled type="text" >
				</div>
				<label class="col-sm-2 col-form-label" > Дата от - до</label>
				<div class="col-sm-4">
					<input disabled value="{!!$exp->dateFrom.' - '.$exp->dateTo!!}" class="form-control" type="text" >
				</div>
			</div>
	<hr>

			
		@endforeach
		

		
		<br>
		<br>

		<hr>
		<h4>Дополнительная информация</h4>
		<br>
		
		<div class="form-group flex-center row">
		<textarea name="Additionalinfo" id="Additionalinfo" cols="90" rows="10" style="resize: none;" disabled>{{$resume->message}}</textarea>
		</div>

		<hr><br>
		</div>

@endsection