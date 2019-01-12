$(function(){

	var $input             = $('.change');

    $input.on('keyup change click', function () {
    	checkDetails();
    });

    function checkDetails(){

    	var product_id   = $('#product_id').val();
    	var button_text  = $('#button_text').val();
    	var button_color = $('#button_color').val();
    	var button_width = $('#button_width').val();
    	var username 	 = $('#username').val();
    	var url  		 = SITE_URL+'/buy/'+username+'/'+product_id;
    	var showPrice;
    	var separator;

    	if($("#priceCheck").prop('checked')){
    		var price  	 = $('#product_id option:selected').attr('data-price');
    		var currency = $('#currency').val();
			var showPrice    = currency+''+parseInt(price).toFixed(2);
 		 } else {
 			var showPrice=' ';
 		 }

 		 if($("#separator").prop('checked')){
			var separator    = '|';
 		 } else {
 			var separator=' ';
 		 }
 
    	if(product_id==''){
    		var product_not_found=`<button type="btn" class="btn btn-danger" disabled="disabled">Product Not Found</button>`;
    		$('#buttonPreview').html(product_not_found);
    		$('#embedCode').text('');
    	}else{
    		var copy =`<span id="cpbtn" style="cursor: pointer;color: red; font-weight: 800">Copy</span>`;
    		
    		var newButton =`<a target="_blank"  href="${url}" style="background-color:${button_color} ; width:${button_width}; color: #FFFFFF;
    		text-align: center;border-radius: 4px;border: none; padding:15px;cursor: pointer;display: inline-block;">${button_text} ${separator} ${showPrice}</a>`;

    		$('#buttonPreview').html(newButton);
    		$('#embedCode').text(newButton);
    		$('#copyBtn').html(copy);
    	}
    }

    $('#copyBtn').on('click', function () {
    	$('#embedCode').removeAttr('disabled').select().attr('disabled', 'true');
    	document.execCommand('copy');
    	$('#cpbtn').css('color','#26a69a');
    	$('#copiedMessage').show().fadeOut(5000);
    });

	});