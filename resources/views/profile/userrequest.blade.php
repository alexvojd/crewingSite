<?php
?>
@extends('layouts.structure')

@section('content')
<div class="form-pad center">
		@if(!$isAlreadySend)
			{{Form::open(['route' => '/profile/user_request','id' => 'requestForm','class' => 'form-group'])}}
				<hr>
				<h3>Отправить запрос на помощь к администратору</h3>
				<br>
					<p>Опишите что или кого нужно искать и отправьте это сообщение нам, мы свяжемся с вами, используя контакты из ваших персональных данных.</p>
				<br>

				<div class="form-group flex-center row">
					<textarea name="message" id="Additionalinfo" cols="90" rows="10" placeholder="Сообщение" style="resize: none;"></textarea>
				</div>
					
				<div style="text-align: center;">
				<input class="btn-primary" type="submit" value="Отправить!" name="resumeForm">
				</div>
			{{Form::close()}}
		@else
			<h4>Лимит запросов исчерпан, ожидайте обработки предидущих.</h4>
		@endif
</div>	
	
@endsection