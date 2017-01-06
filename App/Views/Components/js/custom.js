$(document).ready(function(){ 


	 $("#datepicker").datepicker();

	$("#enviar").click(function() {
		$.ajax({
			url : 'Admin/prueba',
		    data : {"var" : "1"},
		    type : 'POST',		 
		    success : function(data) {
		    	console.log(data);
		    },
		 	error : function(xhr, status) {
		        alert('Disculpe, hubo un problema ');
		    },
		});	
	});

	$('#SignupCountry').change(function() {
		$.ajax({
			beforeSend: function(){
				$("#SignupCity").html('<option value="">Loading..</option>');
			},
			url : 'Country/ajax_getCityByCountry',
		    data : {"country" : $(this).val()},
		    type : 'POST',		 
		    success : function(rsp) {
		    	//console.log(rsp);

		    	var content = '';
		    	var isJson = true;
		    	try {
			        data = JSON.parse(rsp);
			    } catch (e) {
			        isJson = false;
			    }
			    if (isJson) {
			    	if (data.response == true) {
			    		//console.log(data);
			    		$("#SignupCity").html('<option value="">-Select a City-</option>');
			    		for (var i = data.cities.length - 1; i >= 0; i--) {
			    			$("#SignupCity").append('<option value="'+data.cities[i]['ID']+'">'+data.cities[i]['Name']+'</option>');
			    		}
						content += '<div class="alert alert-success text-center" role="alert">';
						content += '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
						content += data.msg;
						content += '</div>';
			    		$('#alert-signup').html(content);
			    		//location.reload();
			    	} else if (data.response == false) {
			    		//console.log(data.msg);
			    		content += '<div class="alert alert-danger text-center" role="alert">';
						content += '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
						content += data.msg;
						content += '</div>';
			    		$('#alert-signup').html(content);
			    	} else {
			    		//console.log('Error desconocido');
			    		content += '<div class="alert alert-danger text-center" role="alert">';
						content += '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
						content += 'Error';
						content += '</div>';
			    		$('#alert-signup').html(content);
			    	}
			    } else {
			    	console.log(e);
			    }
		    },
		 	error : function(xhr, status) {
		        alert('Disculpe, hubo un problema ');
		    },
		});
	});

	$('#formLogin').submit(function(e) {
		e.preventDefault();
		$.ajax({
			beforeSend: function() {
				//Code
			},
			url : 'User/ajax_login',
		    data : $(this).serialize(),
		    type : 'POST',		 
		    success : function(data) {
		    	console.log(data);
		    	var content = ''
		    	var isJson = true;
		    	try {
			        data = JSON.parse(data);
			    } catch (e) {
			        isJson = false;
			    }
			    if (isJson) {
			    	if (data.response == true) {
			    		//console.log(data.User);
						content += '<div class="alert alert-success text-center" role="alert">';
						content += '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
						content += data.msg;
						content += '</div>';
			    		$('#alert-login').html(content);
			    		location.reload();
			    	} else if (data.response == false) {
			    		//console.log(data.msg);
			    		content += '<div class="alert alert-danger text-center" role="alert">';
						content += '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
						content += data.msg;
						content += '</div>';
			    		$('#alert-login').html(content);
			    	} else {
			    		//console.log('Error desconocido');
			    		content += '<div class="alert alert-danger text-center" role="alert">';
						content += '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
						content += 'Error';
						content += '</div>';
			    		$('#alert-login').html(content);
			    	}
			    } else {
			    	console.log(e);
			    }
		    	
		    },
		 	error : function(xhr, status) {
		        alert('Disculpe, hubo un problema ');
		    },
		});	
		//return false;
	});

	$('#formSignup').submit(function(e) {
		e.preventDefault();
		$.ajax({
			beforeSend: function() {
				//Code
			},
			url : 'User/ajax_signup',
		    data : $(this).serialize(),
		    type : 'POST',		 
		    success : function(data) {
		    	console.log(data);
		    	var content = '';
		    	var isJson = true;
		    	try {
			        data = JSON.parse(data);
			    } catch (e) {
			        isJson = false;
			    }
			    if (isJson) {
			    	if (data.response == true) {
			    		//console.log(data.User);
						content += '<div class="alert alert-success text-center" role="alert">';
						content += '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
						content += data.msg;
						content += '</div>';
			    		$('#alert-signup').html(content);
			    		location.reload();
			    	} else if (data.response == false) {
			    		//console.log(data.msg);
			    		content += '<div class="alert alert-danger text-center" role="alert">';
						content += '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
						content += data.msg;
						content += '</div>';
			    		$('#alert-signup').html(content);
			    	} else {
			    		//console.log('Error desconocido');
			    		content += '<div class="alert alert-danger text-center" role="alert">';
						content += '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
						content += 'Error';
						content += '</div>';
			    		$('#alert-signup').html(content);
			    	}
			    } else {
			    	console.log(e);
			    }
		    	
		    },
		 	error : function(xhr, status) {
		        alert('Disculpe, hubo un problema ');
		    },
		});	
		//return false;
	});

	$('#formAddBounty').submit(function(e) {
		e.preventDefault();
		$.ajax({
			beforeSend: function() {
				//Code
			},
			url : 'Bounty/ajax_add',
		    data : $(this).serialize(),
		    type : 'POST',		 
		    success : function(data) {
		    	//console.log(data);
		    	var content = '';
		    	var isJson = true;
		    	try {
			        data = JSON.parse(data);
			    } catch (e) {
			        isJson = false;
			    }
			    if (isJson) {
			    	if (data.response == true) {
			    		//console.log(data.User);
						content += '<div class="alert alert-success text-center" role="alert">';
						content += '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
						content += data.msg;
						content += '</div>';
			    		$('#alert-addBounty').html(content);
			    		location.reload();
			    	} else if (data.response == false) {
			    		//console.log(data.msg);
			    		content += '<div class="alert alert-danger text-center" role="alert">';
						content += '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
						content += data.msg;
						content += '</div>';
			    		$('#alert-addBounty').html(content);
			    	} else {
			    		//console.log('Error desconocido');
			    		content += '<div class="alert alert-danger text-center" role="alert">';
						content += '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
						content += 'Error';
						content += '</div>';
			    		$('#alert-addBounty').html(content);
			    	}
			    } else {
			    	console.log(e);
			    }
		    	
		    },
		 	error : function(xhr, status) {
		        alert('Disculpe, hubo un problema ');
		    },
		});	
		//return false;
	});

});