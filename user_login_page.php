<?php 

date_default_timezone_set("America/Los_Angeles");
$current_date = date("m/d/o");


?>


<!DOCTYPE html>
<html>
<head>


<!------ Errors can inclue not using Jquery first, Therfore Jquery then bootstrap ---------->
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-bootgrid/1.3.1/jquery.bootgrid.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-bootgrid/1.3.1/jquery.bootgrid.css" />  
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

<link href="/salon/static/user_login_page_style.css" rel="stylesheet" type="text/css">
<!------ Include the above in your HEAD tag ---------->

</head>

<?php

if(isset($_GET['user_not_found'])){
  echo '<script type="text/javascript">
		$(document).ready(function() {
			$("#loginError").modal("show");
		});
    </script>';
}



if(isset($_GET['db_error'])){
  echo '<script type="text/javascript">
		$(document).ready(function() {
			$("#db_error").modal("show");
		});
    </script>';
}


?>

<div class="modal fade" id="db_error" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Trouble Connecting to database</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="refreshPage();">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id = "body_err">
	    Please try again later. If problem continues please call webprovider via lag.webservices@gmail.com.
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal" onclick="refreshPage();">Close</button>
      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="loginError" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Login Error</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="refreshPage();">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id = "body_err">
	    Please try again. Wrong email or password.      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal" onclick="refreshPage();">Close</button>
      </div>
    </div>
  </div>
</div>

<script type="javascript/user_login_page.js">
</script>



<div class="wrapper fadeInDown">
  <div id="formContent">
    <!-- Tabs Titles -->

    <!-- Icon -->
    <div class="fadeIn first">
      <img src="/salon/static/img/example_logo.png" id="icon" alt="User Icon" />
    </div>

    <!-- Login Form -->
    <form action = "user_login_attempt.php" method="POST">
      <input type="text" id="login" class="fadeIn second" name="login" placeholder="login">
      <input type="text" id="password" class="fadeIn third" name="password" placeholder="password">
      <input type="submit" class="fadeIn fourth" value="Log In" name = "click">
    </form>

    <!-- Remind Passowrd -->
    <div id="formFooter">
      <a class="underlineHover" id="forgot_password">Forgot Password?</a>
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


</html>