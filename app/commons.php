<?php
  require 'includes/db.php';
  
if (isset($_SESSION['id_user'])) {
	//Cargar datos user
	$id_user = $_SESSION['id_user'];
}else{
   header('Location: /app/login.php');
}	

public function update($table,$variable1,$variable2, $id){
	$sql = "UPDATE '$table' SET '$variable1'='$variable2' WHERE id=$id";
	$res = mysqli_query($this->con, $sql);
}

?>