@extends ('layouts.structure')

@section('content')
	<div class="form-pad">
	<br>
	<br>
		<h5>Компания</h5>
	<br>

		@if(Session::get('user_group') == "Managers")
			<div class="form-group row">
				<label for="name" class="col-sm-3 col-form-label">Id Компании</label>
				<div class="col-sm-8">
					<input class="form-control" type="text" name="name" id="name" value="{{$company->id}}" disabled>
				</div>
			</div><br>
		@endif
		<div class="form-group row">
			<label for="name" class="col-sm-3 col-form-label">Название компании</label>
			<div class="col-sm-8">
				<input class="form-control" type="text" name="name" id="name" value="{{$company->name}}" disabled>
			</div>
		</div><br>

		<div class="form-group row">
			<label for="name" class="col-sm-3 col-form-label">ФИО представителя</label>
			<div class="col-sm-8">
				<input class="form-control" type="text" name="fio" id="fio" value="{{$company->fio}}" disabled>
			</div>
		</div><br>

		<div class="form-group row">
			<label class="col-sm-3 col-form-label">Email</label>
			<div class="col-sm-8">
				<input class="form-control" type="text" name="email" id="email" value="{!! ($isAuthorized == true)? $company->email : 'register to see' !!}" disabled><br>
			</div>
		</div>

		<div class="form-group row">
			<label class="col-sm-3 col-form-label">Site</label>
			<div class="col-sm-8">
				<input class="form-control" type="text" name="birthDate" id="birthDate" value="{!! ($isAuthorized == true)? $company->site : 'register to see' !!}" disabled><br>
			</div>
		</div>
		
		<div class="form-group row">
			<label for="contactPhone" class="col-sm-3 col-form-label">Контактный телефон</label>
			<div class="col-sm-8">
				<input class="form-control" type="text" name="contactPhone" id="contactPhone" value="{!! ($isAuthorized == true)? $company->contactPhone : 'register to see' !!}" disabled>
			</div>
		</div>
		<br>

		<hr>
		<h3>Вакансия</h3>
		<br>
		<div class="form-group row">
			<label for="role" class="col-sm-3 col-form-label">Должность</label>
			<div class="col-sm-8">
				<input class="form-control" type="text" name="role" id="role" value="{{$role->name}}" disabled>
			</div>
		</div><br>

		<div class="form-group row">
			<label for="salary" class="col-sm-3 col-form-label">Тип судна</label>
			<div class="col-sm-8">
				<input class="form-control" value="{{$vacancy->vesselType->vesselType}}"  type="text" name="vesselType" id="vesselType" disabled><br>
			</div>
		</div>
		<div class="form-group row">
			<label for="salary" class="col-sm-3 col-form-label">Опыта в рейсах</label>
			<div class="col-sm-8">
				<input class="form-control" value="{{$vacancy->experience}}"  type="text" name="vesselType" id="vesselType" disabled><br>
			</div>
		</div>
		<div class="form-group row">
			<label for="salary" class="col-sm-3 col-form-label">Контракт в месяцах</label>
			<div class="col-sm-8">
				<input class="form-control" value="{{$vacancy->contract}}"  type="text" name="vesselType" id="vesselType" disabled><br>
			</div>
		</div>

		<div class="form-group row">
			<label for="availableDate" class="col-sm-3 col-form-label">DWT</label>
			<div class="col-sm-8">
				<input class="form-control" value="{{$vacancy->dwt}}" type="text" name="DWT" id="DWT" disabled><br>
			</div>
		</div>

		<div class="form-group row">
			<label for="availableDate" class="col-sm-3 col-form-label">Дата постройки</label>
			<div class="col-sm-8">
				<input class="form-control" value="{{$vacancy->yearOfConstruct}}" type="text" name="yearOfConstruct" id="yearOfConstruct" disabled><br>
			</div>
		</div>
		
		<div class="form-group row">
			<label for="englishLevel" class="col-sm-3 col-form-label">Уровень английского</label>
			<div class="col-sm-8">
					<input class="form-control" type="text" name="englishLevel" id="englishLevel" value="{{$englishLevel->englishLevel}}" disabled>
			</div>
		</div>
		
		<div class="form-group row">
			<label for="availableDate" class="col-sm-3 col-form-label">Дата посадки</label>
			<div class="col-sm-8">
				<input class="form-control" value="{{$vacancy->landingDate}}" type="text" name="landingDate" id="landingDate" disabled><br>
			</div>
		</div>

		<div class="form-group row">
			<label for="salary" class="col-sm-3 col-form-label">Зарплата</label>
			<div class="col-sm-8">
				<input class="form-control" value="{{$vacancy->salary}}"  type="text" name="salary" id="salary" disabled><br>
			</div>
		</div>
		
		<div class="form-group row">
			<label for="salary" class="col-sm-3 col-form-label">Main Engine</label>
			<div class="col-sm-8">
				<input class="form-control" value="{{$vacancy->engineType->engineType}}"  type="text" name="engineType" id="engineType" disabled><br>
			</div>
		</div>

		<div class="form-group row">
			<label for="availableDate" class="col-sm-3 col-form-label">Мощность (BHP)</label>
			<div class="col-sm-8">
				<input class="form-control" value="{{$vacancy->bhp}}" type="text" name="BHP" id="BHP" disabled><br>
			</div>
		</div>

		<hr>
		<h4>Дополнительная информация</h4>
		<br>
		
		<div class="form-group flex-center row">
		<textarea name="additionalinfo" id="additionalinfo" cols="90" rows="10" style="resize: none;" disabled>{{$vacancy->message}}</textarea>
		</div>

		<hr><br>
	</div>
@endsection