<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" autocomplete="off">
	<div class="search_input_wrapper">
		<input type="search" name="searchbar" placeholder="Search" id="searchbar">
		<span id="search_close">
			<i class="fa-solid fa-xmark"></i>
		</span>
	</div>
	<div class="form-submit">
		<input type="submit" value="" name="searchbtn" id="searchbtn">
		<i class="fa-solid fa-magnifying-glass"></i>
	</div>
	<div id="query_result" class=""></div>
</form>