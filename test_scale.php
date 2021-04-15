<?php

date_default_timezone_set("America/Los_Angeles");
$current_date = date("m/d/o");

?>


<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Company Name</title>

	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script> 
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"/> 
	
	


	<!-- Styling dont remove -->   
	<link href = "https://code.jquery.com/ui/1.10.4/themes/cupertino/jquery-ui.css" rel = "stylesheet"> 
	<script src="https://kit.fontawesome.com/fd1affcb0c.js" crossorigin="anonymous"></script>
  	<link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@400;500&family=Montserrat:wght@100&family=Nunito&display=swap" rel="stylesheet">
  	<link href="static/main_style.css" rel="stylesheet">

</head>

<?php

if(isset($_GET['lost_spot'])){
	echo '<script type="text/javascript">
		$(document).ready(function() {
			$("#lost_spot_modal").modal("show");
		});
    </script>';

}

if(isset($_GET['duplicate'])) {
	echo '<script type="text/javascript">
		$(document).ready(function() {
			$("#duplicate_error").modal("show");
		});
    </script>';
}
?>

<script src='javascript/test_scale.js'>
</script>

<nav class = "navbar navbar-expand-md navbar-light">
	<div class="container-fluid">
	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive">
		<span class="navbar-toggler-icon"> </span>
	</button>
	<div class="collapse navbar-collapse" id ="navbarResponsive">
		<ul class="navbar-nav ml-auto">
			<li class="nav-item">
				<a class="nav-link" href="#">Home</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="meet_the_team.html">Stylist</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="#" id="about">About</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="#"id="help">Help</a>
			</li>

		</ul>
	</div>
	</div>
</nav>


<div class="modal fade" id="about_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <img src="static/img/storefront.jpg" class="img-responsive" style="max-width: 100%;">
        </div>
        <div class="modal-body" id = "body_err">
            <p class="header text-center">About Us</p>
            <p class="sub_header text-center">We are a small company located on 988 W something Drive, Beverly hills Ca, 90000. Our promise to our clients is to ensure every service is to the highest standard.</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
</div>

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


<div class="modal fade" id="lost_spot_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title small_header" id="exampleModalLabel">Oh No!</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="refreshPage();">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id = "body_err">
       <p class="sub_header text-center">Looks like someone beat you for your appointment! Try the next best available time, we are very popular and our time slots fill out fast!
       Thanks!</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal" onclick="refreshPage();">Close</button>
      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="duplicate_error" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Error: Duplicate Email!</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="refreshPage();">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id = "body_err">
	   Hi! based on the email provided we have been able to find you on our database! This means you already have an appoinment with us. 
	   If you wish to cancell please go to the bottom of this page.
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal" onclick="refreshPage();">Close</button>
      </div>
    </div>
  </div>
</div>


<div class="hero-image">
  <div class="hero-text">
  	<div class="icon">
  		<a href="main.php" class="logo">
  			<img src="static/img/icons/flower.png" style="height: 90px; width: 90px;" class="ftco-animate fadeInUp ftco-animated">
  		</a>
     </div>
    <h1 class="display-4 ftco-animate fadeInUp ftco-animated">Store Name</h1>
    <h1 class="display-4 ftco-animate fadeInUp ftco-animated">BEAUTY SALON</h1>
  </div>
</div>


<div class="container-fluid padding" id="covid">
  <h2 class="center-text-title text-center">Covid-19 Responce</h2>
  <p class="lead text-center">To Minimize The Spread We Pleadge Too</p>
  <hr class="small_hr">
  <div class="row d-flex text-center">
      <div class="col-sm py-2">
        <i class="fas fa-hand-sparkles fa-3x"></i>
        <h3>Clean Facilties</h3>
        <p>Distance From Other Guest, Mask Required</p>
      </div>
      <div class="col-sm py-2">
        <i class="fas fa-pump-medical fa-3x"></i>
        <h3>Sanitized Equipment</h3>
        <p>Clean Equipment & Sanitize From Each Use</p>
      </div>
      <div class="col-sm py-2">
        <i class="fas fa-hand-holding-usd fa-3x"></i>
        <h3>Contact Less Payments</h3>
        <p>Contactless</p>
      </div>
    </div>
</div>



 <div class="container-fluid">
 	<div class="title text-center">
        <h2 class="mb-4">Our Work</h2>
        <p class="mb-3">Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
    </div>
 </div>


<!--- Containers Cards -->
<div class="container-fluid" id="show_work">
<div class="row padding">
	<div class="col-md-3 py-2">
		<div class="card h-100">
			<img class="card-img-top" src="static/img/work-2.jpg">
			<div class="card-body">
				<h4 class="card-title">Haircuts</h4>
				<p class="sub_header">From a simple haircut to admire worthy haircuts!</p>
				<button href="#" class="btn btn-secondary" id="work1">Take a Look</button>
			</div>
		</div>
	</div>

<div class="col-md-3 py-2">
		<div class="card h-100">
			<img class="card-img-top" src= "static/img/work-3.jpg">
			<div class="card-body">
				<h4 class="card-title">Woman Beauty Styling</h4>
				<p class="sub_header">Styling from our experts</p>
				<button href="#" class="btn btn-secondary" id="work2">Take a Look</button>
			</div>
		</div>
	</div>

	<div class="col-md-3 py-2">
		<div class="card h-100">
			<img class="card-img-top" src= "static/img/work-1.jpg">
			<div class="card-body">
				<h4 class="card-title">Women Color Match</h4>
				<p class="sub_header">Best in the buisness for color matching.</p>
				<button href="#" class="btn btn-secondary" id="work3">Take a Look</button>
			</div>
		</div>
	</div>


	<div class="col-md-3 py-2">
		<div class="card h-100">
			<img class="card-img-top" src= "static/img/work-3.jpg">
			<div class="card-body">
				<h4 class="card-title">Waxing</h4>
				<p class="sub_header">We currently offer Eyebrows and full face!</p>
				<button href="#" class="btn btn-secondary" id="work4">Take a Look</button>
			</div>
		</div>
	</div>
</div>
</div>


 <div class="container-fluid">
 	<div class="title text-center">
        <h2 class="mb-4">What We Offer</h2>
        <p class="mb-3">Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
    </div>
 </div>


 <div class="container-fluid padding">
 	<div class="row padding d-flex">
 		<div class="col-sm-4 ftco-animate fadeInUp ftco-animated py-2">
		<div class="card h-100" id="card1">
			<div class="card-body">
				<div class="text-center">
					<h3 class="subthindark">Basic</h3>
	        		<p><span class="price">$24.50</span> <span class="per">/ one trip</span></p>
	        	</div>
				<ul class="list-group">
        			<li class="list-group-item text-center">Nail Cutting &amp; Styling</li>
					<li class="list-group-item text-center">Hair Trimming</li>
					<li class="list-group-item text-center">Spa Therapy</li>
					
        		</ul>
			</div>
		</div>
	</div>
	<div class="col-sm-4 ftco-animate fadeInUp ftco-animated py-2">
		<div class="card h-100" id="card2">
			<div class="card-body">
				<div class="text-center">
					<h3 class="subthindark">Standard</h3>
	        		<p><span class="price">$44.50</span> <span class="per">/ one trip</span></p>
	        	</div>
				<ul class="list-group">
        			<li class="list-group-item text-center">Nail Cutting &amp; Styling</li>
					<li class="list-group-item text-center">Hair Trimming</li>
					<li class="list-group-item text-center">Spa Therapy</li>
					<li class="list-group-item text-center">Body Massage</li>
        		</ul>
			</div>
		</div>
	</div>
	<div class="col-sm-4 ftco-animate fadeInUp ftco-animated py-2">
		<div class="card h-100" id="card3">
			<div class="card-body">
				<div class="text-center">
					<h3 class="subthindark">Premium</h3>
	        		<p><span class="price">$64.50</span> <span class="per">/ one trip</span></p>
	        	</div>
				<ul class="list-group">
        			<li class="list-group-item text-center">Nail Cutting &amp; Styling</li>
					<li class="list-group-item text-center">Hair Trimming</li>
					<li class="list-group-item text-center">Spa Therapy</li>
					<li class="list-group-item text-center">Body Massage</li>
					<li class="list-group-item text-center">Manicure</li>
        		</ul>
			</div>
		</div>
	</div>
 	</div>	
</div>


<div class="container-fluid" id="cost">
	<h2 class="mb-4 text-center">Our Pricing</h2>
	<div class="row d-flex justify-content-center">
		<div class="col-md-12">
			<div class="row d-flex justify-content-center text-center">
				<div class="col-md-3">
					<p class="subthindark">Coloring Services</p>
					<hr class="bl_hr">
					<p class="sub_header">Complete Color Change: 70$ & up</p>
					<p class="sub_header">Partial Color Change: 50$ & up</p>
					<p class="sub_header">Highlights: 40$ & up</p>
				</div>
				<div class="col-md-3">
					<p class="subthindark">Styling</p>
					<hr class="bl_hr">
					<p class="sub_header">Simple: 50$ & up</p>
					<p class="sub_header">Wedding: 70$ & up</p>
					<p class="sub_header">Flat: 40$ & up</p>
				</div>
				<div class="col-md-3">
					<p class="subthindark">Woman Cuts</p>
					<hr class="bl_hr">
					<p class="sub_header">Normal Cut: 50$ & up</p>
					<p class="sub_header">Fancy Cut: 70$ & up</p>
				</div>
				<div class="col-md-3">
					<p class="subthindark">Luxury Nails</p>
					<hr class="bl_hr">
					<p class="sub_header">Color: 20$ & up</p>
					<p class="sub_header">Filling: 20$ & up</p>
					<p class="sub_header">New Set: 30$ & up</p>
				</div>
			</div>
		</div>
	</div>
</div>



<section class="ftco-partner bg-light">
    	<div class="container">
    		<div class="row partner justify-content-center">
    			<div class="col-md-10">
    				<div class="row">
		        	<div class="col-md-3">
		        		<a href="#" class="partner-entry">
		        			<img src="static/img/partner-1.jpg" class="img-fluid" alt="Colorlib template">
		        		</a>
		        	</div>
		        	<div class="col-md-3">
		        		<a href="#" class="partner-entry">
		        			<img src="static/img/partner-2.jpg" class="img-fluid" alt="Colorlib template">
		        		</a>
		        	</div>
		        	<div class="col-md-3">
		        		<a href="#" class="partner-entry">
		        			<img src="static/img/partner-3.jpg" class="img-fluid" alt="Colorlib template">
		        		</a>
		        	</div>
		        	<div class="col-md-3">
		        		<a href="#" class="partner-entry">
		        			<img src="static/img/partner-4.jpg" class="img-fluid" alt="Colorlib template">
		        		</a>
		        	</div>
	        	</div>
	        </div>
        </div>
    	</div>
    </section>

<div class="jumbotron">
	<h1 class="header">Save Time, Check In Online</h1>
    <h1 class="sub_header">- Same day appointments available, depending on how booked a stylist is.</h1>
	<h1 class="sub_header">- Please arrive 10 mintues before appointment time.</h1>
	<h1 class="sub_header">- We also offer a walk in line, but keep in mind we follow appoinments first.</h1>
</div>
<div class="container-fluid" id="closed">
	<h3 class="header text-center"> Sorry Appointments are closed as of now</h3>
</div>


<div class="container-fluid"id="appointments">
		<div class="overlay"></div>
    	<div class="container">
    		<div class="row d-md-flex align-items-center">
    			<div class="col-md-2"></div>
	    		<div class="col-md-4 d-flex align-self-stretch">
	    			<div class="appointment-info text-center p-5">
	    				<div class="padd">
	    					<h3 class="header_title">Address</h3>
		    				<h4 class="adr"> 203 Fake St. Mountain View, San Francisco, California, USA</h4>
		    				
	    				</div>
	    				<div class="padd">
		    				<h3 class="header_title">Phone</h3>
		    				<p class="adr">000 123 456</p>

	    				</div>
	    				<div>
		    				<h3 class="header_title">Opening Hours</h3>
		    				<p class="adr">Monday - Friday</p>
		    				<p class="adr">08:00am - 09:00pm</p>
	    				</div>
	    			</div>
	    		</div>
	    		<div class="col-md-6 appointment pl-md-5">
	    			<h3 class="apt_title">Same Day Appointments</h3>
                    <p> Current wait time...  </p>
					<br>

	    	<form action="make_appointment.php" method="post">
	            <div class="row form-group d-flex">
	            	<div class="col-md-6">
	            		<input type="text" class="form-control no-border" placeholder="First & Last" id="name" name="name" autocomplete="off" required="">
	            		<hr class= "w-hr">
	            	</div>
	            	<div class="col-md-6">
	            		<input type="text" class="form-control no-border" placeholder="Email" id="email" name="email" autocomplete="off" required="">
	            		<hr class= "w-hr">
	            	</div>
	            </div>
	            <div class="row form-group d-flex">
	            	<div class="col-md-6">
	            		<input type="text" class="form-control no-border" placeholder="Phone" id="phone" name="phone" autocomplete="off" required="">
	            		<hr class= "w-hr">
	            	</div>
                    <?php
                    global $current_date;
	            	echo '<div class="col-md-6">
	              		<input type="text" value="Today Date: '.htmlentities($current_date).'" class="form-control no-border" id="time" name="time" maxlength="8" readonly>
	           			<hr class="w-hr">
	            	</div>';

                    ?>
	            </div>
	            <div class="row form-group d-flex">
	            <div class="col-md-6">
	            	<select class="form-control" id="employee-id" name="empl" required hidden>
					        <option value="None">Perferred stylist</option>
					        <option value="Stacy">Stacy Carrol</option>
					        <option value="Sam">Sam Jr</option>
					        <option value="Mary">Mary Jane</option>
					        <option value="Emily">Emily Valdovinos</option>
					        <option value="Karen">Karen Mayne</option>
	          		</select>
	          		<hr hidden>
	            </div>
		            <div class="col-md-6">
		              <div class="form-group">
	                    <input type="text" class="form-control no-border" placeholder="Date" id="calendar" autocomplete="off" name="date"hidden>
		              <hr class= "w-hr" hidden>
		            </div>
		        	</div>
	        	</div>
	        	<div class="row form-group d-flex">
	        		<div class="col-md-6">
	        			<div class="form-group">
							
	        				<input class="btn btn-primary" type="button" value="Check Available Times" data-toggle="collapse" aria-expanded="false" aria-controls="collapseExample" id="check_tm" hidden>		
	        			</div>
	        		</div>
	        	</div>
	            <div class="form-group">
                <!-- If this is present when calling make_appointment.php   -->
                  <input type="text" name="scale_version" id="scale" value="scale_version" hidden>
	              <input type="submit" value="Make Appointment" class="btn btn-primary" id="create_app" name="clicked" >
	            </div>
	          </form>
	    		</div>  
    		</div>
    	</div>
    </div>



<div class="collapse" id="check_av_times">
  <div class="card card-body">
  	<div class="card card-title" id="time_title_message">
  		<h2 class="header" id="av_title">All Available Times</h2>
  		<h3 class="sub_header">Act Fast, Dont Loose Your Spot!</h3>
  	</div>
		<div class="row btn-group d-flex">	
			<div class="btn-group-vertical" role="group" id="available_times" aria-label="Basic example">
			</div>	
		</div>
  </div>
</div>



<div class="modal" tabindex="-1" role="dialog" id="instructions">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title header">Instructions</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p class="sub_header">Please select the Date & Stylist to reveal their Availability.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="check_existing" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="title">Check Or Remove Appointment</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="clearField();">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            <div class="form-group" id="remove_group">
                  <label for="client-email" class="control-label">Enter Email (case sensitive)</label>
                  <input type="text" class="form-control" name="client-email" required = "" pattern="[^@]+@[^@]+\.[a-zA-Z]{2,}" id="check_app_cancell" autocomplete="off">
			</div>

			<div class="collapse" id="show_data">
  				<div class="card card-body">
					<div class="card card-title" id="time_title_message">
						<h2 class="header" id="av_title">Appointment Details</h2>
					</div>
					<div class="row btn-group d-flex" id="inner_row">	
						<div class="btn-group-vertical" role="group" id="inner_data" aria-label="Basic example">
							<p id="i-name"></p>
							<p id="i-date"></p>
							<p id="i-time"></p>
							<p id="i-stylist"></p>
							<p id="i-email"></p>
							<input type="submit" value="Remove Me" id="remove_me" class="btn btn-danger">
						</div>	
					</div>
 			 	</div>
			</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal" onclick="clearField();">Close</button>
        <input type="submit" value= "View/Remove" name="remove_client" class = "btn btn-warning" id="submitButton">
      </div>
    </div>
  </div>
</div>



<div class="modal fade" id="picture_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-body" id="modal_body_pictures">
		<div class="modal-header">
          <h5 class="modal-title" id="title">Images</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                  <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                  <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
				  <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
				  <li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
                </ol>
                <div class="carousel-inner">
                  <div class="carousel-item active">
                    <img class="d-block w-100 h-80" src="/salon/static/img/emp_3/i_1.jpg" alt="First slide" id="1">
                  </div>
                  <div class="carousel-item">
                    <img class="d-block w-100 h-80" src="/salon/static/img/emp_3/i_1.jpg" alt="Second slide" id="2">
                  </div>
                  <div class="carousel-item">
                    <img class="d-block w-100 h-80" src="/salon/static/img/emp_3/i_1.jpg" alt="Third slide"id="3">
				  </div>
				  <div class="carousel-item">
                    <img class="d-block w-100 h-80" src="/salon/static/img/emp_3/i_1.jpg" alt="Fourth slide"id="4">
                  </div>
                </div>
                <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                  <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                  <span class="carousel-control-next-icon" aria-hidden="true"></span>
                  <span class="sr-only">Next</span>
                </a>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
		</div>
		
      </div>
    </div>
</div>
</div>





<div class="modal fade" id="send_message" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="title_config">Message Us</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="refreshPage();">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id= "body">
	  	<label for="email_send">Email:</label>
	  		<input type="text" placeholder="Email" class="form-control" id="email_send" name="Email" maxlength="20" required="">

		  <label for="body_message">Body:</label>
			<textarea type="text" placeholder="Body" class="form-control" id="body_message" name="body_message" required=""></textarea>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
		<button type="input" class="btn btn-info" data-dismiss="modal" id="send_message_btn">Send</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="time_out" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="title_config">Refresh Error</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="refreshPage();">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id= "body_config">
        Looks like we have a timeout error, please check if you are connected to the internet. Or try to refresh the entire page.
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal" onclick="refreshPage();">Close</button>
      </div>
    </div>
  </div>
</div>



<div class="modal fade" id="configure_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="title_config_err">Refresh Error</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id= "body_config_err">
        Looks like we have a timeout error, please check if you are connected to the internet. Or try to refresh the entire page.
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<footer>
	<div class="container-fluid padding">
		<div class="row text-center">
			<div class="col-md-3">
			<h5 class="footer_title">Have Questions?</h5>
			<hr class="small_hr">
			<p>909-xxx-xxxx</p>
			<p>someemail@gmail.com</p>
			<p>1988 W something Drive</p>
			<p>Beverly Hills Ca, 92400</p>
			<hr class="small_hr">
		</div>

		<div class="col-md-3">
			<h5 class="footer_title">Our Hours</h5>
			<hr class="small_hr">
			<p>Monday: 9am-6pm</p>
			<p>Tuesday: 9am-6pm</p>
			<p>Wednesday: 9am-6pm</p>
			<p>Thursday: 9am-6pm</p>
			<p>Friday: 9am-6pm</p>
			<p>Saturday: 9am-6pm</p>
			<p>Sunday: Closed</p>
			<hr class="small_hr">

		</div>
		<div class="col-md-3">
			<h5 class="footer_title">Interested in a website?</h5>
			<hr class="small_hr">
			<p>lag.webservices@gmail.com</p>
			<p>909-XXX-XXXX</p>
			<hr class="small_hr">
		</div>

		<div class="col-md-3">
            <div class="container text-center">
              <h2 class="footer_title">About Us</h2>
              <hr class="small_hr">
              <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
			  <p style="color: #4ed9f7;"> View OR Cancell Appoinment <a onclick="cancell_click();">Click Me</a></p>
			  <p>Feedback? Send us a message <a onclick="send_message();"><i class="far fa-envelope fa-lg"></a></p>
            	<hr class="small_hr">
                <a href="#"><img src="static/img/icons/twitter_icon.png" style="height: 50px; width: 50px;"></a>
                <a href="#"><img src="static/img/icons/facebook_icon.png" style="height: 50px; width: 50px;"></a>
                <a href="#"><img src="static/img/icons/instagram_icon.png" style="height: 50px; width: 50px;"></a>
            
            </div>
            <hr class="small_hr">
          </div>
		</div>
	</div>
</footer>




    


</html>