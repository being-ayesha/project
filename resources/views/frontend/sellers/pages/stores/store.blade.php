@extends('frontend.sellers.pages.stores.template')
@section('storeContent')
  <div class="card">
        <div class="card-body">
            <div class="row" style="display:inline;">
                <div class="col-md-2">
                    @if($user->profile_photo)
                      <img style="width:60px;height: 60px;border-radius:50%" src="{{url('public/uploads/sellers/profilephoto')}}/{{$user->profile_photo}}" class="img-circle profile-image" alt="profile-image" name="image">
                    @else
                      <img style="width:60px;height: 60px;border-radius:50%" src="{{url('public/uploads/sellers/profilephoto/nouser.jpg')}}" class="img-circle profile-image" alt="profile-image" name="image">
                    @endif
                </div>
                <div class="col-md-10" style="color:gray">
                    <h1 style="font-size: 26px">{{$user->username}} (<a href="#feedback" id="feedbackLink"><span style="color:gray" class="feedback">0%</span></a>)</h1>
                    <h5 style="font-size: 16px">Member Since: October 2018</h5>
                    <h5></h5>
                </div>
            </div>
            <div class="row" style="display:inline;">
                <div class="col-md-12 text-right" style="display: inline-block;vertical-align: middle;float: none;">
                    <a href="#message-seller" class="btn btn-primary btn-md waves-effect waves-light" data-animation="blur" data-plugin="custommodal" data-overlayspeed="100" data-overlaycolor="#36404a">Message Seller</a>
                </div>
            </div>
        </div>
  </div>
  <div class="row" style="margin-top: 30px;">
	      <div class="col-sm-3">
	            <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
	                @php $i=0; @endphp
	                @foreach($productGroups as $productGroup)
	                  <a class="nav-link {{$i==0?'active':''}}" id="v-pills-{{$i}}-tab" data-toggle="pill" href="#v-pills-{{$i}}" role="tab" aria-controls="v-pills-{{$i}}" aria-selected="false">{{$productGroup->product_group_title}}</a>
	                  @php $i++; @endphp
	                @endforeach
	            </div>
	      </div>
	      <div class="col-sm-9">
		        <div class="card">
		            <div class="card-body">
		            	<div class="input-group">
	    					<input type="text" class="form-control text" placeholder="Search products">
						    <div class="input-group-append">
						      <button class="btn btn-primary" type="button">
						        <i  class="fa fa-search"></i>
						      </button>
						    </div>
  						</div>
		            	<div class="container" style="margin-top: 20px"> 
		            	   <div class="tab-content" id="v-pills-tabContent">
		                        @php $j=0;@endphp
		                            @foreach($groupProductAll as $productAll)
		                      	<div class="tab-pane fade {{$j==0?'show active':''}}" id="v-pills-{{$j}}" role="tabpanel" aria-labelledby="v-pills-{{$j}}-tab">
		                              @php $cnt = count($productAll);@endphp
		                              @for($i=0;$i<$cnt;$i++)
		                                <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3 searchArea" style="float: left;" id="{{$productAll[$i]['product_title']}}">
		                                	<a href="{{url('seller/buy')}}/{{base64_encode($user->username)}}/{{$productAll[$i]['product_uuid']}}"><img class="rounded mx-auto d-block" style="width: 100px;height: 90px" src="{{url('public/uploads/sellers/products')}}/{{$productAll[$i]['product_photo']}}" alt="{{$productAll[$i]['product_title']}}"></a>
		                                	<h1 style="text-align: center;"><a href="{{url('buy')}}/{{base64_encode($user->username)}}/{{$productAll[$i]['product_uuid']}}" style="font-size: 14px">{{$productAll[$i]['product_title']}}</a></h1>
		                                	@if($productAll[$i]['stock']=='-1')
		                                		<p style="color:#007bff;text-align: center;"><span class="text-right">${{$productAll[$i]['price']}}</span></p>
		                                	@else
		                                		<p style="color:#007bff;text-align: center;">Stock:&nbsp;<span class="text-danger text-left">{{$productAll[$i]['stock']}}</span>&nbsp;&nbsp;&nbsp;&nbsp;<span class="text-right">${{$productAll[$i]['price']}}</span></p>
		                                	@endif
		                                </div>
		                              @endfor
		                              @php $j++;@endphp
		                        </div>
		                             @endforeach
		                   </div>
		               </div>
		            </div>
		        </div>
	      </div>
  </div>
@endsection
@push('scripts')
 <script type="text/javascript">
 	$('.text').keyup(function submitClosure(ev) {
	    $('.searchArea').each(function inputElementClosure(index, element) {
	        element = $(element);
	        if (element.attr('id').indexOf(ev.target.value) > -1) {
	            element.show();
	        } else {
	            element.hide();
	        }
	    });
	});
 </script>
@endpush