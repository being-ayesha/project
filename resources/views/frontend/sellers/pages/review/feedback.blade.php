@extends('frontend.sellers.template')
@section('content')
	<div id="success_message"></div>
    <div class="card">
    	<div class="card-body"> 
			{!! $dataTable->table(['class' => 'table table-striped table-hover dt-responsive text-center', 'width' => '100%', 'cellspacing' => '0']) !!}
		</div>
	</div>
	<!-- Basic modal -->
	<div id="modal_default" class="modal fade" tabindex="-1">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Give Your Response</h5>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>
				<form  id="feedback-form">
					@csrf
					<input type="hidden" id="order_id" value="">
					<div class="modal-body">
						<div class="form-group row">
							<label class="col-form-label col-lg-2"><h4>Response</h4></label>
							<div class="col-lg-10">
								<textarea rows="3" cols="3" class="form-control" placeholder="Leave a response" id="feedback"></textarea>
							</div>
							<div class="error" id="error-feedback" style="margin-left: 105px;"></div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-link" data-dismiss="modal" >Close</button>
						<button type="submit" class="btn bg-primary" id="send-button">Send</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	<!-- /basic modal -->
@endsection
@push('scripts')
{!! $dataTable->scripts() !!}
<script type="text/javascript">
	$(function(){

		$( "form#feedback-form" ).on('submit',function( event ) {
			event.preventDefault();
			var feedback       = $('#feedback').val();
			var order_id       = $('#order_id').val();
			var url            = SITE_URL+'/seller/send-feedback';
			var token          = $('input[name="_token"]').val();
			if(feedback==''){
				$("#error-feedback").text('This field is required.')
				return false;
			}
			else{
				$('#send-button').attr('disable',true);
				$('#send-button').text('Sending , Please Wait');
				$("#error-feedback").text('')
				
				$.ajax({
				url     :url,
				method  :'post',
				dataType:'json',
				async   :false,
				data:{
					'feedback':feedback,
					'order_id':order_id,
					'_token':token
				},
				success:function(response){
					$('#send-button').attr('disable',false);
					$('#send-button').text('Send');
					if(response.status==1){
						$message=`<div class="flash-container">
								<div class="alert alert-success" role="alert" style="margin-bottom:0px;">
								  	<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								  	 Response Send Successfully
								</div>
							</div>`;
						$("#success_message").html($message);
						$('#modal_default').modal("hide");
						location.reload();
					}else{
						return false;
					}
				}
			}); 
			}
		});

	});
	$(document).on('click','#reply',function(){
		$('form#feedback-form').trigger( "reset");
		$('#order_id').val($(this).attr('data-order'));
	});
</script>
@endpush