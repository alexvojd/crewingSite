@extends ('layouts.structure')

@section('content')
		<?echo Form::open(['route' => '/profile/deletavacancies']); ?>	

	<div class="table col-md-11 form-margin">
	<table class=" table-striped table-bordered" style="position: relative;">
		<thead class="thead-light">
				<th><label>Должность</label></th>
				<th><label>Компания</label></th>
				<th><label>Тип судна</label></th>
				<th><label>Зарплата</label></th>
				<th><label>Дата посадки</label></th>
				<th><label>Вакансия добавлена</label></th>
				<th>Del</th>
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
					<td>
						<input type="checkbox" name="ids[]" value="{{$vacancy->id}}">
					</td>
				</tr>
			@endforeach

	</table>
	<br>
		<div class="container form-group row">
				<span class="col-md-4"></span>
				<input class="btn-primary form-control col-md-3" class="btn" type="submit" value="Удалить выделенные" name="delete">
		</div>
	<?Form::close();?>
	{{$vacancies->links()}}
</div>
@endsection