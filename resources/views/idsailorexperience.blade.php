@extends ('layouts.structure')

@section('content')
<!--Experience -->
<?echo Form::open(['route' => '/profile/crt_experience']); ?>
		<input type="text" name="idSailor" value="">
			<br>
		<div style="text-align: right;">
				<input class="btn" type="submit" value="Поиск" name="resumeForm">
				</div>
		
		<?Form::close();?>
@endsection