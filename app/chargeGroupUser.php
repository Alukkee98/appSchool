<?php
	
	$group_user_id = $_SESSION['group_user_id'];
	$sqlUserProfile = $conn->prepare('SELECT * FROM group_user WHERE group_user_id = :group_user_id ');
	$sqlUserProfile->bindParam(':group_user_id', $group_user_id);

	$sqlUserProfile->execute();
	$results = $sqlUserProfile->fetchAll();
	
	$totalRow = $sqlUserProfile->rowCount();
    
    if ($totalRow > 0) {
      //Correr el array
    	foreach($results as $row){
			$_SESSION['group_cod'] = $row['GROUP_COD'];
			$_SESSION['group_user_name'] = $row['DESCRIPCION'];
		}
	}
	
?> 