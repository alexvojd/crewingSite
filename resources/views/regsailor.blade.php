@extends('layouts.structure')

@section('content')
	<h1 style="padding: 20px;text-align: center;">Регистрация моряка</h1>


	{!!Form::open(['/register/sailor' => 'RegiserController@addSailor','id' => 'regform','class' => 'form-group form-pad']) !!}

	<div class="form-group row">
	{!!
	Form::label('surname', 'Фамилия', array('class' => 'col-sm-3 col-form-label')) .'<div class="col-sm-8">'. Form::text('surname','',array('class' => 'form-control'))
	!!} 
	</div>
	</div>

	<div class="form-group row">
	{!!
	Form::label('name', 'Имя', array('class' => 'col-sm-3 col-form-label')) .'<div class="col-sm-8">'. Form::text('name','',array('class' => 'form-control'))
	!!}
	</div>
	</div>

	<div class="form-group row">
	{!!
	Form::label('patronymic', 'Отчество', array('class' => 'col-sm-3 col-form-label')) .'<div class="col-sm-8">'. Form::text('patronymic','',array('class' => 'form-control'))
	!!} 
	</div>
	</div>

		<div class="form-group row">
	{!!
	Form::label('email', 'Email', array('class' => 'col-sm-3 col-form-label')) .'<div class="col-sm-8">'. Form::text('email','',array('class' => 'form-control'))
	!!} 
	</div>
	</div>

		<div class="form-group row">
	{!!
	Form::label('password', 'Пароль', array('class' => 'col-sm-3 col-form-label')) .'<div class="col-sm-8">'. Form::text('password','',array('class' => 'form-control'))
	!!} 
	</div>
	</div>

		<div class="form-group row">
	{!!
	Form::label('birthDate', 'Дата рождения', array('class' => 'col-sm-3 col-form-label')) .'<div class="col-sm-8">'. Form::date('birthDate','',array('class' => 'form-control'))
	!!} 
	</div>
	</div> 
	
	<div class="form-group row">
	{!!
	Form::label('country', 'Страна', array('class' => 'col-sm-3 col-form-label'))
	!!}
		<div class="col-sm-8">
			<select name="country" class="form-control" onchange="getRegions(this.value)">
				@foreach ($countries as $country)
					<option value="{{$country->name}}">{{$country->name}}</option>
				@endforeach
			</select>
		</div> 
	</div> 
	
			<div class="form-group row">
	{!!
	Form::label('region', 'Регион', array('class' => 'col-sm-3 col-form-label'))
	!!} 
		<div class="col-sm-8">
			<select name="region" class="form-control" id="region" onchange="getCities(this.value)">
				@foreach ($regions as $region)
					<option value="{{$region->name}}">{{$region->name}}</option>
				@endforeach
			</select>
	</div>
	</div>

			<div class="form-group row">
	{!!
	Form::label('city', 'Город', array('class' => 'col-sm-3 col-form-label'))
	!!} 
		<div class="col-sm-8">
			<select name="city" class="form-control" id="city">
				@foreach ($cities as $city)
						<option value="{{$city->name}}">{{$city->name}}</option>
				@endforeach
			</select>
	</div>
	</div>

			<div class="form-group row">
	{!!
	Form::label('permAdress', 'Адресс', array('class' => 'col-sm-3 col-form-label')) .'<div class="col-sm-8">'. Form::text('permAdress','',array('class' => 'form-control'))
	!!} 
	</div>
	</div>

			<div class="form-group row">
	{!!
	Form::label('nationality', 'Национальность', array('class' => 'col-sm-3 col-form-label')) .'<div class="col-sm-8">'. Form::text('nationality','',array('class' => 'form-control'))
	!!} 
	</div>
	</div>

			<div class="form-group row">
	{!!
	Form::label('nearestAirport', 'Ближайщий аэропорт', array('class' => 'col-sm-3 col-form-label'))
	!!} 
		<div class="col-sm-8">
			<select name="nearestAirport" class="form-control" id="airport">
				@foreach ($cities as $city)
						<option value="{{$city->name}}">{{$city->name}}</option>
				@endforeach
			</select>
	</div>
	</div>

			<div class="form-group row">
	{!!
	Form::label('contactPhone', 'Моб.телефон', array('class' => 'col-sm-3 col-form-label')) .'<div class="col-sm-8">'. Form::text('contactPhone','',array('class' => 'form-control'))
	!!} 
	</div>
	</div>
	<br>
	

	<div class="form-group row">
		<div class="col-sm-12" style="text-align: center;">
			@if (count($errors) > 0)
			  <div class="alert alert-danger">
			    <ul>
			      @foreach ($errors->all() as $error)
			        <li>{{ $error }}</li>
			      @endforeach
			    </ul>
			  </div>
			@endif
			{!!Form::submit('Register!', array('class' => 'btn'))!!}
		</div>
	</div>
	<br>
	{!!Form::close()!!} 


@endsection