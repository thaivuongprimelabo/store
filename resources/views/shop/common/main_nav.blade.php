<div class="navbar">
	<div class="navbar-inner">
		<div class="container">
			<a data-target=".nav-collapse" data-toggle="collapse"
				class="btn btn-navbar"> <span class="icon-bar"></span> <span
				class="icon-bar"></span> <span class="icon-bar"></span>
			</a>
			<div class="nav-collapse">
				<ul class="nav">
					{!! Utils::createMainNav() !!}
				</ul>
				
				<ul class="nav pull-right" style="margin-right: 5px">
					<li class="dropdown">
						<form action="#" class="navbar-search pull-right">
        					<input type="text" placeholder="{{ trans('shop.search_txt') }}"
        						class="search-query span2">
        				</form>
<!-- 						<a data-toggle="dropdown" -->
<!-- 						class="dropdown-toggle" href="#"><span class="icon-lock"></span> -->
<!-- 							Login <b class="caret"></b></a> -->
<!-- 						<div class="dropdown-menu"> -->
<!-- 							<form class="form-horizontal loginFrm"> -->
<!-- 								<div class="control-group"> -->
<!-- 									<input type="text" class="span2" id="inputEmail" -->
<!-- 										placeholder="Email"> -->
<!-- 								</div> -->
<!-- 								<div class="control-group"> -->
<!-- 									<input type="password" class="span2" id="inputPassword" -->
<!-- 										placeholder="Password"> -->
<!-- 								</div> -->
<!-- 								<div class="control-group"> -->
<!-- 									<label class="checkbox"> <input type="checkbox"> Remember me -->
<!-- 									</label> -->
<!-- 									<button type="submit" class="shopBtn btn-block">Sign in</button> -->
<!-- 								</div> -->
<!-- 							</form> -->
<!-- 						</div> -->
					</li>
				</ul>
			</div>
		</div>
	</div>
</div>