<?php
	
  session_start();
  
  require 'includes/database.php';
  require 'session.php';


  $message  = '';
  

	if (!empty(isset($_POST['createClass']))) {
    try{   
      $consulta = "INSERT INTO classes( CLASS_NAME, COD_CLASS, COLOR, ID_USER) VALUES (:class_name , :class_cod, :class_color , :id_user) ";
      $sqlcreateCourses = $conn->prepare($consulta);
      $sqlcreateCourses->bindParam(':class_name', $_POST['class_name'] ,PDO::PARAM_STR);
      $sqlcreateCourses->bindParam(':class_cod', $_POST['class_cod'] ,PDO::PARAM_STR);      
      $sqlcreateCourses->bindParam(':class_color', $_POST['class_color'] ,PDO::PARAM_STR);
      $sqlcreateCourses->bindParam(':id_user', $id_user ,PDO::PARAM_INT);

      $sqlcreateCourses->execute();
      if($sqlcreateCourses->rowCount() > 0){ 
        echo "<div class='content alert alert-primary' >Class created</div>";
        /*
        $sqlRelacioClassTeacherConsulta = "SELECT MAX(ID_CLASS) AS id_class FROM classes ";
        $sqlRelacioClassTeacher = $conn->prepare($sqlRelacioClassTeacherConsulta);
        $sqlRelacioClassTeacher->execute();
        $results = $sqlRelacioClassTeacher->fetchAll();
        
        echo "<div class='content alert alert-primary' >La clase ha sido creada es idenificada</div>";
        */
        /*if($sqlRelacioClassTeacher->rowCount() > 0){
          foreach($results as $row){
              $id_class = $row['id_class'];
             // echo "<div class='content alert alert-danger' > CLASE". $row['id_class'] ."   </div>";

              $sqlcreateCoursesConsulta = "INSERT INTO rel_user_classes( ID_USER, ID_CLASS ) VALUES (:id_user , :id_class) ";
              $sqlcreateCourses = $conn->prepare($sqlcreateCoursesConsulta);
              $sqlcreateCourses->bindParam(':id_user', $id_user ,PDO::PARAM_INT);
              $sqlcreateCourses->bindParam(':id_class', $id_class ,PDO::PARAM_INT);
              $sqlcreateCourses->execute();
             //echo "<div class='content alert alert-primary' >La clase ha sido relacionada con el profesor</div>";

          }
          
      }*/
      
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

  <title>AdmSchool - Classes</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">
  
    <!-- Custom styles for this page -->
  <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">
	
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
            <h1 class="h3 mb-0 text-gray-800">Classes</h1>
			      <a class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" href="#" data-toggle="modal" data-target="#createCourseModal">
              <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
				      Create a Class
            </a>
        </div>
		  
          <!-- Page Heading -->
          <!-- Content Row -->
        <div class="row">

            <!-- Classes -->
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
          echo '
            <div class="col-xl-3 col-md-6 mb-4">
            <a href="class-detail.php?ID_CLASS='.$row['ID_CLASS'].'">
						  <div class="card shadow h-100 py-2" style="border-left:.25rem solid '.$row['COLOR'].' !important">
							<div class="card-body">
							  <div class="row no-gutters align-items-center">
								<div class="col mr-2">
                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-2">
										'.$row['CLASS_NAME'].'
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
          <a class="btn btn-primary" href="logout.php">Logout</a>
        </div>
      </div>
    </div>
  </div>
  
   <!-- Create a Course Modal-->
  <div class="modal fade" id="createCourseModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Create a class</h5>
        </div>
        <div class="modal-body">
        <form method="POST" autocomplete="off">
                 <dd><strong>Name</strong> </dd> 
                 <dl>
                     <input type="text" class="form-control form-control-user" id="class_name" name="class_name" placeholder="Primero A"   >
                 </dl>
                 
                 <dd><strong>Code Class</strong> </dd> 
                 <dl>
                 <input type="text" class="form-control form-control-user" id="class_cod" name="class_cod" placeholder="1A"   >
                 </dl>

                 <!--ALP 
                 <dd><strong>Password</strong> </dd> 
                 <dl>
                   <input type="password" class="form-control form-control-user" id="class_password" name="class_password" value="12345678910" >
                 </dl> 
                 -->
                 <dd><strong>Color</strong> </dd> 
                 <dl> 
                    <input type="color" class="form-control-color" id="class_color" name="class_color" />
                 </dl>
		    </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>		  
          <input type="submit" class="btn btn-primary" name="createClass" value="Create">					
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
