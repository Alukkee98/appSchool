<?php 
	if($_SESSION['group_user_id'] != 1){
	  $consulta = "SELECT * FROM classes WHERE id_class in ( 
						  SELECT id_class FROM subjects 
						  where id_subject in (
									  select id_subject from rel_user_subjects where id_user = :id_user
											  )     
						  ) or id_user  in (:id_user)";
	}else{
	  $consulta = "SELECT * FROM classes";
	}
	
	$sqlCoursesView = $conn->prepare($consulta);
	$sqlCoursesView->bindParam(':id_user', $id_user,PDO::PARAM_INT);
	
	$sqlCoursesView->execute();
	$results = $sqlCoursesView->fetchAll();

	if($sqlCoursesView->rowCount() > 0){
	  foreach($results as $row){
	  echo '<option value="'.$row[ID_CLASS].'">'.$row['COD_CLASS'].' - '.$row['CLASS_NAME'].'</option>
			';
	}
	}
?> 