//Success message hide after 10 seconds
    $(".flash-container").fadeTo(2000, 1000).slideUp(1000, function(){
        $(".flash-container").slideUp(1000);
    });


// Merchants profile form Validation
$(function(){
  $('#merchantProfile').validate({
     rules: {
            first_name:{
                required: true
            },
            last_name:{
                required: true
            },
            address_line_1:{
                required: true
            },
            address_line_2:{
                required: true
            },
            city:{
                required: true
            },
            state:{
                required: true
            },
            postal_code:{
                required: true
            },
            country:{
                required: true
            },
        },
  });
});


// Change Password form Validation

$(function(){
  $('#changePasswordForm').validate({
     rules: {
            current_password:{
                required: true
            },
            new_password:{
                required: true
            },
            confirm_password:{
               required: true,
               equalTo: "#new_password"
            }
        },
  });
});