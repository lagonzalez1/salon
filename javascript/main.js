

$(document).ready(function(){
	$('#closed').remove();
});

$(function(){
    $('#about').on('click', function(){
        $('#about_modal').modal('toggle');
    });
    $('#help').on('click', function(){
        $('#help_modal').modal('toggle');
    });
});


$(document).ready(function (){
	$('#work1').on('click', function(){
		var path = "model_hair";
		var extention = "h_";
		load_images(path, extention);
	});
	$('#work2').on('click', function(){
		var path = "model_color";
		var extention = "c_";
		load_images(path, extention);
	});

	$('#work3').on('click', function() {
		var path = "model_nails";
		var extention = "n_";
		load_images(path, extention);
	});

	$('#work4').on('click', function() {
		var path = "model_style";
		var extention = "s_";
		load_images(path, extention);
	});
});

// Load images based on max of 4
// Given, Path & extention assume : jpg
function load_images(path, ext, title){
	var SIZE = 4;
	var iter = 1;
	for(i =0 ; i < SIZE;  i++){
		var id = (i + 1).toString();
		var pathToCheck = "/salon/static/img/"+path+"/"+ext+i+".jpg";
		if(!UrlExists(pathToCheck)){
			document.getElementById(id).src = "/salon/static/img/not_found.jpg";
		}else{
			document.getElementById(id).src = pathToCheck;
		}
	}
	document.getElementById("title").innerHTML = title;
	$("#picture_modal").modal('show');
}


// Retuns Boolean: True-> 200 
// Code cleanup : Switch case!
function UrlExists(url) {
    var http = new XMLHttpRequest();
    http.open('HEAD', url, false);
    http.send();
    if(http.status == 404){
    	return false;
    }else if(http.status == 200){
    	return true;
    }else{
    	return false;
    }
    return false;
}

function clearField() {
	$('#show_data').collapse('hide');
	$('check_app_cancell').val('');
}

$(document).ready(function(){
	$('#submitButton').on('click', function() {
		// get input box on click
		// make request
		var em = $('#check_app_cancell').val();
		console.log(em);
		make_request(em);
	});

	$('#remove_me').on('click', function (){
		var rem_emm = $("#i-email").text();
		var final_string = rem_emm.replace('Email: ','');
		console.log(final_string);
		remove_based_email(final_string);
	});
});



function remove_based_email(email){
	var xhr = $.ajax({
	type:'POST',
	url:'handle_clients.php',
	timeout: 10000,
	data:{'email': email},
	success: function(rdata) {
		console.log(rdata);
		if(rdata == "YES"){
			$('#show_data').collapse('toggle');
			$('#check_existing').modal('toggle');
			show_modal("Removal Success", "You have successfully removed yourself from the appointment line. Thanks have a good day!");
		}else {
			console.log("Err");
			$('#show_data').collapse('toggle');
			$('#check_existing').modal('toggle');
			show_modal("Fatal Error", "We where not able to remove you from the line, please try later");
		}
	}, 
	error: function(err, code) {
		console.log(err);
		console.log(code);
		$('#time_out').modal('toggle');
		
		
	}
});	
}

function make_request(user_email){
	var xhr = $.ajax({
	type:'POST',
	url:'handle_clients.php',
	timeout: 10000,
	dataType: 'json',
	data:{'user_email':user_email },
	success: function(rdata) {
		if(rdata["responseText"] == "Not Found"){
			$('#check_existing').modal('toggle');
			show_modal("Cannot Be found", "The email used cannot be found in our system. Tip: this field is case sensitive so be exact!");
			xhr.abort();
		}else if(rdata["responseText"] == "SQL:Error"){
			console.log('Fatal');
			$('#check_existing').modal('toggle');
			show_modal("Cannot Be found", "SQL Error was found. Please reload the page or call the buisness number to check your appointment manualy.");
			xhr.abort();
		}else if(rdata["responseText"] == "Error Fatal"){
			console.log('Rows');
			$('#check_existing').modal('toggle');
			show_modal("Cannot Be found", "Error Fatal");	
			xhr.abort();
		}else {
			load_data(rdata);
		}
	}, 
	error: function(err, code, dd) {
		console.log(err);
		console.log(code);
		console.log(dd);
		
	}
});	
}


function load_data(rdata){
	document.getElementById('i-name').innerHTML = 'Name: ' + rdata['Name'];
	document.getElementById('i-time').innerHTML = 'Time: ' + rdata['App_Time'];
	document.getElementById('i-date').innerHTML = 'Date: ' +rdata['App_Date'];
	document.getElementById('i-stylist').innerHTML = 'Stylist: ' +rdata['Per_stylist'];
	document.getElementById('i-email').innerHTML = 'Email: ' +rdata['Email'];
	$('#show_data').collapse('toggle');
}

function cancell_click(){
	$(document).ready(function(){
		$('#check_existing').modal('toggle');
	});
}

function refreshPage() {
	location.assign("main.php");
	return false;

}
    // Max Dates allowed up to 2 weeks and 5 days
$(document).ready(function() {
	$('#calendar').datepicker({
		beforeShowDay: nonWorkingDates,
		numberOfMonths: 1,
		minDate: '0',
		maxDate: '2w+5d',
		firstDay: 1
		
	});

});
   

// You need to make the button smaller, to large to fit 
var time = null;
function add(id) {
  //Create an input type dynamically.   
  var element = document.createElement("Button");
  //Assign different attributes to the element. 
  element.type = "radio";
  element.value = id; // Really? You want the default value to be the type string?
  element.name = id; // And the name too?
  element.innerHTML = id;
  element.className = "btn btn-primary";
  element.onclick = function() { // Note this is a function
   	document.getElementById("time").value = element.name;
  };


  var avaiable_times_div = document.getElementById("available_times");
  //Append the element in page (in span).  
  avaiable_times_div.appendChild(element);
}


function remove_leftover(){
	const node = document.getElementById("available_times");
	while(node.firstChild){
		node.removeChild(node.lastChild);
	}
}



    $(document).ready(function(){
    	$('#check_tm').on('click', function() {
    		remove_leftover();
    		var date = $('#calendar').val();
    		var stls = $('#employee-id').val();
    		document.getElementById("av_title").innerHTML = "All Available Times For " + stls;
    		if(date == "" || stls == "None"){
    			$('#instructions').modal('toggle');			
    		}else{
    			var date = $('#calendar').val();
    			var stls = $('#employee-id').val();
    			var xhr = $.ajax({
    				type:'POST',
        			url:'check_av_times.php',
        			timeout: 10000,
        			dataType: 'json',
        			data:{'date': date, 'empl': stls},
        			success: function(rdata) {
						for (i = 0 ; i < rdata.length; i++){
							console.log(rdata[i]);
        					add(rdata[i]);
        				}
						console.log(rdata);
						$('#check_av_times').collapse('toggle');  
        			}, 
        			error: function(err, code) {
        				console.log(err);
        				console.log(code);
						$('#time_out').modal('toggle');
						
        				
        			}
    			});	
    		}	
    	});
    });
    $('#check_av_times').on('show.bs.collapse', function () {

	});
    function isEmpty(str) {
    	return (!str || 0 === str.length);
	}
     function nonWorkingDates(date){
        var day = date.getDay(), Sunday = 0, Monday = 1, Tuesday = 2, Wednesday = 3, Thursday = 4, Friday = 5, Saturday = 6;
        var closedDates = [[8, 5, 2009], [8, 25, 2010]]; // This can be used for Holidays
        var closedDays = [[Saturday]];
        for (var i = 0; i < closedDays.length; i++) {
            if (day == closedDays[i][0]) {
                return [false];
            }
        }
        for (i = 0; i < closedDates.length; i++) {
            if (date.getMonth() == closedDates[i][0] - 1 &&
            date.getDate() == closedDates[i][1] &&
            date.getFullYear() == closedDates[i][2]) {
                return [false];
            }
        }
        return [true];
    }


function send_message(){
	$('#send_message').modal('toggle');
	$('#send_message_btn').on('click', function(){
		const cc_email = "lag.webservices@gmail.com"; 
		var send_message = 'send_message';
		var email = $('#email_send').val();
		var body = $('#body_message').val();

		if(email  == "" && body == ""){
			return;
		}else{
			var aj = $.ajax({
			type: 'GET',
			url: 'handle_clients.php',
			data: {'send_message':send_message,
					email: email,
					body: body,
			},
			timeout: 10000,
		success: function(data){
			switch(data){
				case 'Send Succesfull':
					console.log('Sent!');
				break;
				case 'E String':
					console.log('Sent Empty String!')
				break;

				case 'Error: Sending':
					console.log('Sent Error!')
				break;

				case 'Func Fail':
					console.log('Func Fail!')
				break;

				default:
					console.log('Default!')
					break;
			}

			// Handle data send back Aug 14 2020

		},
		error: function(id, er, ll){
			console.log(id + er + ll);
		}
		});
		}		
	});

}

function show_modal(title,body){
  document.getElementById('title_config_err').innerHTML = title;
  document.getElementById('body_config_err').innerHTML = body;
  $("#configure_modal").modal("toggle");
}   