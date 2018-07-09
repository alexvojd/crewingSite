@extends('layouts.structure')

@section('content')

	<h1 style="padding: 20px;text-align: center;">Регистрация компании</h1>
	
	{!!Form::open(['/register/company' => 'RegiserController@addCompany','id' => 'regform','class' => 'form-group form-pad'])!!}
	
	<div class="form-group row">
		{!!Form::label('name', 'Название компании', array('class' => 'col-sm-3 col-form-label')) .'<div class="col-sm-8">'. Form::text('name','',array('class' => 'form-control'))!!}
	</div>
	</div>

	<div class="form-group row">
		{!!Form::label('fio', 'ФИО представителя', array('class' => 'col-sm-3 col-form-label')) .'<div class="col-sm-8">'. Form::text('fio','',array('class' => 'form-control'))!!}
	</div>
	</div>

	<div class="form-group row">
		{!!Form::label('email', 'Email', array('class' => 'col-sm-3 col-form-label')) .'<div class="col-sm-8">'. Form::text('email','',array('class' => 'form-control'))!!}
	</div>
	</div>

	<div class="form-group row">
		{!!Form::label('password', 'Пароль', array('class' => 'col-sm-3 col-form-label')) .'<div class="col-sm-8">'. Form::text('password','',array('class' => 'form-control'))!!}
	</div>
	</div>

	<div class="form-group row">
		{!!Form::label('site', 'Site', array('class' => 'col-sm-3 col-form-label')) .'<div class="col-sm-8">'. Form::text('site','',array('class' => 'form-control'))!!}
	</div>
	</div>

	<div class="form-group row">
		{!!Form::label('contactPhone', 'Моб.телефон', array('class' => 'col-sm-3 col-form-label')) .'<div class="col-sm-8">'. Form::text('contactPhone','',array('class' => 'form-control'))!!}
	</div>
	</div>
	
	<br>
	

	<div class="form-group row">
		<div class="col-sm-12 center">
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

	{!!Form::close()!!}
	
	
@endsection