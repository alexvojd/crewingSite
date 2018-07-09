@extends ('layouts.structure')

@section('content')


	<?echo Form::open(['route' => '/profile/manageresume','class' => 'form-pad']); ?>
		
		
		<h3>Резюме</h3>
		<br>
		<div class="form-group row">
			<label for="role" class="col-sm-3 col-form-label">Должность</label>
			<div class="col-sm-8">
			<select class="form-control" name="role">
				@foreach ($roles as $role)
					<option value="{{$role->id}}" <? if($role->id == $resume->idRole) echo"selected" ?>>{{$role->name}}</option>
				@endforeach
			</select>
			</div>
		</div>
		
		<div class="form-group row">
			<label for="englishLevel" class="col-sm-3 col-form-label">Уровень английского</label>
			<div class="col-sm-8">
			<select class="form-control" name="englishLevel">
				@foreach ($englishLevels as $englishLevel)
					<option value="{{$englishLevel->id}}" <? if($englishLevel->id == $resume->idLevelOfEng) echo"selected" ?>>{{$englishLevel->englishLevel}}</option>
				@endforeach
			</select>
			</div>
		</div>
		
		<div class="form-group row">
		<label for="availableDate" class="col-sm-3 col-form-label">Дата готовности</label>
		<div class="col-sm-8">
		<input class="form-control" value="{{$resume->availableDate}}" type="date" name="availableDate" id="availableDate" ><br>
		</div>
		</div>

		<div class="form-group row">
		<label for="salary" class="col-sm-3 col-form-label">Минимальная зарплата</label>
		<div class="col-sm-8">
		<input class="form-control" value="{{$resume->salary}}"  type="text" name="salary" id="salary"><br>
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
			<div class="col-sm-8">
				<input class="form-control" value="{{$usa}}" type="text" name="visaUsa" id="visaUSA"><br>
			</div>
			@if(Session::get('user_group') == "Managers"  || $self_user)
				<div class="col-sm-1">
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
			<div class="col-sm-8">
				<input class="form-control" value="{{$schengen}}" type="text" name="visaSchengen" id="visaSchengen"><br>
			</div>
			@if(Session::get('user_group') == "Managers"  || $self_user)
				<div class="col-sm-1">
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
					<td><input class="form-control" type="text" name="nameOfDoc" id="nameOfDoc_{{$passport->id}}" disabled value="{{$passport->nameOfDoc}}"></td>
					<td><input class="form-control" type="text" name="passCode_{{$passport->id}}" id="passCode"  value="{{$passport->passCode}}"></td>
					<td><input class="form-control" type="text" name="passNum_{{$passport->id}}" id="passNum"  value="{{$passport->passNum}}"></td>
					<td><input <? if($passport->nameOfDoc == "Civil passport") echo "disabled"; ?> class="form-control" type="date" name="expiryDate_{{$passport->id}}" id="expiryDate" value="{{$passport->expiryDate}}" ></td>
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
		<span style="text-align: right;"><p>Выделите галочкой для удаления</p></span>
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
				<td>
					<input type="checkbox" name="certifs[]" value="{{$certificate->id}}">
				</td>
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
					<input class="center form-control" value="{{$exp->nameOfVes}}" disabled type="text" >
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
			<div class="form-group flex-align-center" >
				<label class="col-sm-4 col-form-label">Выделить для удаления</label>
				<input class="" type="checkbox" name="exps[]" value="{{$exp->id}}">
			</div>
	<hr>

			
		@endforeach
		

		
		<br>
		<br>

		<hr>
		<h4>Дополнительная информация</h4>
		<br>
		
		<div class="form-group flex-center row">
		<textarea name="additionalinfo" id="additionalinfo" cols="90" rows="10" style="resize: none;">{{$resume->message}}</textarea>
		</div>
		<hr><br>
		<div class="container form-group row">
				<span class="col-md-4"></span>
				<input class="btn-primary form-control col-md-4" class="btn" type="submit" value="Сохранить изменения" name="edit">
		</div>
		<br><br>
</form>

@endsection