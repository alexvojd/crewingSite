@extends ('layouts.structure')

@section('content')

	<div class="table" style="position: relative;padding-left: 200px;padding-right: 30px;">
		<?echo Form::open(['route' => '/manager/search_vacancies']); ?>
		<fieldset class="center">
			<legend style="padding-bottom: 20px;" >Вакансии</legend>
			
			<div class="form-group row">
				<label class="col-sm-2 col-form-label">Должность</label>
				<div class="col-sm-4">
					<select class="form-control" name="role">
						<option value="Any">Any</option>
						@foreach ($roles as $role)
							<option value="{{$role->id}}">{{$role->name}}</option>
						@endforeach
					</select>
				</div>
				<label class="col-sm-2 col-form-label">Английский </label>
				<div class="col-sm-4">
					<select class="form-control" name="englishLevel">
						<option value="Any">Any</option>
						@foreach ($englishLevels as $englishLevel)
							<option value="{{$englishLevel->id}}">{{$englishLevel->englishLevel}}</option>
						@endforeach
					</select>
				</div>
			</div>

			<div class="form-group row">
				<label class="col-sm-2 col-form-label">Тип двигателя</label>
				<div class="col-sm-4">
					<select class="form-control" name="engineType">
						<option value="Any">Any</option>
						@foreach ($engineTypes as $engineType)
							<option value="{{$engineType->id}}">{{$engineType->engineType}}</option>
						@endforeach
					</select>
				</div>
				<label class="col-sm-2 col-form-label">Тип судна </label>
				<div class="col-sm-4">
					<select class="form-control" name="vesselType">
						<option value="Any">Any</option>
						@foreach ($vesselTypes as $vesselType)
							<option value="{{$vesselType->id}}">{{$vesselType->vesselType}}</option>
						@endforeach
					</select>
				</div>
			</div>
			
			<div class="form-group row" >
				<label class="col-sm-2 col-form-label" for=landFrom"">Посадка от</label>
				<div class="col-sm-4">
					<input class="form-control" type="date" name="landingFrom" placeholder="Готов от">
				</div>
				
				<label class="col-sm-2 col-form-label" for="landTo">Посадка до</label>
				<div class="col-sm-4">
					<input class="form-control" type="date" name="landingTo" placeholder="Готов до">
				</div>
			</div>


			<div class="form-group row" >
				<label class="col-sm-2 col-form-label">Зарплата от</label>
				<div class="col-sm-4">
					<input class="form-control" type="text" name="salaryFrom" >
				</div>
				<label class="col-sm-2 col-form-label" > Зарплата до</label>
				<div class="col-sm-4">
					<input class="form-control" type="text" name="salaryTo" >
				</div>
			</div>

			<div class="form-group row" >
				<label class="col-sm-2 col-form-label">Контракт от</label>
				<div class="col-sm-4">
					<input class="form-control" type="text" name="contractFrom" >
				</div>
				<label class="col-sm-2 col-form-label" > Контракт до</label>
				<div class="col-sm-4">
					<input class="form-control" type="text" name="contractTo" >
				</div>
			</div>

			<div class="form-group row" >
				<label class="col-sm-2 col-form-label">Опыт от</label>
				<div class="col-sm-4">
					<input class="form-control" type="text" name="expFrom" >
				</div>
				<label class="col-sm-2 col-form-label" > Опыт до</label>
				<div class="col-sm-4">
					<input class="form-control" type="text" name="expTo" >
				</div>
			</div>

			<div class="form-group row" >

		</fieldset>

			<div style="text-align: center;">
				<input class="btn" type="submit" value="Поиск" name="resumeForm">
				</div>
		
		<?Form::close();?>
</div>

	<div class="table form-margin">
	<table class=" table-striped table-bordered" style="position: relative;">
		<thead class="thead-light">
				<th><label>id</label></th>
				<th><label>Должность</label></th>
				<th><label>Компания</label></th>
				<th><label>Тип судна</label></th>
				<th><label>Зарплата</label></th>
				<th><label>Дата посадки</label></th>
				<th><label>Вакансия добавлена</label></th>
		</thead>

		@foreach($vacancies as $vacancy)
			<tr>
				<td>
					{{$vacancy->id}}
				</td>
				<td>
					<a href="/vacancy/{{$vacancy->id}}">{{$vacancy->role}}</a>
				</td>
				<td>
					{{$vacancy->name}}
				</td>
				<td>
					{{$vacancy->vesselType}}
				</td>
				<td>
					{{$vacancy->salary}}
				</td>
				<td>
					{{$vacancy->landingDate}}
				</td>
				<td>
					{{$vacancy->publicDate}}
				</td>
			</tr>
		@endforeach
	</table>
	{{$vacancies->links()}}
	</div>
	
@endsection