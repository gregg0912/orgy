<?php
	$prompt="blank";
	$host="localhost";
	$username="root";
	$password="";
	$db="org_y";
	$connectdb=mysqli_connect($host, $username, $password, $db) or die(mysqli_error($dbconn));

	function connection(){
		global $prompt, $host, $username, $password, $db, $connectdb;
		mysqli_select_db($connectdb, $db);
		return $connectdb;
	}

	function select($uname, $pword){
		global $prompt, $host, $username, $password, $db, $connectdb;
		$select="SELECT * FROM user WHERE username='$uname' AND password='$pword'";
		$query=mysqli_query($connectdb, $select);
		return $query;
	}

	function checker($uname, $pword){
		$number=mysqli_num_rows(select($uname, $pword));
		return $number;
	}

	function querySignUp($query){
		global $connectdb;
		return mysqli_query($connectdb, $query);
	}

	function groupListQuery($userid, $start, $limit, $dbconn){
		$query = "SELECT orgs.org_id,orgs.org_name, orgs.photo, joined.membership_type
				FROM joined, orgs
				WHERE joined.user_id = $userid AND joined.org_id = orgs.org_id
				ORDER BY joined.membership_type
				LIMIT $start, $limit";
		return mysqli_query($dbconn, $query);
	}

	function detMemType($memType){
		if ($memType=="admin") {
			return "ADMIN";
		}elseif ($memType=="member") {
			return "MEMBER";
		}return "PENDING";
	}

	function affected(){
		global $connectdb;
		return mysqli_affected_rows($connectdb);
	}

	function redirect(){
		if(!isset($_SESSION['user_id'])){
        	header("Location: login.php");
    	}
	}

	function redirect2(){
		if(isset($_SESSION['user_id'])){
			header("Location: home.php");
		}
	}

	function elipse($string){
		if(strlen($string)<14){
			echo $string;
		}
		else{
			echo substr($string, 0, 14) . "...";
		}
	}
	/**
	* Displays pagination links based on given parameters
	*
	* @param int $currentPage - current page
	* @param int $itemCount - number of items to paginate, used to calculate total number of pages
	* @param int $itemsPerPage - number of items per page, used to calculate total number of pages
	* @param int $adjacentCount - half the number of page links displayed adjacent to the current page
	* @param (string|callable) $pageLinkTemplate - pagination URL string containing %d placeholder or a callable function that accepts page number and returns page URL
	* @param boolean $showPrevNext - whether to show previous and next page links
	* @return void
	*/
	function pagination($currentPage, $itemCount, $itemsPerPage, $adjacentCount, $pageLinkTemplate, $showPrevNext = true) {
		$firstPage = 1;
		$lastPage  = ceil($itemCount / $itemsPerPage);
		if ($lastPage == 1) {
			return;
		}
		if ($currentPage <= $adjacentCount + $adjacentCount) {
			$firstAdjacentPage = $firstPage;
			$lastAdjacentPage  = min($firstPage + $adjacentCount + $adjacentCount, $lastPage);
		} elseif ($currentPage > $lastPage - $adjacentCount - $adjacentCount) {
			$lastAdjacentPage  = $lastPage;
			$firstAdjacentPage = $lastPage - $adjacentCount - $adjacentCount;
		} else {
			$firstAdjacentPage = $currentPage - $adjacentCount;
			$lastAdjacentPage  = $currentPage + $adjacentCount;
		}
		echo '<ul style="clear:both; bottom:0;" class="pagination" id="pagination">';
		if ($showPrevNext) {
			if ($currentPage == $firstPage) {
				echo '<li><span><span class="glyphicon glyphicon-triangle-left"></span></span></li>';
			} else {
				echo '<li><a href="' . (is_callable($pageLinkTemplate) ? $pageLinkTemplate($currentPage - 1) : sprintf($pageLinkTemplate, $currentPage - 1)) . '"><span class="glyphicon glyphicon-triangle-left"></span></a></li>';
			}
		}
		if ($firstAdjacentPage > $firstPage) {
			echo '<li><a href="' . (is_callable($pageLinkTemplate) ? $pageLinkTemplate($firstPage) : sprintf($pageLinkTemplate, $firstPage)) . '">' . $firstPage . '</a></li>';
			if ($firstAdjacentPage > $firstPage + 1) {
				echo '<li><span>...</span></li>';
			}
		}
		for ($i = $firstAdjacentPage; $i <= $lastAdjacentPage; $i++) {
			if ($currentPage == $i) {
				echo '<li><span><b>' . $i . '</b></span></li>';
			} else {
				echo '<li><a href="' . (is_callable($pageLinkTemplate) ? $pageLinkTemplate($i) : sprintf($pageLinkTemplate, $i)) . '">' . $i . '</a></li>';
			}
		}
		if ($lastAdjacentPage < $lastPage) {
			if ($lastAdjacentPage < $lastPage - 1) {
				echo '<li><span>...</span></li>';
			}
			echo '<li><a href="' . (is_callable($pageLinkTemplate) ? $pageLinkTemplate($lastPage) : sprintf($pageLinkTemplate, $lastPage)) . '">' . $lastPage . '</a></li>';
		}
		if ($showPrevNext) {
			if ($currentPage == $lastPage) {
				echo '<li><span><span class="glyphicon glyphicon-triangle-right"></span></span></li>';
			} else {
				echo '<li><a href="' . (is_callable($pageLinkTemplate) ? $pageLinkTemplate($currentPage + 1) : sprintf($pageLinkTemplate, $currentPage + 1)) . '"><span class="glyphicon glyphicon-triangle-right"></span></a></li>';
			}
		}
		echo '</ul>';
	}
?>