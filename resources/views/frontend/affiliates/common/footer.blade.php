<script type="text/javascript" src="{{url('public/js/custom/custom.js')}}"></script>
<script type="text/javascript">
	window.setTimeout(function() {
	    $(".alert").fadeTo(500, 0).slideUp(500, function(){
	        $(this).remove(); 
	    });
	}, 4000);
$(function(){

	$('#username').on('keypress', function (event) {
		var regex = new RegExp("^[a-zA-Z0-9._]+|[\b]+$");
		var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
		if (!regex.test(key)) {
			$('#err_special_character').html('Special characters not allowed');
			event.preventDefault();
			return false;
		}else{
			$('#err_special_character').html(' ');
			return true;
		}
	});

});
$(function(){

	$.validator.addMethod("noSpace", function(value, element) {
		return this.optional(element) || /^[a-zA-Z0-9.]+$/i.test(value);
	}, "Not allowed");

	$('#registrarionForm').validate({
		rules: {
			username:{
				required:true
				
			},
			email: {
				required: true,
				email:true
			},
			password:{
				required: true
			},
			conf_password:{
				required: true,
				equalTo: "#password"
			} 
		}
	}); 
 });

$(function(){

	$('#loginForm').validate({
		rules: {
			email: {
				required: true,
				email:true
			},
			password:{
				required: true
			}
			
		}
	}); 
 });
</script>
</body>
</html>
