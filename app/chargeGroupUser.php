<?php
	
	$group_user_id = $_SESSION['group_user_id'];
	
	$sqlUserProfile = "SELECT * FROM group_user WHERE group_user_id = '$group_user_id' ";
	$result = mysqli_query($connexion, $sqlUserProfile);

	if($row = mysqli_fetch_array($result)){	
		$_SESSION['group_cod'] = $row['GROUP_COD'];
		$_SESSION['group_user_name'] = $row['DESCRIPCION'];
	}
	
?>