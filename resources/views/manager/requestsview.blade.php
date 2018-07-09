@extends ('layouts.structure')

@section('content')
	<div class="form-pad ">
	<br>
	<hr>
	@foreach($reqs as $req)
		<div class="form-group justify-content-center row" >
				<label class="col-sm-1-2 col-form-label">Id User</label>
				<div class="col-sm-3">
					<input class="form-control center" value="{{$req->idUser}}" disabled type="text" >
				</div>
				
				<label class="col-sm-1-2 col-form-label" >User Group</label>
				<div class="col-sm-3">
					<input disabled value="{{$req->userGroup}}" class="form-control center" type="text" >
				</div>
			</div>
		<div class="form-group justify-content-center row">
			<textarea name="message" id="Additionalinfo" cols="60" rows="8" class="form-control" style="resize: none; margin-top: 30px" disabled >{{$req->message}}</textarea>
		</div>
		<br>
		<hr>
	@endforeach
	{{$reqs->links()}}
	</div>
@endsection