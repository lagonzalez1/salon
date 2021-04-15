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