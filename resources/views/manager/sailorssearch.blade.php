@extends ('layouts.structure')

@section('content')
	<div class="table" style="position: relative;">
		<?echo Form::open(['route' => '/manager/search_resumes','class' => 'form-margin']); ?>
		<fieldset class="center">
			<legend style="padding-bottom: 20px;" >Резюме</legend>
			
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
			
			<div class="form-group row" >
				<label class="col-sm-2 col-form-label" for=readyFrom"">Готов от</label>
				<div class="col-sm-4">
					<input class="form-control" type="date" name="readyFrom" placeholder="Готов от">
				</div>
				
				<label class="col-sm-2 col-form-label" for="readyTo">Готов до</label>
				<div class="col-sm-4">
					<input class="form-control" type="date" name="readyTo" placeholder="Готов до">
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

			<label class="col-sm-2 col-form-label">Страна</label>
			<div class="col-sm-4">
				<select class="form-control" name="country" onchange="getRegionsWithAny(this.value)">
						<option value="Any">Any</option>
						@foreach ($countries as $country)
							<option value="{{$country->name}}">{{$country->name}}</option>
						@endforeach
				</select>
			</div>
			
			<label class="col-sm-2 col-form-label">Регион</label>
			<div class="col-sm-4">
				<select class="form-control" name="region" id="region" onchange="getCitiesWithAny(this.value)">
						<option value="Any">Any</option>
				</select>
			</div>
			</div>

			<div class="form-group row" >

				<label class="col-sm-2 col-form-label">Город</label>
				<div class="col-sm-4">
					<select name="city" class="form-control" id="city">
							<option value="Any">Any</option>

					</select>
				</div>

				
				<label class="col-sm-2 col-form-label">Ближайщий аэропорт</label>
				<div class="col-sm-4">
					<select name="nearestAirport" class="form-control" id="airport">
							<option value="Any">Any</option>

					</select>			
				</div>
			</div>

			<div class="form-group row">
				<label class="col-sm-2 col-form-label">Опыта в должности</label>
				<div class="col-sm-4">
					<select class="form-control" name="experience">
						<option value="Any">Any</option>
						@for ($exp_count = 1; $exp_count < 5; $exp_count++)
							<option value="{{$exp_count}}">{{$exp_count}}</option>
						@endfor
					</select>
				</div>
				<label class="col-sm-2 col-form-label">ID моряка</label>
				<div class="col-sm-4">
					<input class="form-control" name="sailorId" type="text">
				</div>
			</div>

			<label>Наличие визы  : США</label>
			<input type="checkbox" name="visaUSA" value="1">
			<label>  Шенген</label>
			<input type="checkbox" name="visaSchengen" value="2">
			

			<!--<label>Наличие визы</label>
			<select class="col-sm-3" name="visaType">
				<option value="Any">Any</option>
				@foreach ($visaTypes as $visaType)
					<option value="{{$visaType->id}}">{{$visaType->name}}</option>
				@endforeach
				<option value="All">Все перечисленные</option>
			</select>-->
		</fieldset>

			<div style="text-align: center;">
				<input class="btn" type="submit" value="Поиск" name="resumeForm">
				</div>
		
		<?Form::close();?>
</div>

	<div class="table form-margin">
	<table class=" table-striped table-bordered" style="position: relative;">
		<thead class="thead-light">
				<th><label>Id</label></th>
				<th><label>ФИО</label></th>
				<th><label>Дата рождения</label></th>
				<th><label>Должность</label></th>
				<th><label>Готовность</label></th>
				<th><label>Знание английского</label></th>
				<th><label>Мин. Зарплата</label></th>
		</thead>

		@foreach($resumes as $resume)
			<tr>
				<td>
					{{$resume->id}}
				</td>
				<td>
					<a href="/resume/{{$resume->idS}}">{!! $resume->surname . " " . $resume->name . " " . $resume->patronymic !!}</a>
				</td>
				<td>
					{{$resume->birthDate}}
				</td>
				<td>
					{{$resume->role}}
				</td>
				<td>
					{{$resume->availableDate}}
				</td>
				<td>
					{{$resume->englishLevel}}
				</td>
				<td>
					{{$resume->salary}}
				</td>
			</tr>
		@endforeach
	</table>
	</div>
		{{$resumes->links()}}
	
	
@endsection