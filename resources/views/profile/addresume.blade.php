@extends ('layouts.structure')

@section('content')
		<?echo Form::open(['route' => '/profile/crt_resume','class' => 'form-pad', 'enctype' => 'multipart/form-data']); ?>
		<hr>
		<h3 class="center">Резюме</h3>
		<br>
		<div class="form-group row">
			<label for="role" class="col-sm-3 col-form-label">Должность</label>
			<div class="col-sm-8">
				<select class="form-control" name="role">
					@foreach ($roles as $role)
						<option value="{{$role->id}}">{{$role->name}}</option>
					@endforeach
				</select>
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
		<label for="availableDate" class="col-sm-3 col-form-label">Дата готовности</label>
		<div class="col-sm-8">
		<input class="form-control" type="date" name="availableDate" id="availableDate"><br>
		</div>
		</div>

		<div class="form-group row">
		<label for="salary" class="col-sm-3 col-form-label">Минимальная зарплата</label>
		<div class="col-sm-8">
		<input class="form-control" type="text" name="salary" id="salary"><br>
		</div>
		</div>

		<div class="form-group row">
			<label for="salary" class="col-sm-3 col-form-label">Фото</label>
			<div class="col-sm-8">
				<input class="form-control" type="file" accept="image/*" name="photo" id="salary"><br>
			</div>
		</div>
		<hr>
		<h4>Визы</h4>

		<br>
		<h6>USA Visa</h6>
		<p>Если визы нет - оставляйте пустыми поля</p>

		<table>
			<tbody class="form-control">
				<tr>
					<td><label >Номер визы</label></td>
					<td><label >Тип визы</label></td>
					<td><label >Годна до</label></td>
					<td><label >Скан визы</label></td>
				</tr>
				<tr>
					<td><input class="form-control" type="text" name="number_USA" id="number_USA"></td>
					<td><input class="form-control" type="text" name="type_USA" id="type_USA"></td>
					<td><input class="form-control" type="date" name="expiryDate_USA" id="expiryDate_USA"></td>
					<td><a class=" form-control btn" id="loadFile" onclick="document.getElementById('usa-visa').click();">Scan</a></td>
					<input class="form-control" id="usa-visa" style="display: none;" type="file" value="scan" name="scanName_USA" id="scanName_USA" accept="image/*">
				</tr>
			</tbody>
		</table>
		
		<br>
		<h6>Schengen Visa</h6>
		<p>Если визы нет - оставляйте пустыми поля</p>

		<table>
			<tbody class="form-control">
				<tr>
					<td><label >Номер визы</label></td>
					<td><label >Тип визы</label></td>
					<td><label >Годна до</label></td>
					<td><label >Скан визы</label></td>
				</tr>
				<tr>
					<td><input class="form-control" type="text" name="number_Schengen" id="number_Schengen"></td>
					<td><input class="form-control" type="text" name="type_Schengen" id="type_Schengen"></td>
					<td><input class="form-control" type="date" name="expiryDate_Schengen" id="expiryDate_Schengen"></td>
					<td><a class=" form-control btn" id="loadFile" onclick="document.getElementById('schengen').click();">Scan</a></td>
					<input class="form-control" id="schengen" style="display: none;" type="file" name="scanName_Schengen" id="scanName_Schengen" accept="image/*">
				</tr>
			</tbody>
		</table>
		<br><br>
		
		<hr>
		<h4>Паспорта</h4>

		<br>
		<h6>Гражданский паспорт</h6>
		
		<table class="form-control">
			<tr>
				<td><label >Код паспорта</label></td>
				<td><label >№ паспорта</label></td>
				<td><label >Место выдачи</label></td>
				<td><label >Годен до</label></td>
				<td><label >Скан паспорта</label></td>
			</tr>
			<tr>
				<td><input class="form-control" type="text" name="passCode_Civil" id="passCode_Civil"></td>
				<td><input class="form-control" type="text" name="passNum_Civil" id="passNum_Civil"></td>
				<td><input class="form-control" type="text" name="issuePlace_Civil" id="issuePlace_Civil"></td>
				<td><input class="form-control" type="date" name="expiryDate_Civil" disabled id="scanName_Civil"></td>
				<td><a class=" form-control btn" id="loadFile" onclick="document.getElementById('civil').click();">Scan</a></td>
				<input class="form-control" id="civil" style="display: none;" type="file" name="scanName_Civil" id="scanName_Civil" accept="image/*">
			</tr>
		</table>
		<br>
		<h6>Паспорт моряка</h6>
		<table class="form-control">
			<tr>
				<td><label >Код паспорта</label></td>
				<td><label >№ паспорта</label></td>
				<td><label >Место выдачи</label></td>
				<td><label >Годен до</label></td>
				<td><label >Скан паспорта</label></td>
			</tr>
			<tr>
				<td><input class="form-control" type="text" name="passCode_Sea" id="passCode_Sea"></td>
				<td><input class="form-control" type="text" name="passNum_Sea" id="passNum_Sea"></td>
				<td><input class="form-control" type="text" name="issuePlace_Sea" id="issuePlace_Sea"></td>
				<td><input class="form-control" type="date" name="expiryDate_Sea" id="scanName_Sea"></td>
				<td><a class=" form-control btn" id="loadFile" onclick="document.getElementById('sea').click();">Scan</a></td>
				<input class="form-control" id="sea" style="display: none;" type="file" name="scanName_Sea" id="scanName_Sea" accept="image/*">
			</tr>
		</table class="form-control">
		<br>
		<h6>Загранпаспорт</h6>
		<table class="form-control">
			<tr>
				<td><label >Код паспорта</label></td>
				<td><label >№ паспорта</label></td>
				<td><label >Место выдачи</label></td>
				<td><label >Годен до</label></td>
				<td><label >Скан паспорта</label></td>
			</tr>
			<tr>
				<td><input class="form-control" type="text" name="passCode_Tourist" id="passCode_Tourist"></td>
				<td><input class="form-control" type="text" name="passNum_Tourist" id="passNum_Tourist"></td>
				<td><input class="form-control" type="text" name="issuePlace_Tourist" id="issuePlace_Tourist"></td>
				<td><input class="form-control" type="date" name="expiryDate_Tourist" id="scanName_Tourist"></td>
				<td><a class=" form-control btn" id="loadFile" onclick="document.getElementById('tourist').click();">Scan</a></td>
				<input class="form-control" id="tourist" style="display: none;" type="file" name="scanName_Tourist" id="scanName_Tourist" accept="image/*">
			</tr>
		</table>
		<br>
		<hr>
		<h4>Сертификаты</h4>

		
		<table class="form-control" id="certif" cellpadding="5px">
		<tr>
			<td><label for="cType_1" >Тип сертификата</label></td>
			<td><label for="cNumber_1">№ сертификата</label></td>
			<td><label for="cIssuePlace_1">Место выдачи</label></td>
			<td><label for="cExpiryDate_1">Годен до</label></td>
			<td><label for="cScanName_1">Скан-копия</label></td>
		</tr>
		<tr>

			<td class="trcert">
				<input type="hidden" name="certif_ids[]" value="0" class="certId">
				<input type="text" name="cType_0" id="cType_0" class="form-control">
			</td>
			<td><input type="text" name="cNumber_0" id="cNumber_0" class="form-control"></td>
			<td><input type="text" name="cIssuePlace_0" id="cIssuePlace_0" class="form-control"></td>
			<td><input type="date" name="cExpiryDate_0" id="cExpiryDate_0" class="form-control"></td>
			<td><a class=" form-control btn" id="loadFile" onclick="document.getElementById('file_0').click();">Scan</a></td>
			<td><button onClick="delCertifRow(this)">Del</button>
			</td>
			<input type="file" id="file_0" style="display: none;" name="cScanName_0" id="cScanName_0" class="form-control" accept="image/*">
		</tr>
		
		</table>
		<br>
		<button type="button" class="btn" id="addcertif">Добавить Сертификат</button><br><br>

			
		<hr>
		<h4>Дополнительная информация</h4>
		<br>
		
		<div class="form-group row">
		<textarea name="Additionalinfo" id="Additionalinfo" cols="90" rows="10" style="resize: none;"></textarea>
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
			<input type="hidden" name="idSailor" value="{{$idSailor}}">
			<br>
		@endif
			
		<div style="text-align: right;">
		<input class="btn" type="submit" value="Добавить резюме" name="resumeForm">
		</div>
		<br>
		<br>
		<br>
		
	<?Form::close();?>
@endsection