<?php

// 1. Added check in feature
// 2. We need to find a way to update all tables
// 3. *Important to be able to scale up or down* EX: Depedning on how many employees
// 4. empl1  empl2  empl3   empl4
//    person person preson person
// 5. Check glitch in the morning, For some reason it didnt want to show times early in the morning for a current dates
$lifetime = strtotime('+4 hours', 0);
session_set_cookie_params($lifetime);

session_start();
if(!isset($_SESSION['user-login-success'])){
	header('Location: main.php');
  die();
}
include('server_connect.php');

	$stmt = "SELECT * FROM `client_upgrade` ORDER BY `App_Time` DESC;";
	$result = mysqli_query($connection , $stmt);

  date_default_timezone_set("America/Los_Angeles");
  $current_date = date("m/d/o");

?>

<!DOCTYPE html>
<html>
<head>
  
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>   
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
	<script src="https://use.fontawesome.com/releases/v5.0.8/js/all.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-bootgrid/1.3.1/jquery.bootgrid.min.js"></script>             
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-bootgrid/1.3.1/jquery.bootgrid.css" />

  <link href="/salon/static/user_main_interface_style.css" rel="stylesheet">

</head>

<?php
	function exit_user() {
    $_SESSION=array();
    unset($_SESSION);
		session_destroy();
    header('Location: user_login_page.php');
    exit();
	}
	if(isset($_GET['logout_click'] )){
		exit_user();
		exit();
	}
  if(isset($_GET['email_match'])){
    echo'<script type="text/javascript">
        $(function() {
          $("#err_mail").modal("show");
         });

        </script>';
  }

  if(isset($_GET['fatal_err'])){
    echo'<script type="text/javascript">
        $(function() {
          document.getElementById("exampleModalLabel").innerHTML = "Fatal Error: Adding client";
          document.getElementById("body_err").innerHTML = "Try login out and login back in.";
          $("#err_mail").modal("show");
         });

        </script>';
  }
?>


<div class="modal fade" id="err_mail" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Email Conflict</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id = "body_err">
       <mark>Email entered is already in the list.</mark> Please either remove the client from the list or use a different email.
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>


<body>
  <nav class = "navbar navbar-expand-md navbar-light bg-light sticky-top">
  	<div class="container-fluid">
  	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive">
  		<span class="navbar-toggler-icon"> </span>
  	</button>
  	<div class="collapse navbar-collapse" id ="navbarResponsive">
  		<ul class="navbar-nav ml-auto">
  			<li class="nav-item">
  				<a class="nav-link" href= "user_interface_main.php?logout_click=true" style = "color: #787B7C">Log out</a>
  			</li>
        <li class="nav-item">
          <a class="nav-link" href= "user_interface_main.php" style = "color: #787B7C">Reload Page</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" name="all_app" onclick="return showAllAppointments();">All Appointments</a>
        </li>
  			<li class="nav-item">
  				<a class="nav-link" id="help">Help</a>
  			</li>
  		</ul>
  	</div>
  	</div>
  </nav>

  <div class="jumbotron"> <?php
    date_default_timezone_set('America/Los_Angeles');
    $today = date("N");
    $date = date("l");
    $current_date = date("l, M-d-Y");

    echo '<h1 class="display-4" style = "color: #FFFFFF">Hello, Showing Today&#39s Appointments.</h1>
     <h2 class = "display-6" style = "color: #FFFFFF"> '.$current_date.'</h2>
      ';
  ?>
</div>


<div class="modal fade" id="showAllAppointments" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">All Appointments</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id = "body">
      <table class="table table-sm">
	      <thead class="thead-light">
          <tr>
            <th scope="col">#</th>
            <th scope="col">Stylist</th>
            <th scope="col">Name</th>
            <th scope="col">Phone Number</th>
            <th scope="col">Email</th>
            <th scope="col">Time</th>
            <th scope="col">Date</th>
          </tr>
	      </thead>
	    <tbody>

	  </tbody>
    </table>
       
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>


<!-- Handle client side removals and Check -->
<!-- Also attemt to reload the service -->
<script type="text/javascript">


function showAllAppointments(){
  var xhr = $.ajax({
    type: 'POST',
    url: 'refresh_all_table.php',
    timeout: 10000,
    data: {'all_app_view':'all_app_view'},
    success: function(htmlRes){
      if(htmlRes == "Result: Error"){
        $("#timeout_error").modal("show");
      }
      $('#showAllAppointments').modal('toggle');
      $('#showAllAppointments').find('tbody').html(htmlRes);
      console.log('Reloading All Appointments Modal');
    },
    error: function(err,id){
      console.log(err);
      console.log(id);
      $("#timeout_error").modal("show");
    }
  });
}

// Reload Button Click
// Reloads Current Table
$(function() {
    var value = 'value';
    $(document).on('click', '.reload', function(){
        reload_table();
    });
});

function reload_table() {
     var init_req = $.ajax({
        type:'POST',
        url:'refresh_all_table.php',
        timeout: 10000,
        data:{'initial_launch':'initial_launch'},
          success: function(responce){
              $('#s_0').find('tbody').html(responce);
              console.log("Reload Success");
        },
          error: function(err, id){
            console.log(err);
            console.log(id);
          $("#timeout_error").modal("show");
        }
  });
     var second_table = $.ajax({
        type:'POST',
        url:'general_table.php',
        timeout: 10000,
        data:{'initial_launch':'initial_launch'},
          success: function(responce){
              $('#s_1').find('tbody').html(responce);
              console.log("second table refresh");
        },
          error: function(err, id){
            console.log(err);
            console.log(id);
            console.log("Second table Fail reload");
          $("#timeout_error").modal("show");
        }
  });
}


// 1 min = 60000
// 3 min = 180000
// 5 min = 300000
$(function() {
  $("#holder :input").change(function() {
    switch(this.id){
      case "option1":
        var increment = 60000;
        setInterval(function() {reload_table(); }, increment);
        break;
      case "option2":
        var increment = 180000;
        setInterval(function() {reload_table(); }, increment);
      break;
        case "option3":
        var increment = 300000;
        setInterval(function() {reload_table(); }, increment);
      break;
    }

  });
});


$('#help').on('click', function(){
        $('#help_modal').modal('toggle');
  });


$(document).ready(function() {
    reload_table();
});

$(function(){
    $(document).on('click','.remove',function(){
      var del_id= $(this).attr('id');
      var $ele = $(this).parent().parent();
      $.ajax({
        type:'POST',
        url:'handle_clients.php',
        timeout: 10000,
        data:{'del_id':del_id},
        success: function(responce){
          	if(responce == "YES"){
          		//$ele.closest("tr").remove();
          		$ele.closest('tr').css('background','#ff2b2b');
          		$ele.closest('tr').find('td').fadeOut(1000,function(){
              $ele.remove();
            });
            reload_table();
          	}else if (responce == "Update Error"){
          		console.log("Error, PHP not able to add to remove or recived something other than YES");
          	} 
         },
         error: function(){
          $("#timeout_error").modal("show");
        }
      });
    });
});
// Need to work on this once Server is live.
$(function () {
  $(document).on('click', '.email_send', function() {
    var cc_id = $(this).attr('id');
    console.log(cc_id);
    $.ajax({
      type: 'POST',
      timeout: 10000,
      url: 'handle_clients.php',
      data: {'cc_id': cc_id },
      success: function (responce) {

          if(responce == "Error: Email is empty"){
            show_modal("Error", "Email Is empty! Try another source of contact");
            console.log("Email Empty");
          }else if (responce == "Success: SMS & Email") {
            console.log("SMS && Email");
            $("#email_send_modal").modal("show");
          } else if (responce == "Success: SMS"){
              console.log("SMS");
              $("#email_send_modal").modal("show");
          }else if(responce == "Success: Email"){
              console.log("Email");
              $("#email_send_modal").modal("show");
          }else {
            console.log(responce);
          }

      }, error: function(err, id){
        console.log(err);
        console.log(id);

      }
    });
  });

});

$(function(){
    $(document).on('click','.check',function(){
      var check_in = $(this).attr('id');
      var $ele = $(this).parent().parent();

      console.log(check_in);
      $.ajax({
        type:'POST',
        url:'handle_clients.php',
        timeout: 10000,
        data:{'check_in':check_in},
        success: function(responce){
          	if(responce == "Success"){
          		$ele.closest("tr").remove();
          		$ele.closest('tr').find('td').fadeIn(1000, function(){
          		});
              reload_table();
          	}else if(responce == "Update Error"){
          		console.log("Update Error");
              show_modal("Update Error","Query to update status failed, try reloading the page and try again.");
          	}
         },
         error: function(){
          $("#timeout_error").modal("show");
      }
        });
    });
});


// Check if DB is correct by date.
// Modal shows if clients have been removed.
// Imporovement:: show the list of removed users incase user want to keep them or add them.
$(document).ready(function(){
  var db_check = "db_check";
  var xhr = $.ajax({
    type: 'POST',
    timeout: 10000,
    url:"handle_clients.php",
    data: {'db_check':db_check},
    success:function (response){

      switch(response){
        case 'Success':
          console.log(response);
          console.log("DB CHECK: cleaned");
          show_modal("Database cleanup", "We removed clients who remained in the list overnight.");
          reload_table();
          break;
        case 'Success: No Changes':
          console.log("No Changes");
          reload_table();
          break;
        case 'Error: query':
          show_modal("Database Cleanup", "Query Error Fatal");
          reload_table();
          break;
        case 'Error: Rows less than 0':
          console.log("Error: Rows less than 0");
          break;
        case 'Error: DB ':
          console.log('Error: DB');
          break;
          default:
          console.log('Error: DB Defualt');
          break;

      }
    },
    error:function(error){
      console.log("db_check Error");
      console.log(error);
      show_modal("Database cleanup", "Fatal error removing past clients.");
    }
  });
});


$(function(){
  $(document).on('click','.change_time', function(){
    show_modal('New Feature', 'The feature you have selected has not yet been added. Please wait for future updates.');
  });
});

function show_modal(title,body){
  document.getElementById('title_config').innerHTML = title;
  document.getElementById('body_config').innerHTML = body;
  $("#configure_modal").modal("toggle");
}
</script>


<div class="modal fade" id="help_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
        </div>
        <div class="modal-body" id = "body_err">
            <p class="header text-center">Salon Help</p>
            <p class="sub_header text-center">If you need help with salon services please feel free to call the establishment via: 909-XXX-XXXX.</p>
            <hr class="hr">
            <p class="header text-center">Website Help</p>
            <p class="sub_header text-center">If you need help with anything related to this website, please feel free to email use at: lag.webservices@gmail.com</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
</div>


<div class="modal fade" id="configure_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="title_config">Refresh Error</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id= "body_config">
        Looks like we have a timeout error, please check if you are connected to the internet. Or try to refresh the entire page.
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="timeout_error" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Refresh Error</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Looks like we have a timeout error, please check if you are connected to the internet. Or try to refresh the entire page.
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>



<div class="modal fade" id="email_send_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Email Sent!</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Email succesfull sent to client.
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>


<!-- interface_request.php method called to complete tast -->
<div class="modal fade" id="add_new_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Walk-in Appointment</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action ="interface_request.php" method= "post">
          <div class="form-group">
            <label for="recipient-name" class="control-label">Name:</label>
            <input type="text" class="form-control" id="client-name" name ="client-name" required>
          </div>
          <div class="form-group">
            <label for="recipient-name" class="control-label">Email</label>
            <input type="text" class="form-control" id="client-email" name="client-email" required>
          </div>
          <div class="form-group">
            <label for="recipient-name" class="control-label">Phone Number</label>
            <input type="phone-number" class="form-control" id="client-phone" name ="client-phone" required>
          </div>  

      </div>
    
      <div class="modal-footer">
        <input type="button" class="btn btn-secondary" data-dismiss="modal" value = "Close">
        <input type="submit" value= "Confirm Appointment" name = "clicked" class = "btn btn-primary">
      </div>
      </form>
    </div>
  </div>
  </div>
</div>


<div class = "button-holder" id = "holder">
<button class = "reload btn btn-info" id = "reload" name = "refresh">Refresh Table</button>
<button class = "add_new btn btn-info" id = "add_new" data-target="#add_new_modal" data-toggle="modal">Add New Client</button>
<div class="btn-group btn-group-toggle" data-toggle="buttons">
  <label class="btn btn-secondary">
    <input type="radio" name="options" id="option1" autocomplete="off"> 1 Min
  </label>
  <label class="btn btn-secondary">
    <input type="radio" name="options" id="option2" autocomplete="off"> 3 Min
  </label>
  <label class="btn btn-secondary">
    <input type="radio" name="options" id="option3" autocomplete="off"> 5 Min
  </label>
</div>
</div>



<hr class="hr">
<div class="container-fluid">
  <h4 class="small_title">Scheduled Appoinments</h4>
</div>
<hr class="hr">
<div class="container-fluid" id = "s_0">
	<table class="table table-hover table-bordered table">
	  <thead class="thead-light">
	    <tr>
	      <th scope="col">#</th>
        <th scope="col">Stylist</th>
	      <th scope="col">Name</th>
	      <th scope="col">Phone Number</th>
        <th scope="col">Time</th>
        <th scope="col">Date</th>
        <th scope="col">Status</th>
        <th scope="col">Actions</th>
	    </tr>
	  </thead>
	  <tbody>
	  </tbody>
</table>
</div>

<hr class="hr">
<div class="container-fluid">
  <h4 class="small_title">Walkin General Line</h4>
</div>
<hr class="hr">


<div class="container-fluid" id = "s_1">
  <table class="table table-hover table-bordered table">
    <thead class="thead-light">
      <tr>
        <th scope="col">#</th>
        <th scope="col">Stylist</th>
        <th scope="col">Name</th>
        <th scope="col">Phone Number</th>
        <th scope="col">Time</th>
        <th scope="col">Date</th>
        <th scope="col">Status</th>
        <th scope="col">Actions</th>
      </tr>
    </thead>
    <tbody>

    </tbody>
</table>
</div>



</body>


</html>
