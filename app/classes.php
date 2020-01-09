<?php
	
  session_start();
  
  require 'database.php';

  if (isset($_SESSION['id_user'])) {
	  //Cargar datos user
	  $_SESSION['id_user'];
	  $id_user = $_SESSION['id_user'];
  }else{
	  header('Location: login.php');
  }							
			
	
  $message  = '';
  
  $name = '';
  $code ='';
  $color ='';
	
/*if ( !empty($_POST['name']) && !empty($_POST['code']) && !empty($_POST['color'])  ) {
	
	$name = $_POST['name'];
	$code = $_POST['code'];
	$color = $_POST['color'];
	
	$sqlCourses = "INSERT INTO classes( NAME, COD_CLASS, COLOR) VALUES ('$name' , '$code', '$color') ";
	$result = $connexion->query($sqlCourses);
	header("Refresh:0; url=index.php");
	
}*/

if ( !empty($_POST['selectClass']) ) {
  
	$selectClass = $_POST['selectClass'];
	$passwordClass = $_POST['passwordClass'];
  
  $sqlCoursePass = "SELECT * FROM classes WHERE ID_CLASS = '$selectClass' AND PASSWORD = '$passwordClass' ";
  $result = $connexion->query($sqlCoursePass);
  
  if($result->num_rows>0){
    while($row = $result->fetch_assoc()) {
    $sqlJoinCourse = "INSERT INTO rel_user_classes( ID_USER, ID_CLASS) VALUES ( '$id_user', '$selectClass') ";
    $result = $connexion->query($sqlJoinCourse);
    header("Refresh:0; url=classes.php");
    }
  }else{
    $message = 'The password is incorrectly' ;
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
			      <a class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" href="#" data-toggle="modal" data-target="#joinCourseModal">
              <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
				      Join up Class
            </a>
        </div>
		  
          <!-- Page Heading -->
          <!-- Content Row -->
        <div class="row">

            <!-- Classes -->
			<?php
			if($_SESSION['group_user_id'] != 1){
				$sqlCoursesView = "SELECT * FROM classes WHERE id_class in ( SELECT id_class FROM rel_user_classes WHERE id_user = '$id_user' )";
			}else{
				$sqlCoursesView = "SELECT * FROM classes";
			}
				$result = $connexion->query($sqlCoursesView);
				if($result->num_rows>0){
					while($row = $result->fetch_assoc()) {
						echo '
						<div class="col-xl-3 col-md-6 mb-4">
						  <div class="card shadow h-100 py-2" style="border-left:.25rem solid #'.$row['COLOR'].' !important">
							<div class="card-body">
							  <div class="row no-gutters align-items-center">
								<div class="col mr-2">
                  <a href="class-detail.php?ID_CLASS='.$row['ID_CLASS'].'">
                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-2">
										'.$row['NAME'].'
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
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; Your Website 2019</span>
          </div>
        </div>
      </footer>
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
  
   <!-- Join Up to Course Modal-->
  <div class="modal fade" id="joinCourseModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Join Up to class</h5>
        </div>
        <div class="modal-body">
			<form class="user" action="classes.php" method="POST" autocomplete="off">
				  <div>
            <select class="form-control form-control-sm" id="selectClass" name="selectClass">
						  <option value="">Select</option>
              <?php 
               $sqlCoursesList = "SELECT * FROM classes";
               $result = $connexion->query($sqlCoursesList);
              if($result->num_rows>0){
               while($row = $result->fetch_assoc()) {
                echo '<option value="'.$row[ID_CLASS].'">'.$row['NAME'].'</option>
                      ';
               }
              }
              ?>
					</select>
          </div> 
          <div>
            <input type="password" class="form-control form-control-sm" id="passwordClass" name="passwordClass" placeholder="Password Course" >
          </div>
		</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>		  
		  	<input type="submit" class="btn btn-primary btn-user btn-block" id="joinClasses" value="Join to Class">					
			</form>
        </div>
      </div>
    </div>
  </div>

    <!-- Course Modal-->
    <div class="modal fade" id="addCourseModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">New Class</h5>
        </div>
        <div class="modal-body">
			<form class="user" action="index.php" method="POST" autocomplete="off">
				 <div>
                    <input type="text" class="form-control form-control-sm" id="name" name="name" placeholder="Primero A" >
                  </div>
                  <div>
                    <input type="text" class="form-control form-control-sm" id="code" name="code" placeholder="1A">
                  </div> 
				  <div>
					<select class="form-control form-control-sm" id="color" name="color">
						<option value="">Select</option>
						<option value="US">United States</option>
						<option value="UK">United Kingdom</option>
						<option value="France">France</option>
						<option value="Mexico">Mexico</option>
						<option value="Russia">Russia</option>
						<option value="Japan">Japan</option>
					</select>
          </div> 
		</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>		  
		  	<input type="submit" class="btn btn-primary btn-user btn-block" id="index" value="Save Class">					
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
