function delCertifRow(buttonRow){
	var raw = buttonRow.parentNode.parentNode;
	raw.parentNode.removeChild(raw);
}

$('document').ready(function(){

	$('body').niceScroll({cursorborder:""});

	$('nicescroll-cursors').css('border','transparent');

	$.ajaxSetup({
		headers:{
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});
	//$('#addcertifSearch').$('#addcertif').on('click',function(){
	//	var countOfRows = $('.cert').length;

	//	$('#certif').append('');
	//});

	$('#addcertif').on('click',function(){
		var countOfRows = $('.trcert').length;
		$('#certif').append('<tr class="trcert"><td><input type="hidden" value="'+countOfRows+'" name="certif_ids[]" class="certId"><input type="text" name="cType_'+countOfRows+'" id="cType_1" class="form-control"></td><td><input type="text" name="cNumber_'+countOfRows+'" id="cNumber_1" class="form-control"></td><td><input type="text" name="cIssuePlace_'+countOfRows+'" id="cIssuePlace_1" class="form-control"></td><td><input type="date" name="cExpiryDate_'+countOfRows+'" id="cExpiryDate_1" class="form-control"></td><td><a class=" form-control btn" id="loadFile" onclick="document.getElementById(\'file_'+countOfRows+'\').click();">Scan</a><input type="file" id="file_'+countOfRows+'" style="display: none;" name="cScanName_'+countOfRows+'" id="cScanName_'+countOfRows+'" class="form-control" accept="image/*"><td><button onClick="delCertifRow(this)">Del</button></td></tr>');
	});
})


function getRegions(countryName){

	 $.ajax({
	  type:'POST',
	  url:'/getRegions',
	  dataType : 'json',
	  data:{ 'countryName' : countryName },
	  success:function(regions){
	  	   $('#region').find('option').remove().end();
		   $.each(regions, function(i, item){
		   	    $('#region').append('<option value="'+item.name+'">'+item.name+'</option>');
		   })
		   getCities($('#region').val());
  		},

 	}); 
	
}

function getCities(regionName){

	 $.ajax({
	  type:'POST',
	  url:'/getCities',
	  dataType : 'json',
	  data:{ 'regionName' : regionName },
	  success:function(cities){
	  	   $('#city').find('option').remove().end();
	  	   $('#airport').find('option').remove().end();
		   $.each	(cities, function(i, item){
		   	    $('#city').append('<option value="'+item.name+'">'+item.name+'</option>');
		   	    $('#airport').append('<option value="'+item.name+'">'+item.name+'</option>');
		   })
  		},

 	});
}

function getRegionsWithAny(countryName){
	if(countryName == "Any"){
		$('#region').append('<option value="Any">Any</option>');
		getCities($('#region').val());
		return;
	}
	 $.ajax({
	  type:'POST',
	  url:'/getRegions',
	  dataType : 'json',
	  data:{ 'countryName' : countryName },
	  success:function(regions){
	  	   $('#region').find('option').remove().end();
	  	   $('#region').append('<option value="Any">Any</option>');
	  	   $('#region').val("Any");
		   $.each(regions, function(i, item){
		   	    $('#region').append('<option value="'+item.name+'">'+item.name+'</option>');
		   })
		   getCitiesWithAny($('#region').val());
  		},

 	}); 
	
}

function getCitiesWithAny(regionName){
	if(regionName == "Any"){
		$('#city').append('<option value="Any">Any</option>');
	  	$('#airport').append('<option value="Any">Any</option>');
		return;
	}
	 $.ajax({
	  type:'POST',
	  url:'/getCities',
	  dataType : 'json',
	  data:{ 'regionName' : regionName },
	  success:function(cities){
	  	   $('#city').find('option').remove().end();
	  	   $('#airport').find('option').remove().end();
	  	   $('#city').append('<option value="Any">Any</option>');
	  	   $('#airport').append('<option value="Any">Any</option>');
	  	   $('#city').val("Any");
	  	   $('#airport').val("Any");
		   $.each	(cities, function(i, item){
		   	    $('#city').append('<option value="'+item.name+'">'+item.name+'</option>');
		   	    $('#airport').append('<option value="'+item.name+'">'+item.name+'</option>');
		   })
  		},

 	});
}

