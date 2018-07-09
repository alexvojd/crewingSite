<?php
	//esli authorizovan to na mainpage
?>
@extends('layouts.structure')

@section('content')

	<h1 style="padding: 20px;text-align: center;"">Авторизация</h1>

		{!!
		Form::open(['authorization' => 'AuthorizController@authorization','id' => 'regform','class' => 'form-group form-pad'])
		!!}
		<p>Выполнить вход как: </p>

		<input type="radio" id="companyChoice" name="user_group" value="Companies">
	    <label for="contactChoice1">Компания</label>
	    <input type="radio" id="sailorChoice"
	           name="user_group" value="Sailors" checked>
	    <label for="contactChoice2">Моряк</label>
		</br>
		<br>
	<div class="form-group row">
		<label for="email" class="col-sm-3 col-form-label">Email</label>
		<div class="col-sm-8">
			<input type="text" class="form-control" name="email" id="email">
		</div>
		<br>
	</div>
	<div class="form-group row">
		<label for="password" class="col-sm-3 col-form-label">Password</label>
		<div class="col-sm-8">
			<input type="password" class="form-control" name="password" id="password"><br>
		</div>
	</div>
	
		<div class="form-group row">
			<div class="col-sm-12 center">	
			@if(isset($msg))
				<p style="color: red"><? echo $msg; ?></p>
			@endif
			<input type="submit" value="Authorization!" class="btn">
			</div>
		</div>
	
	<?Form::close();?>
	
	
@endsection