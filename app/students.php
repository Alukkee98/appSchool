<?php
	
  session_start();
  
  require 'includes/database.php';
  require 'session.php';
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

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>AdmSchool - Students</title>

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
            <h1 class="h3 mb-0 text-gray-800">Students</h1>
			      <a class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" href="#" data-toggle="modal" data-target="#createStudentModal">
              <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
				      Create a Student
            </a>
		</div>
		  
          <!-- Page Heading -->
          <!-- Content Row -->
          <div class="row">

            <!-- Earnings (Monthly) Card Example -->
            
			<?php

if($_SESSION['group_user_id'] != 1){
  $consulta = "SELECT * FROM students WHERE id_class in ( 
                            SELECT id_class FROM subjects 
                            where id_subject in (
                                        select id_subject from rel_user_subjects where id_user = :id_user
                                                )     
                            )";
}else{
  $consulta = "SELECT * FROM students";
}

$sqlStudentsView = $conn->prepare($consulta);
$sqlStudentsView->bindParam(':id_user', $id_user,PDO::PARAM_INT);

$sqlStudentsView->execute();
$results = $sqlStudentsView->fetchAll();

if($sqlStudentsView->rowCount() > 0){
  foreach($results as $row){
						echo '
						<div class="col-xl-3 col-md-6 mb-4">
						  <div class="card shadow h-100 py-2">
							<div class="card-body">
							  <div class="row no-gutters align-items-center">
								<div class="col mr-2">
									<a href="students-detail.php" onclick="'.$_SESSION['id_class']= $row['ID_CLASS'].'" >
									  <div class="text-xs font-weight-bold text-primary text-uppercase mb-2">
										<input type="hidden" name="class" id="class">
										'.$row['SURNAME'].'  '.$row['SURNAME2'].',  '.$row['NAME'].'
									  </div>
									</a>
								</div>
								<div class="col-auto">
								  <i class="fas fa-chalkboard-teacher fa-2x text-gray-300"></i>
								</div>
							  </div>
							</div>
						  </div>
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
          <a class="btn btn-primary" href="logout.php">Logout</a>
        </div>
      </div>
    </div>
  </div>

   <!-- Create a Student Modal-->
   <div class="modal fade" id="createStudentModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Create a student</h5>
        </div>
        <div class="modal-body">
        <form method="POST" autocomplete="off">
                 <dd><strong>Name</strong> </dd> 
                 <dl>
                     <input type="text" class="form-control form-control-user" id="student_name" name="student_name" placeholder="Alejandro"   >
                 </dl>
                 
                 <dd><strong>Surname</strong> </dd> 
                 <dl>
                 <input type="text" class="form-control form-control-user" id="student_surname" name="student_surname" placeholder="Rodríguez"   >
                 </dl>

                 <dd><strong></strong> </dd> 
                 <dl>
                   <input type="text" class="form-control form-control-user" id="student_surname2" name="student_surname2" placeholder="Pérez" >
                 </dl> 

                 <select class="form-control form-control-sm" id="student_class" name="student_class">
                      <option value="">Select Class</option>
                      <?php 
                      	require 'chargeClassSelect.php';
                      ?>
                  </select>

		    </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>		  
          <input type="submit" class="btn btn-primary" name="createStudent" value="Create">					
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
