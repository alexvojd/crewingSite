@extends ('layouts.structure')

@section('content-fluid')

	<div class="table col-md-11 resumetableview form-margin" style="padding-left: 250px">
		<?echo Form::open(['route' => '/resume','class' => 'form-pad ']); ?>
		<div class="form-control row " style="margin-left: 0px">
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
			<br>	
		
		<?Form::close();?>
		</form>
		
	<table class=" table-striped  table-bordered" style="position: relative; ">

		<thead class="thead-light">
				<th style="width: 80px"><label>ФИО</label></th>
				<th><label>Дата рождения</label></th>
				<th><label>Должность</label></th>
				<th><label>Готовность</label></th>
				<th style="width:120px"><label>Виза США  </label></th>
				<th style="width: 120px"><label>Виза шенген</label></th>
				<th><label>Англ язык</label></th>
				<th><label>Мин. Зарплата</label></th>
		</thead>
		@foreach($resumes as $resume)
			<?php $sailor = $resume->sailor; ?>
			<tr>
				<td>
					<a href="/resume/{{$sailor->id}}">{!! $sailor->surname . " " . $sailor->name . " " . $sailor->patronymic !!}</a>
				</td>
				<td>
					{{$sailor->birthDate}}
				</td>
				<td>
					{{$resume->role->name}}
				</td>
				<td>
					{{$resume->availableDate}}
				</td>
				<?$visas = $resume->visas; ?>
				@if (count($visas) == 0)
					<td>
						None
					</td>
					<td>
						None
					</td>
				@elseif (count($visas) == 1)
					@foreach ($visas as $visa)
						@if ($visa->visaType->name == "USA")
							<td >{{$visa->expiryDate}}</td>
							<td>None</td>
						@else 
							<td>None</td>
							<td>{{$visa->expiryDate}}</td>
						@endif
					@endforeach
				@else
					@foreach ($visas as $visa)
							<td>{{$visa->expiryDate}}</td>
					@endforeach
				@endif
				<td>
					{{$resume->englishLevel->englishLevel}}
				</td>
				<td>
					{{$resume->salary}}
				</td>
			</tr>
		@endforeach
	</table>
	<div class="container">{{$resumes->links()}}</div>
	
	</div>
	
	
@endsection