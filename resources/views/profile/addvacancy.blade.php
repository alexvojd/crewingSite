@extends ('layouts.structure')

@section('content')

	<p> Profile </p>
	
<!-- Форма добавления вакансии компании -->
	@section('content')
		<?echo Form::open(['route' => '/profile/crt_vacancy','class' => 'form-pad']); ?>
		<hr>
		<h3 class="center">Вакансия</h3>
		<br>
		<div class="form-group row">
			<label for="role" class="col-sm-3 col-form-label">Должность</label>
			<div class="col-sm-8">
				<select class="form-control" name="role">
					@foreach ($roles as $role)
						<option value="{{$role->id}}">{{$role->name}}</option>
					@endforeach
				</select><br>
			</div>
		</div>
		
		<div class="form-group row">
		<label for="levelOfEng" class="col-sm-3 col-form-label">Уровень английского</label>
		<div class="col-sm-8">
		<select class="form-control" name="levelOfEng" class="col-sm-10 ">
			@foreach ($levelsOfEng as $levelOfEng)
				<option value="{{$levelOfEng->id}}">{{$levelOfEng->englishLevel}}</option>
			@endforeach
		</select><br>
		</div>
		</div>
		
		<div class="form-group row">
		<label for="availableDate" class="col-sm-3 col-form-label">Дата посадки</label>
		<div class="col-sm-8">
		<input class="form-control" type="date" name="landingDate" id="landingDate"><br>
		</div>
		</div>

		<div class="form-group row">
			<label for="salary" class="col-sm-3 col-form-label">Минимальная зарплата</label>
			<div class="col-sm-8">
				<input class="form-control" type="text" name="salary" id="salary"><br>
			</div>
		</div>

		<div class="form-group row">
			<label for="salary" class="col-sm-3 col-form-label">Контракт</label>
			<div class="col-sm-8">
				<input class="form-control" type="text" name="contract" id="contract"><br>
			</div>
		</div>

		<div class="form-group row">
			<label for="salary" class="col-sm-3 col-form-label">Опыт в должности</label>
			<div class="col-sm-8">
				<input class="form-control" type="text" name="experience" id="experience"><br>
			</div>
		</div>

		<div class="form-group row">
			<label for="vesselType" class="col-sm-3 col-form-label">Тип судна</label>
			<div class="col-sm-8">
				<select class="form-control" name="vesselType" class="col-sm-10 ">
				@foreach ($vesselTypes as $vesselType)
					<option value="{{$vesselType->id}}">{{$vesselType->vesselType}}</option>
				@endforeach
				</select><br>
			</div>
		</div>

		<div class="form-group row">
			<label for="salary" class="col-sm-3 col-form-label">Год постройки судна</label>
			<div class="col-sm-8">
				<input class="form-control" type="text" name="yearOfConstruct" id="yearOfConstruct"><br>
			</div>
		</div>

		<div class="form-group row">
			<label for="salary" class="col-sm-3 col-form-label">Тип двигателя</label>
			<div class="col-sm-8">
				<select class="form-control" name="engineType" class="col-sm-10 ">
				@foreach ($engineTypes as $engineType)
					<option value="{{$engineType->id}}">{{$engineType->engineType}}</option>
				@endforeach
				</select><br>
			</div>
		</div>

		<div class="form-group row">
			<label for="salary" class="col-sm-3 col-form-label">Мощность двигателя (bhp)</label>
			<div class="col-sm-8">
				<input class="form-control" type="text" name="bhp" id="bhp"><br>
			</div>
		</div>

		<div class="form-group row">
			<label for="salary" class="col-sm-3 col-form-label">DWT</label>
			<div class="col-sm-8">
				<input class="form-control" type="text" name="dwt" id="dwt"><br>
			</div>
		</div>

		<hr>
		<h4>Дополнительная информация</h4>
		<br>
		
		<div class="form-group row">
		<textarea name="additionalInfo" id="additionalInfo" cols="90" rows="10" style="resize: none;"></textarea>
		</div>
		

		@if (Session::get('user_group') == "Managers")
			<div class="form-group row">
				<label class="col-sm-4 col-form-label">Скрыть пользователя</label>
				<div class="col-sm-2">
					<label class="col-form-label">Да</label>
					<input type="radio" id="hidden" name="hidden" value="1" checked>
				</div>
				<div class="col-sm-2">
					<label class="col-form-label">Нет</label>
					<input type="radio" id="hidden" name="hidden" value="0">
				</div>
			</div>
			<input type="hidden" name="idCompany" value="{{$idCompany}}">
			<br>
		@endif

		<div style="text-align: center;">
		<input class="btn" type="submit" value="Добавить вакансию" name="vacancyForm">
		</div>
		<br>
		<hr>
		<br>
		
	<?Form::close();?>
@endsection