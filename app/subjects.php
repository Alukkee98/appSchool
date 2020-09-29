<?php
	
  session_start();
  
  require 'includes/database.php';
  require 'session.php';			
  require 'chargeGroupUser.php';
		
  $message  = '';

  
	if (!empty(isset($_POST['createSubject']))) {
    try{   
      $consulta = "INSERT INTO subjects (NAME, ID_CLASS) VALUES (:subject_name , :id_class)  ";
      $sqlcreateSubject = $conn->prepare($consulta);
    
      $sqlcreateSubject->bindParam(':subject_name', $_POST['subject_name'] ,PDO::PARAM_STR);
      $sqlcreateSubject->bindParam(':id_class', $_POST['subject_class']  ,PDO::PARAM_INT);


      $sqlcreateSubject->execute();
      if($sqlcreateSubject->rowCount() > 0){ 
        echo "<div class='content alert alert-primary' >Subject created</div>";
      
        $sqlRelacioSubjectTeacherConsulta = "SELECT MAX(ID_SUBJECT) AS id_subject FROM subjects ";
        $sqlRelacioSubjectTeacher = $conn->prepare($sqlRelacioSubjectTeacherConsulta);
        $sqlRelacioSubjectTeacher->execute();
        $results = $sqlRelacioSubjectTeacher->fetchAll();
        
        //echo "<div class='content alert alert-primary' >La subject ha sido creada es idenificada</div>";
        
        if($sqlRelacioSubjectTeacher->rowCount() > 0){
          foreach($results as $row){
              $id_subject = $row['id_subject'];
             // echo "<div class='content alert alert-danger' > CLASE". $row['id_class'] ."   </div>";

              $sqlcreateCoursesConsulta = "INSERT INTO rel_user_subjects( ID_USER, ID_SUBJECT ) VALUES (:id_user , :id_subject) ";
              $sqlcreateCourses = $conn->prepare($sqlcreateCoursesConsulta);
              $sqlcreateCourses->bindParam(':id_user', $id_user ,PDO::PARAM_INT);
              $sqlcreateCourses->bindParam(':id_subject', $id_subject ,PDO::PARAM_INT);
              $sqlcreateCourses->execute();
             //echo "<div class='content alert alert-primary' >La subject ha sido relacionada con el profesor</div>";

          }
          
      }
      
    }
  }catch(PDOException $error) {
    echo $sqlcreateSubject . "<br>" . $error->getMessage();
  }
    
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>AdmSchool - Subjects</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">
	<?php if(!empty($message)): ?>
      <div class="message"> <?= $message ?> </div>
    <?php endif;	?>
	
	<!-- Page Sidebar -->
	<?php 
		require 'sidebar.php';
	?>

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

       <!-- Page Topbar -->
		<?php 
			require 'topbar.php';
		?>

         <!-- Begin Page Content -->
         <div class="container-fluid">
        <?php if(!empty($message)): ?>
          <div class="message"> <?= $message ?> </div>
        <?php endif;	?>
		    <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Subjects</h1>
			      <a class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" href="#" data-toggle="modal" data-target="#createSubjectModal">
              <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
				      Create a Subject
            </a>
        </div>
		  
          <!-- Page Heading -->
          <!-- Content Row -->
          <div class="row">

            <!-- Subjects -->
			<?php


if($_SESSION['group_user_id'] != 1){
  $consulta = "SELECT * FROM subjects s
               INNER JOIN classes c ON c.id_class = s.id_class where id_subject in ( select id_subject from rel_user_subjects where id_user = :id_user)
               ORDER BY c.id_class ASC";
  
  $sqlSubjectsView = $conn->prepare($consulta);
  $sqlSubjectsView->bindParam(':id_user', $id_user,PDO::PARAM_INT);

}else{
  $consulta = "SELECT * FROM subjects s
              INNER JOIN classes c ON c.id_class = s.id_class
              ORDER BY c.id_class ASC";
  
  $sqlSubjectsView = $conn->prepare($consulta);

}


$sqlSubjectsView->execute();
$results = $sqlSubjectsView->fetchAll();

if($sqlSubjectsView->rowCount() > 0){
  foreach($results as $row){
						echo '
            <div class="col-xl-3 col-md-6 mb-4">
            <a href="subject-detail.php?ID_CLASS='.$row['ID_CLASS'] .'&' .'ID_SUBJECT='.$row['ID_SUBJECT'].'">
						  <div class="card shadow h-100 py-2" style="border-left:.25rem solid '.$row['COLOR'].' !important">
							<div class="card-body">
							  <div class="row no-gutters align-items-center">
								<div class="col mr-2">
									  <div class="text-xs font-weight-bold text-primary text-uppercase mb-2">
										<input type="hidden" name="class" id="class">
										'.$row['NAME'] . ' - ' .$row['CLASS_NAME'].'
									  </div>
								</div>
								<div class="col-auto">								  
								  <i class="fas fa-chalkboard-teacher fa-2x text-gray-300"></i>
								</div>
							  </div>
							</div>
              </div>
              </a>
						</div>';
						
					}
				}
			?>
            
            

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      <!-- Page Footer -->
		<?php 
			require 'footer.php';
		?>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="logout.php">Logut</a>
        </div>
      </div>
    </div>
  </div>

  
   <!-- Create a Course Modal-->
   <div class="modal fade" id="createSubjectModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Create a subject</h5>
        </div>
        <div class="modal-body">
        <form method="POST" autocomplete="off">
                 <dd><strong>Name</strong> </dd> 
                 <dl>
                     <input type="text" class="form-control form-control-user" id="subject_name" name="subject_name" placeholder="Introduce the subject name"   >
                 </dl>
                
                <!-- <dd><strong>Password</strong> </dd> 
                 <dl>
                   <input type="password" class="form-control form-control-user" id="class_password" name="class_password" value="12345678910" >
                 </dl> -->

                 <dd><strong>Class</strong> </dd> 
                 <select class="form-control form-control-sm" id="subject_class" name="subject_class">
                      <option value="">Select Class</option>
                      <?php 
                      	require 'chargeClassSelect.php';
                      ?>
                  </select>

		    </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>		  
          <input type="submit" class="btn btn-primary" name="createSubject" value="Create">					
			</form>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>

  <!-- Page level plugins -->
  <script src="vendor/chart.js/Chart.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="js/demo/chart-area-demo.js"></script>
  <script src="js/demo/chart-pie-demo.js"></script>

</body>

</html>
