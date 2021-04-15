


$(document).ready(function (){
    $('#forgot_password').on('click', function () {
        var title = "Forgot Password";
        var body = "Please email at lag.webservices@gmail.com, for any problems with your accound, specify your email and store number. Thanks!";
        edit_modal_show(title, body);
    });
  });
  
  
  function edit_modal_show(title,body){
    document.getElementById('title_config').innerHTML = title;
    document.getElementById('body_config').innerHTML = body;
    $("#configure_modal").modal('show');
  }

  function refreshPage() {
    location.assign("user_login_page.php");
    return false;
  
  }