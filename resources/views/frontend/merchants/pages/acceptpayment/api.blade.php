@extends('frontend.merchants.template')
@section('content')
<div id="success_message"></div>
<div class="row">
	<div class="col-md-6" >
		<div class="card">
				<div class="card-header">
					<h6 class="card-title" style="font-weight: 700;color:#797979;font-size:14px">IPN/Webhook Settings</h6>
				</div>
				<div class="card-body">
					API Documentation
					<form action="{{url('merchants/settings/account')}}" method="post">
					<input type="hidden" name="ipn_settings" value="1">
					@csrf
					<div class="form-group">
						<label for="ipn_secret" style="font-weight: 700;color:#797979;font-size:14px">IPN Secret </label>
						<p>
							<input type="text" class="form-control" id="ipn_secret" placeholder="IPN Secret" value="{{@$settings->ipn_secret?@$settings->ipn_secret:''}}" name="ipn_secret">
						</p>
						@if($errors->has('ipn_secret'))
						<span class="form-text text-danger">
							{{$errors->first('ipn_secret')}}
						</span>
						@endif
					</div>
					<button type="submit" class="btn btn-md bg-teal-400">Save Changes</button>
					<!-- </section> -->
				</form>
				</div>
		</div>	
	</div>	
	<div class="col-md-6">

			<div class="card">
				<div class="card-header">
					<h6 class="card-title" style="font-weight: 700;color:#797979;font-size:14px">API Keys</h6>
				</div>
				<div class="card-body">
					<p>
						API keys help your applications or servers connect to Rocketr. API Keys can have different permissions. For example, some keys might only be used to create orders (using our SDK) while others can be used for accessing order details (great for analytics etc).
					</p>
					<button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal_default" style="margin-bottom: 20px"><i class="icon-add"></i> Create a New API Key</button>
				
					{!! $dataTable->table(['class' => 'table table-striped table-hover dt-responsive text-center', 'width' => '100%', 'cellspacing' => '0']) !!}

				</div>
			</div>	


	</div>
</div>



<!-- Basic modal -->
<div id="modal_default" class="modal fade" tabindex="-1">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header" style="background: #2196f3;text-align: center;height: 60px;">
				<h5 class="modal-title text-uppercase" style="font-weight: 500;color:#ffffff;font-size:14px;">Create a New Set of API Credentials</h5>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<form id="api-form">
				@csrf
				<div class="modal-body">
					<p style="font-weight: 600;color:#797979;font-size:12px">
						Do not share your API credentials. You should never add your API credentials in publicly viewable code. 
					</p>
					
					<div class="form-group">
						<label style="font-weight: 700;color:#797979;font-size:14px">Please enter a name of the application:</label>
						<input type="text" class="form-control" name="appName" id="appName" required="required">
					</div>

					<div class="form-group">
						<label style="font-weight: 700;color:#797979;font-size:14px">Please enter a breif description of the application:</label>
						<input type="text" class="form-control" name="appDescription" id="appDescription" required="required">
					</div>
				</div>

				<div class="modal-footer">
					<button type="submit" class="btn bg-primary">Create</button>
				</div>
			</form>
		</div>
	</div>
</div>
<!-- /basic modal -->



<!-- API modal -->
<div id="modal_key" class="modal fade" tabindex="-1">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header" style="background: #2196f3;text-align: center;height: 60px;">
				<h5 class="modal-title text-uppercase" style="font-weight: 500;color:#ffffff;font-size:14px;">API Details</h5>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			
				<div class="modal-body">
					<table class="table">
						<tr>
							<td style="font-weight: 700;color:#797979;font-size:14px" >Application ID :  </td>
							<td>
								<span id="app_id" style="color: #2196f3"></span>
							</td>
						</tr>
						<tr>
							<td style="font-weight: 700;color:#797979;font-size:14px">Application Secret : </td>
							<td>
								<p id="app_secrect" style="color: #2196f3; width: 300px; word-wrap: break-word;"></p>
							</td>
						</tr>
					</table>

				</div>
		</div>
	</div>
</div>
<!-- /API modal -->

@endsection

@push('scripts')
{!! $dataTable->scripts() !!}
<script type="text/javascript">
	$(function(){
		$( "form#api-form" ).on('submit',function( event ) {
			event.preventDefault();
			var appName        = $('#appName').val();
			var appDescription = $('#appDescription').val();
			var token          = $('input[name="_token"]').val();
			var url            = SITE_URL+'/merchants/api';
				
				$.ajax({
				url     :url,
				method  :'post',
				dataType:'json',
				async   :false,
				data:{
					'appName':appName,
					'appDescription':appDescription,
					'_token':token
				},
				success:function(response){
					if(response.status==1){
						$message=`<div class="flash-container">
								<div class="alert alert-success" role="alert" style="margin-bottom:0px;">
								  	<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								  	 API Create Successfully
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
			
		});

	});


	//Delete Order
	$(function(){
		$(document).on('click','.deleteApi',function(){
			var apiId    = $(this).attr('data-rel');
			console.log(apiId);
			var url        = SITE_URL+'/merchants/delete-api';
			var token      = $('input[name="_token"]').val();
			if(confirm('Are you sure to delete?')){
				$.ajax({
					url:url,
					method:'post',
					dataType:'json',
					async:false,
					data:{
						'apiId':apiId,
						'_token':token
					},
					success:function(response){
						if(response.status==1){
							$('tr#tr_'+apiId).hide('slow');
                        //$(this).hide();
                    }else{
                    	alert('API does not exists');
                    	return false;
                    }
                }
            });
			}
		});
	});

$(document).on('click','#secrect_key_modal',function(){

	  $app_id     = $(this).attr('data-appId');
	  $api_secrect  = $(this).attr('data-secrect');

	  $("#app_id").html($app_id);
	  $("#app_secrect").html($api_secrect);
	  $('#modal_key').modal("show");
});
</script>
@endpush