@extends ('layouts.structure')

@section('content')
	<div class="form-pad">
		<br>
		
		<h2 class="center">Контакты</h2>
		<br>
		<hr>
		<br>
		<div class="row">
			<div class="col-md-4 center">
				<h3>Телефоны</h3>
				<input type="text" disabled value="+380678744998" style="text-align: inherit;">

			</div>
			<div class="col-md-4 center">
				<h3>Почта</h3>
				<input type="text" disabled value="yablochniy@bog.ryk" style="text-align: inherit;">

			</div>
			<div class="col-md-4 center">
				<h3>Адрес</h3>
				<input type="text" disabled value="Groove Street 51" style="text-align: inherit;">

			</div>
		</div>
		<br>
		    <div id="map" style="width: 100%;height: 400px; border: 2px solid #ccc;"></div>
			    <script>
			      var map;
			      function initMap() {
			      	var uluru = {lat: 44.595, lng: 33.4758};
			        map = new google.maps.Map(document.getElementById('map'), {
			          center: {lat: 44.595, lng: 33.4758},
			          zoom: 15
			        });
			        var marker = new google.maps.Marker({
					  position: uluru,
					  map: map
					});
			      }
			    </script>
			    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDDm8RBQwP5Nxl2ZYzb-fYhrUKIS2beZ0s&callback=initMap"
		   	async defer></script>
	</div>

@endsection
