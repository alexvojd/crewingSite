@extends ('layouts.structure')

@section('content')
<!--Experience -->
<?echo Form::open(['route' => '/profile/crt_experience','class' => 'form-pad']); ?>
	<hr>
	<h4 class="center">Опыт работы</h4>
	<hr>
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
			<label for="nameOfVes" class="col-sm-3 col-form-label">Название судна</label>
			<div class="col-sm-8">
				<input class="form-control" type="text" name="nameOfVes" id="nameOfVes"><br>
			</div>
		</div>

		<div class="form-group row">
			<label for="DWT" class="col-sm-3 col-form-label">DWT</label>
			<div class="col-sm-8">
				<input class="form-control" type="text" name="DWT" id="DWT"><br>
			</div>
		</div>

		<div class="form-group row">
			<label for="engineType" class="col-sm-3 col-form-label">Тип двигателя</label>
			<div class="col-sm-8">
				<select class="form-control" name="engineType" class="col-sm-10 ">
					@foreach ($engineTypes as $engineType)
						<option value="{{$engineType->id}}">{{$engineType->engineType}}</option>
					@endforeach
				</select><br>
			</div>
		</div>

		<div class="form-group row">
			<label for="BHP" class="col-sm-3 col-form-label">BHP</label>
			<div class="col-sm-8">
				<input class="form-control" type="text" name="BHP" id="BHP"><br>
			</div>
		</div>

		<div class="form-group row">
			<label for="flag" class="col-sm-3 col-form-label">flag</label>
			<div class="col-sm-8">
				<input class="form-control" type="text" name="flag" id="flag"><br>
			</div>
		</div>

		<div class="form-group row">
			<label for="shipowner" class="col-sm-3 col-form-label">Судовладелец</label>
			<div class="col-sm-8">
				<input class="form-control" type="text" name="shipowner" id="shipowner"><br>
			</div>
		</div>

		<div class="form-group row">
			<label for="crewing" class="col-sm-3 col-form-label">Крюинг</label>
			<div class="col-sm-8">
				<input class="form-control" type="text" name="crewing" id="crewing"><br>
			</div>
		</div>

		<div class="form-group row">
			<label for="dateFrom" class="col-sm-3 col-form-label">Дата начиная с</label>
			<div class="col-sm-8">
				<input class="form-control" type="date" name="dateFrom" id="dateFrom"><br>
			</div>
		</div>
		
		<div class="form-group row">
			<label for="dateTo" class="col-sm-3 col-form-label">Дата до</label>
			<div class="col-sm-8">
				<input class="form-control" type="date" name="dateTo" id="dateTo"><br>
			</div>
		</div>

		@if (Session::get('user_group') == "Managers")
			<input type="text" name="idSailor" value="" placeholder="ID моряка">
			<br>
		@endif

		<div style="text-align: center;">
				<input class="btn" type="submit" value="Сохранить" name="resumeForm">
				</div>
		<br>
		<hr>
		
		<?Form::close();?>
@endsection