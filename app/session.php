<?php
	  
  require 'includes/db.php';

  if (isset($_SESSION['id_user'])) {
	  //Cargar datos user
	  $_SESSION['id_user'];
  }else{
	   header('Location: login.php');
  }							
			
?>