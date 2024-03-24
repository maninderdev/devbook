
<div class="header-search">
	<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" autocomplete="off">
		<div class="search_input_wrapper">
			<input type="search" name="searchbar" placeholder="Search" id="searchbar">
			<span id="search_close">
				<i class="fa-solid fa-xmark"></i>
			</span>
		</div>
		<div id="query_result" class=""></div>
	</form>
	<div class="header-user">
		<div class="admin-name">
			<p>👋 Hey, Adela</p>
		</div>
		<div class="user-profile-wrapper dropdown-wrapper">
			<button class="btn user-drop-toggle" title="AP">AP</button>
			<div class="dropdown user-dropdown" style="display: none;">
				<ul class="dropdown-list">
					<li class="dropdown-item">
						<a href="#">Profile Settings</a>
					</li>
					<li class="dropdown-item">
						<a href="#">Newsletter Settings</a>
					</li>
					<li class="dropdown-item">
						<a href="#">Log out</a>
					</li>
				</ul>
			</div>
		</div>
	</div>
</div>