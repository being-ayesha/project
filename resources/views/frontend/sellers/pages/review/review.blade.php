@extends('frontend.sellers.pages.stores.template')
@section('storeContent')
<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-body">
				<div class="col-lg-12">
					<div class="alert alert-success alert-dismissible">
						<button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
						<span><i class="fa fa-info-circle"></i>&nbsp; Payment successfully completed.</span>
					</div>
				</div>

				<div class="col-lg-12">
					<form method="post" action="{{url('review')}}" id="reviewFromValidation">
					@csrf
					<input type="hidden" name="order_id" value="{{$order->id}}">
					<input type="hidden" name="seller_id" value="{{$order->seller_id}}">
					<input type="hidden" name="username" value="{{$order->user->username}}">
					<div class="form-group row">
						<label class="col-form-label col-lg-2"><h4 style="margin-top: 30px">Review</h4></label>
						<div class="col-lg-10">
							<div id="demo4" start="1" style="white-space: nowrap;margin-left: -10px"></div>
							<input type="hidden" name="review_score" value="" id="score">
						</div>
					</div>

					<div class="form-group row">
						<label class="col-form-label col-lg-2"><h4>Comment</h4></label>
						<div class="col-lg-10">
							<textarea rows="3" cols="3" class="form-control" placeholder="Leave a comment" name="comment"></textarea>
						</div>
					</div>
					
					<div class="text-right">
						<button type="submit" class="btn btn-primary">Submit <i class="icon-paperplane ml-2"></i></button>
					</div>

					<div class="text-left">
						<a href="{{url('cancel-review/'.$order->user->username)}}" style="margin-top: -60px" class="btn btn-success">Cancel</a>
					</div>
				</form>
				</div>	
			</div>
		</div>
	</div>
</div>

@endsection
@push('scripts')
<link rel="stylesheet" href="{{asset('public/frontend/plugins/jsRapStar/jsRapStar.css')}}"/>
<script  src="{{asset('public/frontend/plugins/jsRapStar/jsRapStar.js')}}"></script>
<script>
	$(document).ready(function(){
		$('#demo4').jsRapStar({
			colorFront:'#5ab55e',
			length:5,
			starHeight:64,
			step:true,
			onClick:function(score){
				$(this)[0].StarF.css({color:'#26a69a'});
				$("#score").attr("value",parseInt(score));
			},
			onMousemove:function(score){
				$(this).attr('title','Review '+parseInt(score));
			}
		});
	});


	$(function(){
		$('#reviewFromValidation').validate({
			rules: {
				review_score:{
					required: true
				},
				comment:{
					required: true
				}
			},
		});
	});
</script>
@endpush