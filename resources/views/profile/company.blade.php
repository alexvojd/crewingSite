@extends ('layouts.structure')

@section('content')

<!-- Форма изменения персональных данных компании -->
	<?echo Form::open(['route' => '/profile/manageresume','class' => 'form-pad']); ?>
		<br>
		<br>
		<h3 class="center">Данные Компании </h3>
		<br>
		<br>
		<div class="form-group row">
			<label for="fio" class="col-sm-3 col-form-label">Название компании</label>
			<div class="col-sm-8">
				<input class="form-control" type="text" name="name" id="name" value="{{$company->name}}" disabled><br>
			</div>
		</div>

		<div class="form-group row">
			<label for="fio" class="col-sm-3 col-form-label">ФИО представителя</label>
			<div class="col-sm-8">
				<input class="form-control" type="text" name="fio" id="fio" value="{{$company->fio}}"><br>
			</div>
		</div>

		<div class="form-group row">
			<label class="col-sm-3 col-form-label">Email</label>
			<div class="col-sm-8">
				<input class="form-control" type="text" name="email" id="email" value="{{$company->email}}" disabled><br>
			</div>
		</div>

		<div class="form-group row">
			<label class="col-sm-3 col-form-label">Site</label>
			<div class="col-sm-8">
				<input class="form-control" type="text" name="site" id="site" value="{{$company->site}}"><br>
			</div>
		</div>

		<div class="form-group row">
		<label class="col-sm-3 col-form-label">Контактный телефон</label>
		<div class="col-sm-8">
		<input class="form-control" type="text" name="contactPhone" id="contactPhone" value="{{$company->contactPhone}}">
		</div>
		</div>


		<div style="text-align: center;">
		<input class="btn" type="submit" value="Сохранить изменения" name="companyForm">
		</div>
		<br>
		<br>
	<?Form::close();?>
@endsection