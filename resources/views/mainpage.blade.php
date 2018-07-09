@extends ('layouts.structure')

@section('content')
	<div class="form-pad">
		<br>
		<h2 class="center">Добро пожаловать на сайт Crewing Partner</h2>
		
		<p></p>Crewing Partner - поможет вам найти работу или же экипаж на ваше судно.</p>
		<p>Ежедневно на нашем сайте вы можете увидеть самые свежие вакансии и резюме а также добавить свое и быстро найти работу.</p>
		<div class="form-group flex-center row">
			@if (Session::get('user_group') == 'Гость')
				<a href="/profile/addresume" style="margin: 15px;color: white; " class="btn bg-dark col-md-4">Создать резюме</a>
			@endif
			@if (Session::get('user_group') == 'Гость')
				<a href="/profile/addvacancy"  style="margin: 15px;color: white;" class="btn bg-dark col-md-4">Создать вакансию</a>
			@endif
		</div>
	</div>

@endsection
