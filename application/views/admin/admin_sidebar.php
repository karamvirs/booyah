<div class="page-sidebar nav-collapse collapse">
			<!-- BEGIN SIDEBAR MENU -->        	
			<ul>
				<li>
					<!-- BEGIN SIDEBAR TOGGLER BUTTON -->
					<div class="sidebar-toggler hidden-phone"></div>
					<!-- BEGIN SIDEBAR TOGGLER BUTTON -->
				</li>
			
				<li class="start active ">
					<a href="<?php echo base_url(); ?>admin">
					<i class="icon-home"></i> 
					<span class="title">Dashboard</span>
					<span class="selected"></span>
					</a>
				</li>
				<li class="has-sub ">
					<a href="javascript:;">
					<i class="icon-bookmark-empty"></i> 
					<span class="title">Reddit</span>
					<span class="arrow"></span>
					</a>
					<ul class="sub">
						
						<li ><a href="<?php echo base_url(); ?>admin/fetch_reddit/showPosts">All Posts</a></li>						
						<li ><a href="<?php echo base_url(); ?>admin/fetch_reddit/search_reddit">Search Reddit</a></li>						
						<!--li ><a href="<?php echo base_url(); ?>admin/fetch_reddit/recentData">Recent Gifs</a></li>
						<li ><a href="<?php echo base_url(); ?>admin/fetch_reddit">Old GIFs</a></li-->
						
					</ul>
				</li>
				
				<li class="has-sub ">
					<a href="javascript:;">
					<i class="icon-table"></i> 
					<span class="title">Advertisements</span>
					<span class="arrow "></span>
					</a>
					<ul class="sub">
						<li ><a href="<?php echo base_url(); ?>admin/advertisements">All Advertisements</a></li>
						<li ><a href="<?php echo base_url(); ?>admin/advertisements/add_advertisement">Add a Advertisements</a></li>
						
					</ul>
				</li>
				
				<li class="has-sub ">
					<a href="javascript:;">
					<i class="icon-home"></i> 
					<span class="title">Subreddits</span>
					<span class="arrow "></span>
					</a>
					<ul class="sub">
						<li ><a href="<?php echo base_url(); ?>admin/fetch_reddit/showSubreddits">All Subreddits</a></li>
						<!--li ><a href="<?php echo base_url(); ?>admin/advertisements/add_subreddits">Add a Advertisements</a></li-->
						
					</ul>
				</li>
				
				<li class="has-sub ">
					<a href="javascript:;">
					<i class="icon-home"></i> 
					<span class="title">Comments</span>
					<span class="arrow "></span>
					</a>
					<ul class="sub">
						<li ><a href="<?php echo base_url(); ?>admin/comments">All commetns</a></li>
						<li ><a href="<?php echo base_url(); ?>admin/comments/addComment">Add a comment</a></li>
						
					</ul>
				</li>
				<li class="has-sub ">
					<a href="javascript:;">
					<i class="icon-bookmark-empty"></i> 
					<span class="title">Manage Users</span>
					<span class="arrow"></span>
					</a>
					<ul class="sub">
						
						<li ><a href="<?php echo base_url(); ?>admin/users">All Users</a></li>						
						<li ><a href="<?php echo base_url(); ?>admin/users/add_user">Add user</a></li>						
						<li ><a href="<?php echo base_url(); ?>admin/users/permission">Permissions</a></li>											
						
					</ul>
				</li>
				
				
			</ul>
			<!-- END SIDEBAR MENU -->
		</div>
