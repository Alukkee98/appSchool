<?php
	  
  require 'includes/database.php';
  require 'chargeGroupUser.php';

	
  $message  = '';

  if (!empty(isset($_POST['createStudent']))) {
    try{   
      $consulta = "INSERT INTO students( NAME, SURNAME, SURNAME2, ID_CLASS,ESTAT) VALUES (:student_name , :student_surname, :student_surname2, :student_class , 1) ";
      $sqlcreateStudent = $conn->prepare($consulta);
      $sqlcreateStudent->bindParam(':student_name', $_POST['student_name'] ,PDO::PARAM_STR);
      $sqlcreateStudent->bindParam(':student_surname', $_POST['student_surname'] ,PDO::PARAM_STR);      
      $sqlcreateStudent->bindParam(':student_surname2', $_POST['student_surname2'] ,PDO::PARAM_STR);
      $sqlcreateStudent->bindParam(':student_class', $_POST['student_class'] ,PDO::PARAM_INT);


      $sqlcreateStudent->execute();
      if($sqlcreateStudent->rowCount() > 0){ 
        echo "<div class='content alert alert-primary' >Student created</div>";
    }
  }catch(PDOException $error) {
    echo $sqlcreateCourses . "<br>" . $error->getMessage();
  }
}

?>