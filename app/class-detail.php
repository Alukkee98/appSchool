<?php
	
  session_start();
  
  
  require 'includes/database.php';
  require 'session.php';			
  require 'students-function.php';

	
  $message  =  '' ;
  
?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>AdmSchool - Class Detail</title>

  <!-- Custom fonts for this template -->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template -->
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
            <h1 class="h3 mb-0 text-gray-800">Students</h1>
			      <a class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" href="#" data-toggle="modal" data-target="#createStudentModal">
              <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
				      Create a Student
            </a>
		</div>
       
          <!-- Page Heading -->

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">
              <?php
                    $consulta = "SELECT * FROM classes WHERE ID_CLASS = :id_class";
                    
                    $sqlClassesName = $conn->prepare($consulta);
                    $sqlClassesName->bindParam(':id_class', $_GET["ID_CLASS"],PDO::PARAM_INT);
                    
                    $sqlClassesName->execute();

                    $results = $sqlClassesName->fetchAll();

                    foreach($results as $row){
                      echo ''. $row['CLASS_NAME'];
                    }                  
              ?>
             </h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width ="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Id</th>
                      <th>Name</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  
                  <tbody>
                    <?php
                    $consulta = "SELECT * FROM students WHERE ID_CLASS = :id_class";
                    
                    $sqlStudentsTable = $conn->prepare($consulta);
                    $sqlStudentsTable->bindParam(':id_class', $_GET["ID_CLASS"],PDO::PARAM_INT);
                    
                    $sqlStudentsTable->execute();
                    $results = $sqlStudentsTable->fetchAll();
                    
                    $cont = 1;
                    if($sqlStudentsTable->rowCount() > 0){
                      foreach($results as $row){
                      echo '
                      <tr>
                      <td align="center" >'.$cont.'</td>  
                        <td>'.$row['SURNAME'].'  '.$row['SURNAME2'].', '.$row['NAME'].'</td>
                        <td align="center" >
                          <a href="#" class="btn-edit btn-circle btn-sm">
                              <i class="fas fa-edit"></i>
                          </a>
                          &nbsp; &nbsp; &nbsp;
                          <a class="btn-danger btn-circle btn-sm" href="#" data-toggle="modal" data-target="#deleteModal">
                              <i class="fas fa-trash"></i>
                          </a>
                        </td>
                      </tr>
                      ';
                      $cont++;
                      }
					         
					  echo '
					  <tr>
                      <td align="center" >'.$cont.'</td>
                        <td></td>
                        <td align="center" >
                        </td>
                      </tr>';
                    }else{
                      echo 'No students in this class'
                      ;
                    }
                  ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>

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
          <a class="btn btn-primary" href="login.php">Logout</a>
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
                     <input type="text" class="form-control form-control-user" id="student_name" name="student_name" placeholder="Introduce student name"   >
                 </dl>
                 
                 <dd><strong>Surname</strong> </dd> 
                 <dl>
                 <input type="text" class="form-control form-control-user" id="student_surname" name="student_surname" placeholder="Introduce first Surname"   >
                 </dl>

                 <dd><strong></strong> </dd> 
                 <dl>
                   <input type="text" class="form-control form-control-user" id="student_surname2" name="student_surname2" placeholder="Introduce second Surname"	 >
                 </dl> 

                 <select  readonly="true" class="form-control form-control-sm" id="student_class" name="student_class">
                     <?php 
					 echo ' <option value="'.$_GET["ID_CLASS"].'">Select Class '. $_GET["ID_CLASS"] . ' </option>';
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

   <!-- Delete Modal-->
   <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel"></h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Do you want to continous with this action.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="login.php">Delete</a>
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
  <script src="vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="js/demo/datatables-demo.js"></script>

</body>

</html>
