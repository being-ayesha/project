<script type="text/javascript">
	window.setTimeout(function() {
	    $(".alert").fadeTo(500, 0).slideUp(500, function(){
	        $(this).remove(); 
	    });
	}, 4000);

	$(document).on('click','.login',function(){
		let href = $(this).attr('href');
		window.location.replace(href);
	});
</script>
</body>
</html>
