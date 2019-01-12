<div class="navbar navbar-expand-md navbar-dark">
	<div class="navbar-brand">

		<a href="{{url('seller')}}" >
			<img src="{{asset('public/frontend/global_assets/images/logo_light.png')}}" alt="">
			{{$siteName}}
		</a>
	</div>
	<div class="d-md-none">
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-mobile">
			<i class="icon-tree5"></i>
		</button>
		<button class="navbar-toggler sidebar-mobile-main-toggle" type="button">
			<i class="icon-paragraph-justify3"></i>
		</button>
	</div>

	<div class="collapse navbar-collapse" id="navbar-mobile">
		<!-- <ul class="navbar-nav">
			<li class="nav-item">
				<a href="#" class="navbar-nav-link sidebar-control sidebar-main-toggle d-none d-md-block">
					<i class="icon-paragraph-justify3"></i>
				</a>
			</li>

			<li class="nav-item dropdown">
				<a href="#" class="navbar-nav-link dropdown-toggle caret-0" data-toggle="dropdown">
					<i class="icon-git-compare"></i>
					<span class="d-md-none ml-2">Git updates</span>
					<span class="badge badge-pill bg-warning-400 ml-auto ml-md-0">9</span>
				</a>

				<div class="dropdown-menu dropdown-content wmin-md-350">
					<div class="dropdown-content-header">
						<span class="font-weight-semibold">Git updates</span>
						<a href="#" class="text-default"><i class="icon-sync"></i></a>
					</div>

					<div class="dropdown-content-body dropdown-scrollable">
						<ul class="media-list">
							<li class="media">
								<div class="mr-3">
									<a href="#" class="btn bg-transparent border-primary text-primary rounded-round border-2 btn-icon"><i class="icon-git-pull-request"></i></a>
								</div>

								<div class="media-body">
									Drop the IE <a href="#">specific hacks</a> for temporal inputs
									<div class="text-muted font-size-sm">4 minutes ago</div>
								</div>
							</li>

							<li class="media">
								<div class="mr-3">
									<a href="#" class="btn bg-transparent border-warning text-warning rounded-round border-2 btn-icon"><i class="icon-git-commit"></i></a>
								</div>
								
								<div class="media-body">
									Add full font overrides for popovers and tooltips
									<div class="text-muted font-size-sm">36 minutes ago</div>
								</div>
							</li>

							<li class="media">
								<div class="mr-3">
									<a href="#" class="btn bg-transparent border-info text-info rounded-round border-2 btn-icon"><i class="icon-git-branch"></i></a>
								</div>
								
								<div class="media-body">
									<a href="#">Chris Arney</a> created a new <span class="font-weight-semibold">Design</span> branch
									<div class="text-muted font-size-sm">2 hours ago</div>
								</div>
							</li>

							<li class="media">
								<div class="mr-3">
									<a href="#" class="btn bg-transparent border-success text-success rounded-round border-2 btn-icon"><i class="icon-git-merge"></i></a>
								</div>
								
								<div class="media-body">
									<a href="#">Eugene Kopyov</a> merged <span class="font-weight-semibold">Master</span> and <span class="font-weight-semibold">Dev</span> branches
									<div class="text-muted font-size-sm">Dec 18, 18:36</div>
								</div>
							</li>

							<li class="media">
								<div class="mr-3">
									<a href="#" class="btn bg-transparent border-primary text-primary rounded-round border-2 btn-icon"><i class="icon-git-pull-request"></i></a>
								</div>
								
								<div class="media-body">
									Have Carousel ignore keyboard events
									<div class="text-muted font-size-sm">Dec 12, 05:46</div>
								</div>
							</li>
						</ul>
					</div>

					<div class="dropdown-content-footer bg-light">
						<a href="#" class="text-grey mr-auto">All updates</a>
						<div>
							<a href="#" class="text-grey" data-popup="tooltip" title="Mark all as read"><i class="icon-radio-unchecked"></i></a>
							<a href="#" class="text-grey ml-2" data-popup="tooltip" title="Bug tracker"><i class="icon-bug2"></i></a>
						</div>
					</div>
				</div>
			</li>
		</ul> -->

		<!-- <span class="navbar-text ml-md-3 mr-md-auto">
			<span class="badge bg-success">Online</span>
		</span> -->
		<span class="navbar-text ml-md-3 mr-md-auto">
			<span class="badge">&nbsp;</span>
		</span>

		<ul class="navbar-nav">
			<!-- <li class="nav-item dropdown">
				<a href="#" class="navbar-nav-link dropdown-toggle caret-0" data-toggle="dropdown">
					<i class="icon-people"></i>
					<span class="d-md-none ml-2">Users</span>
				</a>
				
				<div class="dropdown-menu dropdown-menu-right dropdown-content wmin-md-300">
					<div class="dropdown-content-header">
						<span class="font-weight-semibold">Users online</span>
						<a href="#" class="text-default"><i class="icon-search4 font-size-base"></i></a>
					</div>

					<div class="dropdown-content-body dropdown-scrollable">
						<ul class="media-list">
							<li class="media">
								<div class="mr-3">
									<img src="{{asset('public/frontend/global_assets/images/placeholders/placeholder.jpg')}}" width="36" height="36" class="rounded-circle" alt="">
								</div>
								<div class="media-body">
									<a href="#" class="media-title font-weight-semibold">Jordana Ansley</a>
									<span class="d-block text-muted font-size-sm">Lead web developer</span>
								</div>
								<div class="ml-3 align-self-center"><span class="badge badge-mark border-success"></span></div>
							</li>

							<li class="media">
								<div class="mr-3">
									<img src="{{asset('public/frontend/global_assets/images/placeholders/placeholder.jpg')}}" width="36" height="36" class="rounded-circle" alt="">
								</div>
								<div class="media-body">
									<a href="#" class="media-title font-weight-semibold">Will Brason</a>
									<span class="d-block text-muted font-size-sm">Marketing manager</span>
								</div>
								<div class="ml-3 align-self-center"><span class="badge badge-mark border-danger"></span></div>
							</li>

							<li class="media">
								<div class="mr-3">
									<img src="{{asset('public/frontend/global_assets/images/placeholders/placeholder.jpg')}}" width="36" height="36" class="rounded-circle" alt="">
								</div>
								<div class="media-body">
									<a href="#" class="media-title font-weight-semibold">Hanna Walden</a>
									<span class="d-block text-muted font-size-sm">Project manager</span>
								</div>
								<div class="ml-3 align-self-center"><span class="badge badge-mark border-success"></span></div>
							</li>

							<li class="media">
								<div class="mr-3">
									<img src="{{asset('public/frontend/global_assets/images/placeholders/placeholder.jpg')}}" width="36" height="36" class="rounded-circle" alt="">
								</div>
								<div class="media-body">
									<a href="#" class="media-title font-weight-semibold">Dori Laperriere</a>
									<span class="d-block text-muted font-size-sm">Business developer</span>
								</div>
								<div class="ml-3 align-self-center"><span class="badge badge-mark border-warning-300"></span></div>
							</li>

							<li class="media">
								<div class="mr-3">
									<img src="{{asset('public/frontend/global_assets/images/placeholders/placeholder.jpg')}}" width="36" height="36" class="rounded-circle" alt="">
								</div>
								<div class="media-body">
									<a href="#" class="media-title font-weight-semibold">Vanessa Aurelius</a>
									<span class="d-block text-muted font-size-sm">UX expert</span>
								</div>
								<div class="ml-3 align-self-center"><span class="badge badge-mark border-grey-400"></span></div>
							</li>
						</ul>
					</div>

					<div class="dropdown-content-footer bg-light">
						<a href="#" class="text-grey mr-auto">All users</a>
						<a href="#" class="text-grey"><i class="icon-gear"></i></a>
					</div>
				</div>
			</li>

			<li class="nav-item dropdown">
				<a href="#" class="navbar-nav-link dropdown-toggle caret-0" data-toggle="dropdown">
					<i class="icon-bubbles4"></i>
					<span class="d-md-none ml-2">Messages</span>
					<span class="badge badge-pill bg-warning-400 ml-auto ml-md-0">2</span>
				</a>
				
				<div class="dropdown-menu dropdown-menu-right dropdown-content wmin-md-350">
					<div class="dropdown-content-header">
						<span class="font-weight-semibold">Messages</span>
						<a href="#" class="text-default"><i class="icon-compose"></i></a>
					</div>

					<div class="dropdown-content-body dropdown-scrollable">
						<ul class="media-list">
							<li class="media">
								<div class="mr-3 position-relative">
									<img src="{{asset('public/frontend/global_assets/images/placeholders/placeholder.jpg')}}" width="36" height="36" class="rounded-circle" alt="">
								</div>

								<div class="media-body">
									<div class="media-title">
										<a href="#">
											<span class="font-weight-semibold">James Alexander</span>
											<span class="text-muted float-right font-size-sm">04:58</span>
										</a>
									</div>

									<span class="text-muted">who knows, maybe that would be the best thing for me...</span>
								</div>
							</li>

							<li class="media">
								<div class="mr-3 position-relative">
									<img src="{{asset('public/frontend/global_assets/images/placeholders/placeholder.jpg')}}" width="36" height="36" class="rounded-circle" alt="">
								</div>

								<div class="media-body">
									<div class="media-title">
										<a href="#">
											<span class="font-weight-semibold">Margo Baker</span>
											<span class="text-muted float-right font-size-sm">12:16</span>
										</a>
									</div>

									<span class="text-muted">That was something he was unable to do because...</span>
								</div>
							</li>

							<li class="media">
								<div class="mr-3">
									<img src="{{asset('public/frontend/global_assets/images/placeholders/placeholder.jpg')}}" width="36" height="36" class="rounded-circle" alt="">
								</div>
								<div class="media-body">
									<div class="media-title">
										<a href="#">
											<span class="font-weight-semibold">Jeremy Victorino</span>
											<span class="text-muted float-right font-size-sm">22:48</span>
										</a>
									</div>

									<span class="text-muted">But that would be extremely strained and suspicious...</span>
								</div>
							</li>

							<li class="media">
								<div class="mr-3">
									<img src="{{asset('public/frontend/global_assets/images/placeholders/placeholder.jpg')}}" width="36" height="36" class="rounded-circle" alt="">
								</div>
								<div class="media-body">
									<div class="media-title">
										<a href="#">
											<span class="font-weight-semibold">Beatrix Diaz</span>
											<span class="text-muted float-right font-size-sm">Tue</span>
										</a>
									</div>

									<span class="text-muted">What a strenuous career it is that I've chosen...</span>
								</div>
							</li>

							<li class="media">
								<div class="mr-3">
									<img src="{{asset('public/frontend/global_assets/images/placeholders/placeholder.jpg')}}" width="36" height="36" class="rounded-circle" alt="">
								</div>
								<div class="media-body">
									<div class="media-title">
										<a href="#">
											<span class="font-weight-semibold">Richard Vango</span>
											<span class="text-muted float-right font-size-sm">Mon</span>
										</a>
									</div>
									
									<span class="text-muted">Other travelling salesmen live a life of luxury...</span>
								</div>
							</li>
						</ul>
					</div>

					<div class="dropdown-content-footer justify-content-center p-0">
						<a href="#" class="bg-light text-grey w-100 py-2" data-popup="tooltip" title="Load more"><i class="icon-menu7 d-block top-0"></i></a>
					</div>
				</div>
			</li> -->

			<li class="nav-item dropdown dropdown-user">
				<a href="#" class="navbar-nav-link dropdown-toggle" data-toggle="dropdown">
					@if(Auth::user()->profile_photo)
					<img style="width:38px;height: 38px" src="{{url('public/uploads/sellers/profilephoto')}}/{{Auth::user()->profile_photo}}" class="rounded-circle profile-image" alt="profile-image" name="image">
					@else
					<img style="width:38px;height: 38px" src="{{url('public/uploads/sellers/profilephoto/nouser.jpg')}}" class="rounded-circle profile-image" alt="profile-image" name="image" width="38" height="38">
					@endif
					<span>{{Auth::user()->email}}</span>
				</a>

				<div class="dropdown-menu dropdown-menu-right">
					<!-- <a href="#" class="dropdown-item"><i class="icon-user-plus"></i> My profile</a>
					<a href="#" class="dropdown-item"><i class="icon-cog5"></i> Account settings</a> -->
					<a class="dropdown-item" href="{{ url('affiliates/logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();"><i class="icon-switch2"></i> {{ __('Logout') }}</a>
                    <form id="logout-form" action="{{ url('affiliates/logout') }}" method="POST" style="display: none;">
                         @csrf
                    </form>
				</div>
			</li>
		</ul>
	</div>
</div>