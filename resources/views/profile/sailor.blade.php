@extends ('layouts.structure')

@section('content')

	<?php 
		//$user_group = Session::get('user_group', 'Гость');
		//$user_name = Session::get('fullname', 'Гость');
		$resume = $user->resume;
	?>	
	

	<!-- Форма изменения персональных данных -->
	<?echo Form::open(['route' => '/profile/upd_personal','class' => 'form-pad']); ?>
		<hr>
		<h3 class="center">Персональные данные </h3>
		<br>
		@if (isset($resume))
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
		@endif
		<br>
		<div class="form-group row">
		<label for="fio" class="col-sm-3 col-form-label">ФИО</label>
		<div class="col-sm-8">
		<input class="form-control" type="text" name="fio" id="fio" value="<?echo $user->surname ." " . $user->name . " " . $user->patronymic; ?>" disabled>
		</div>
		</div>
		<!--
		<div class="form-group row">
		<label for="name" class="col-sm-3 col-form-label">Имя</label>
		<div class="col-sm-8">
		<input class="form-control" type="text" name="name" id="name" value="{{$user->name}}" disabled><br>
		</div>
		</div>

		<div class="form-group row">
		<label for="patronymic" class="col-sm-3 col-form-label">Отчество</label>
		<div class="col-sm-8">
		<input class="form-control" type="text" name="patronymic" id="patronymic" value="{{$user->patronymic}}" disabled><br>
		</div>
		</div>
		-->
		<div class="form-group row">
		<label class="col-sm-3 col-form-label">Email</label>
		<div class="col-sm-8">
		<input class="form-control" type="text" name="email" id="email" value="{{$user->email}}" disabled>
		</div>
		</div>

		<div class="form-group row">
		<label class="col-sm-3 col-form-label">День рождения</label>
		<div class="col-sm-8">
		<input class="form-control" type="text" name="birthDate" id="birthDate" value="{{$user->birthDate}}" disabled>
		</div>
		</div>

		<div class="form-group row">
		<label class="col-sm-3 col-form-label">Текущая страна</label>
		<div class="col-sm-8">
		<input class="form-control" type="text" name="surname" id="surname" value="{{$user->country}}" disabled>
		</div>
		</div>

		<div class="form-group row">
		<label for="country" class="col-sm-3 col-form-label">Изменить страну</label>
		<div class="col-sm-8 col-form-label">
		<select class="form-control" name="country" onchange="getRegions(this.value)">
			@foreach ($countries as $country)
				@if ($country->name == $user->country)
					<option value="{{$country->name}}" selected>{{$country->name}}</option>
				@else
					<option value="{{$country->name}}">{{$country->name}}</option>
				@endif
			@endforeach
		</select>
		</div>
		</div>

		<div class="form-group row">
		<label class="col-sm-3 col-form-label">Текущий регион</label>
		<div class="col-sm-8">
		<input class="form-control" type="text" name="surname" id="surname" value="{{$user->region}}" disabled>
		</div>
		</div>

		<div class="form-group row">
		<label for="region" class="col-sm-3 col-form-label">Изменить регион</label>
		<div class="col-sm-8 col-form-label">
		<select class="form-control" name="region" id="region" onchange="getCities(this.value)">
			@foreach ($regions as $region)
				<option value="{{$region->name}}">{{$region->name}}</option>
			@endforeach
		</select>
		</div>
		</div>
		
		<div class="form-group row">
			<label class="col-sm-3 col-form-label">Текущий город</label>
			<div class="col-sm-8">
			<input class="form-control" type="text" name="surname" id="surname" value="{{$user->city}}" disabled>
			</div>
		</div>

		<div class="form-group row">
			<label for="city" class="col-sm-3 col-form-label">Изменить город</label>
			<div class="col-sm-8 col-form-label">
				<select class="form-control" name="city" id="city">
					@foreach ($cities as $city)
						<option value="{{$city->name}}">{{$city->name}}</option>
					@endforeach
				</select>
			</div>
		</div>
		
		<div class="form-group row">
			<label for="permAdress" class="col-sm-3 col-form-label">Постоянный адрес</label>
			<div class="col-sm-8">
				<input class="form-control" type="text" name="permAdress" id="permAdress" value="{{$user->permAdress}}">
			</div>
		</div>	
		
		<div class="form-group row">
			<label for="nationality" class="col-sm-3 col-form-label">Национальность</label>
			<div class="col-sm-8">
				<input class="form-control" type="text" name="nationality" id="nationality" value="{{$user->nationality}}" disabled>
			</div>
		</div>
		
		<div class="form-group row">
			<label class="col-sm-3 col-form-label">Текущий аэропорт</label>
			<div class="col-sm-8">
			<input class="form-control" type="text" name="surname" id="surname" value="{{$user->nearestAirport}}" disabled>
			</div>
		</div>

		<div class="form-group row">
			<label for="nearestAirport" class="col-sm-3 col-form-label">Ближайщий аэропорт</label>
			<div class="col-sm-8">
				<select class="form-control" name="nearestAirport" id="airport">
					@foreach ($cities as $city)
						<option value="{{$city->name}}">{{$city->name}}</option>
					@endforeach
				</select>
			</div>
		</div>
		
		<div class="form-group row">
			<label for="contactPhone" class="col-sm-3 col-form-label">Контактный телефон</label>
		<div class="col-sm-8">
			<input class="form-control" type="text" name="contactPhone" id="contactPhone" value="{{$user->contactPhone}}">
		</div>
		</div>
		<div class="center">
		<input class="btn" type="submit" value="Сохранить изменения!" name="personalForm">
		</div>
		<br>
		<hr>
	<?Form::close();?>
@endsection