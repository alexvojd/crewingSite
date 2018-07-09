@extends ('layouts.structure')

@section('content')
		<?echo Form::open(['route' => '/vacancy']); ?>
		<div class="container form-pad" style="padding-right: 105px">
		<div class="form-control row" style="margin-left: 0px">
				<label class="col-sm-2 col-form-label">Должность</label>
				<div class="col-sm-4">
					<select class="form-control" name="role">
						<option value="Any">Any</option>
						@foreach ($roles as $role)
							<option value="{{$role->id}}">{{$role->name}}</option>
						@endforeach
					</select>
				</div>
				<label class="col-sm-2 col-form-label">Уровень английского</label>
					<div class="col-sm-4">
					<select class="form-control" name="englishLevel">
						<option value="Any">Any</option>
						@foreach ($englishLevels as $englishLevel)
							<option value="{{$englishLevel->id}}">{{$englishLevel->englishLevel}}</option>
						@endforeach
					</select>
					</div>
			<div class="container center form-control">
				<input class="btn form-control" class="btn" type="submit" value="Поиск" name="resumeForm">
			</div>
		</div>
		</div>
			<br>	
		
		<?Form::close();?>

	<div class="table col-md-11 form-margin">
	<table class=" table-striped table-bordered" style="position: relative;">
		<thead class="thead-light">
				<th><label>Должность</label></th>
				<th><label>Компания</label></th>
				<th><label>Тип судна</label></th>
				<th><label>Зарплата</label></th>
				<th><label>Дата посадки</label></th>
				<th><label>Вакансия добавлена</label></th>
		</thead>

			@foreach ($vacancies as $vacancy)
				<tr>
					<td>
						<a href="/vacancy/{{$vacancy->id}}">{{$vacancy->role->name}}</a>
					</td>
					<td>
						{{$vacancy->company->name}}
					</td>
					<td>
						{{$vacancy->vesselType->vesselType}}
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