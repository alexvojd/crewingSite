@extends ('layouts.structure')

@section('content')

	
<!-- Данные менеджера -->

	<div class="form-pad">
		<h3 class="center">Данные Менеджера </h3>
		<br>

		<div class="form-group row">
			<label class="col-sm-3 col-form-label">Id менеджера в компании</label>
			<div class="col-sm-8">
				<input class="form-control" type="text" name="contactPhone" id="contactPhone" value="{{$manager->jobID}}" disabled><br>
			</div>
		</div>

		<div class="form-group row">
			<label for="fio" class="col-sm-3 col-form-label">ФИО</label>
			<div class="col-sm-8">
				<input class="form-control" type="text" name="name" id="name" value="{!! $manager->surname.' '.$manager->name.' '.$manager->patronymic !!}" disabled>
			</div>
		</div>

		<div class="form-group row">
			<label class="col-sm-3 col-form-label">Email</label>
			<div class="col-sm-8">
				<input class="form-control" type="text" name="email" id="email" value="{{$manager->email}}" disabled><br>
			</div>
		</div>

		<div class="form-group row">
			<label class="col-sm-3 col-form-label">Пароль</label>
			<div class="col-sm-8">
				<input class="form-control" type="text" name="site" id="site" value="{{$manager->password}}" disabled><br>
			</div>
		</div>
		<hr>
		<br>
	</div>

@endsection