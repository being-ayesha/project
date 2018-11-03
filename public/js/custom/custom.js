  //Hide the form div
  $('#form_div').hide();
  //Show the product add form when click product type tab containing class producttype starts here
  $(document).on('click','.producttype',function(){
      var producttype  = $(this).attr('data-rel');
      $('#product_type').val(producttype);
      $('#producttype_div').hide();
      $('#form_div').show();
      if(producttype=='file'){
        $('.product_type_file_div').css('display','block');
        $('.product_type_codes_div').css('display','none');
        $('.product_type_service_div').css('display','none');
      }else if(producttype=='code'){
        $('.product_type_file_div').css('display','none');
        $('.product_type_codes_div').css('display','block');
        $('.product_type_service_div').css('display','none');
      }else{
        $('.product_type_file_div').css('display','none');
        $('.product_type_codes_div').css('display','none');
        $('.product_type_service_div').css('display','block');
      }
  });
  //Show the product add form when click product type tab containing class producttype ends here
  
  //Show the product add form when change product type from dropdown containing id product_type starts here

  $(document).on('change','#product_type',function(){
      var producttype = $('#product_type').val();
      if(producttype=='file'){
        $('.product_type_file_div').css('display','block');
        $('.product_type_codes_div').css('display','none');
        $('.product_type_service_div').css('display','none');
      }else if(producttype=='code'){
        $('.product_type_file_div').css('display','none');
        $('.product_type_codes_div').css('display','block');
        $('.product_type_service_div').css('display','none');
      }else{
        $('.product_type_file_div').css('display','none');
        $('.product_type_codes_div').css('display','none');
        $('.product_type_service_div').css('display','block');
      }
  });

  //Show the product add form when change product type from dropdown containing id product_type starts here

  //For multistep form run with validation starts here
    var form = $("#regForm").show();
    form.steps({
    headerTag: "span",
    bodyTag: "section",
    transitionEffect: "slideLeft",
    onStepChanging: function (event, currentIndex, newIndex)
    {
        // Allways allow previous action even if the current form is not valid!
        if (currentIndex > newIndex)
        {
            return true;
        }
        form.validate().settings.ignore = ":disabled,:hidden";
        return form.valid();
    },

    onFinishing: function (event, currentIndex)
    {
        form.validate().settings.ignore = ":disabled";
        return form.valid();
    },
    onFinished: function (event, currentIndex)
    {
        $('#regForm').submit();
        //document.form(submit);
        ///alert("Submitted!");
    }
}).validate({
    /*errorPlacement: function errorPlacement(error, element) { element.before(error); },
    rules: {
        confirm: {
            equalTo: "#password-2"
        }
    }*/
    rules: {
        title: {
            required: true
        },
        photo:{
          required:true
        },
        product_type:{
          required:true
        },
        price:{
          required:true
        }
    },
});

//For multistep form run with validation ends here

 	   $('#displayImg').hide();
	  //Display image before upload starts here	    
	    $(".imageInp").change(function(){
	        readURL(this);
	    });
		function readURL(input) {
          $('#displayAnotherImg').hide();
	        if (input.files && input.files[0]) {
	            var reader = new FileReader();
	            reader.onload = function (e) {
	            	$('#displayImg').show();
	                $('#displayImg').attr('src', e.target.result);
	            }
	            reader.readAsDataURL(input.files[0]);
	        }
	    }
	  //Display image before upload ends here

    //Checkbox control for product type file starts here
      $('.stock_limited_div').hide();
      $(document).on('click','.checkState',function(){
            $('#stock_unlimited').prop('checked',true)
            $('#stock_limited_enable').prop('checked',false);
            $('.stock_limited_div').hide();
            $('#stock_limited').val('');
      });

      $(document).on('click','.checkStateLimit',function(){
            $('#stock_unlimited').prop('checked',false)
            $('#stock_limited_enable').prop('checked',true);
            $('.stock_limited_div').show();
      });

    //Checkbox control for product type file ends here

    //Code add function for product type code/serial starts here
    $('#codesLabelDiv').hide();
    $(function(){ // DOM ready

          // ::: TAGS BOX
          $("#tags input").on({
            focusout : function() {
              $('#codesLabelDiv').show();
              //var txt = this.value.replace(/[^a-z0-9\+\-\.\#]/ig,''); // allowed characters
              var txt          = this.value.replace(/[^a-z0-9\+\-\.\#]/ig,''); // allowed characters
              var txtWithSpace = this.value.replace(/[^a-z0-9\+\-\.\#]/ig,' ');
              if(txt!='') $("#code").after("<input style='margin:5px 0px 5px 0px;background:#eee;padding:2px;' readonly class='tags' name='code_item[]' value='"+txtWithSpace+"'>");
              //if(txt) $("<span/>", {text:txt, insertBefore:this});
              this.value = "";
            },
            keyup : function(ev) {
              // if: comma|enter (delimit more keyCodes with | pipe)
              if(/(188|13)/.test(ev.which)) $(this).focusout(); 
            }
          });
          /*$(document).on('click', '.tags', function() {
            if(confirm("Do you want to remove "+ $(this).val() +"?")) $(this).remove(); 
          });*/

    });

    //Code add function for product type code/serial ends here here
    
    //Affiliate sections show/hide
    $('.affiliate_rate_div').hide();
    $(document).on('click','#affiliate_permission',function(){
      if($('#affiliate_permission').prop('checked')==true){
        $('.affiliate_rate_div').show();
      }else{
        $('.affiliate_rate_div').hide();
      }
    });

    //Affiliate section during edit product form
    $(document).on('click','.affiliate_rate_permission_edit',function(){
      if($('.affiliate_rate_permission_edit').prop('checked')==true){
        $('.affiliate_rate_div_edit').show();
      }else{
        $('.affiliate_rate_div_edit').hide();
      }
    });

    //Product name check already exists or not
    //setup before functions
    var typingTimer;                //timer identifier
    var doneTypingInterval = 2000;  //time in ms, 2.5 second for example
    var $input             = $('#title');

    //on keyup, start the countdown
    $input.on('input', function () {
      clearTimeout(typingTimer);
      typingTimer = setTimeout(checkProductName, doneTypingInterval);
    });

    //on keydown, clear the countdown 
    $input.on('keydown', function () {
      clearTimeout(typingTimer);
    });

    //user is "finished typing," do something
    function checkProductName () {
        var token = $('input[name="_token"]').val();
        var title = $('#title ').val();
        var url   = SITE_URL+'/seller/product-check';
        if(title){
            $.ajax({
              url:url,
              method:"post",
              dataType:'json',
              async:false,
              data:{
                "_token":token,
                "title":title
              },
              success:function(response){
                if(response.status==1){
                  $('.errProductName').html('Product has already been taken!');
                  return false;
                }else{
                  $('.errProductName').html('');
                  return true;
                }
              }
            });
        }
    }
    //Success message hide after 5 seconds
    $(".flash-container").fadeTo(2000, 500).slideUp(500, function(){
        $(".flash-container").slideUp(500);
    });

    //Validate product group form during add
    $('#productGroupForm').validate({
        rules:{
          product_group_title:{
            required:true
          }
        }
    });
    //Code for product group name check
    //setup before functions
    var $input             = $('#product_group_title');
    //on keyup, start the countdown
    $input.on('input', function () {
      clearTimeout(typingTimer);
      typingTimer = setTimeout(checkProductGroupName, doneTypingInterval);
    });

    //on keydown, clear the countdown 
    $input.on('keydown', function () {
      clearTimeout(typingTimer);
    });

    //user is "finished typing," do something
    function checkProductGroupName () {
        var token             = $('input[name="_token"]').val();
        var productGroupTitle = $('#product_group_title ').val();
        var url               = SITE_URL+'/seller/product-group-check';
        if(productGroupTitle){
            $.ajax({
              url:url,
              method:"post",
              dataType:'json',
              async:false,
              data:{
                "_token":token,
                "productGroupTitle":productGroupTitle
              },
              success:function(response){
                if(response.status==1){
                  $('.errProductGroupName').html('Product group has already been taken!');
                  return false;
                }else{
                  $('.errProductGroupName').html('');
                  return true;
                }
              }
            });
        }
    }

    //Delete product group
    $(function(){
        $(document).on('click','.deleteProductGroup',function(){
           var productGroupId = $(this).attr('data-rel');
           var url            = SITE_URL+'/seller/delete-product-groups';
           var token          = $('input[name="_token"]').val();
           if(confirm('Are you sure to delete?')){
               $.ajax({
                   url:url,
                   method:'post',
                   dataType:'json',
                   async:false,
                   data:{
                    'productGroupId':productGroupId,
                    '_token':token
                   },
                   success:function(response){
                      if(response.status==1){
                        $('tr#tr_'+productGroupId).hide('slow');
                        //$(this).hide();
                      }else{
                        alert('Product group does not exists');
                        return false;
                      }
                   }
               });
           }
        });
    });

// Cupon Code From Validation 
$(function(){
$('#coupon_product_id').change(function(){
    $(this).valid()
});
$('#coupon_payment_method_id').change(function(){
    $(this).valid()
});
$('#coupon_expaire_date').change(function(){
    $(this).valid()
});

   $('#productCuponForm').validate({
        rules: {
            "product_id[]":{
                required: true
            },
            "payment_method_id[]": {
                required: true
            },
            coupon_code:{
                required: true
            },
            expaire_date:{
               required: true
            },
            discount_amount:{
               required: true
            },
        },
        errorPlacement: function (error, element) {
          if(element.attr("id") == "coupon_product_id") {
            error.appendTo('.error_coupon_product_id');
          }
          else if(element.attr("id") == "coupon_payment_method_id") {
            error.appendTo('.error_coupon_payment_method_id');
          } else {
            error.insertAfter(element);
          }
          
        }
    }); 
 });
  // Cupon code Discount Structure
  $(document).on('change','#discount_strcture',function(){
    var discount_strcture_value=$(this).val();
    if(discount_strcture_value=='percent'){
      $('#discount_result').html("% Off");
    }else {
      $('#discount_result').html("Amount Off");
    }
  });
// Cupon code Date time strcture
  $(document).ready(function () {
  $('#datetimepicker1').datetimepicker({
    format:'Y-m-d h:i a',
    showButtonPanel: true,
    minDate: 0,
    
  });
});

  // Check Coupon Code Unique
    var typingTimer;                //timer identifier
    var doneTypingInterval = 2000;  //time in ms, 2.5 second for example
    var $input             = $('#coupon_code');

    //on keyup, start the countdown
    $input.on('input', function () {
      clearTimeout(typingTimer);
      typingTimer = setTimeout(checkCouponCode, doneTypingInterval);
    });

    //on keydown, clear the countdown 
    $input.on('keydown', function () {
      clearTimeout(typingTimer);
    });

    //user is "finished typing," do something
    function checkCouponCode () {
        var token = $('input[name="_token"]').val();
        var coupon_code = $('#coupon_code ').val();
        var url   = SITE_URL+'/seller/coupon-code-check';
        if(coupon_code){
            $.ajax({
              url:url,
              method:"post",
              dataType:'json',
              async:false,
              data:{
                "_token":token,
                "coupon_code":coupon_code
              },
              success:function(response){
                if(response.status==1){
                  $('.errCuponCode').html('Cupon Code already been taken!');
                  return false;
                }else{
                  $('.errCuponCode').html('');
                  return true;
                }
              }
            });
        }
    }


    //Delete product group
    $(function(){
        $(document).on('click','.deleteProductCoupon',function(){
           var coupon_id = $(this).attr('data-rel');
           var url            = SITE_URL+'/seller/delete-coupon';
           var token          = $('input[name="_token"]').val();
           if(confirm('Are you sure to delete?')){
               $.ajax({
                   url:url,
                   method:'post',
                   dataType:'json',
                   async:false,
                   data:{
                    'coupon_id':coupon_id,
                    '_token':token
                   },
                   success:function(response){
                      if(response.status==1){
                       $("#dataTableBuilder").DataTable().ajax.reload( null, false );
                      }else{
                        alert('Coupon does not exists');
                        return false;
                      }
                   }
               });
           }
        });
    });

