<?php
	
  session_start();
  
  
  require 'includes/database.php';
  require 'session.php';			
	
	
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
       
          <!-- Page Heading -->

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">
              <?php
                    $consulta = "SELECT * FROM subjects s 
                    INNER JOIN classes c on s.ID_CLASS  = c.ID_CLASS 
                    WHERE ID_SUBJECT = :id_subject";
                    
                    $sqlClassesName = $conn->prepare($consulta);
                    $sqlClassesName->bindParam(':id_subject', $_GET["ID_SUBJECT"],PDO::PARAM_INT);

                    
                    $sqlClassesName->execute();

                    $results = $sqlClassesName->fetchAll();

                    foreach($results as $row){
                      echo  $row['NAME'] . " - ". $row['CLASS_NAME'];
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
                      <th>
                        <input type="text" id="class_name" name="class_name" placeholder="Note"   >
                      </th>
                      
                      <!-- Crear una nota - a todos los usuarios de la clase, crearemos notes-function
                      donde calcularemos cuantos exaenes tiene esa asignatura
                      y podremos modificar una nota de un alumno
                      eliminar el examen de todos los alumnos -->
                      <?php
					  
                       echo '
                       <th align="center">
                       <span style="display:none;">100000</span>
                       <a href="#"  class="btn-green btn-circle btn-sm" data-toggle="modal" data-target="#createNotaModal">
                       <i class="fas fa-plus-circle"></i> 
                       </a>
                       </th>';
                      ?>
                     
                    </tr>
                  </thead>
                  
                  <tbody>
                    <?php
					$note_num = '1';
					
                    $consulta = " SELECT * FROM students s
                    LEFT OUTER JOIN notes tn ON tn.ID_STUDENT  = s.ID 
                    WHERE
                    tn.id_subject = :id_subject
					and tn.NOTE_NUM = $note_num					
					or tn.id_subject IS NULL
                    and   s.ID_CLASS = :id_class
                    order by s.ID_CLASS, tn.NOTE_NUM  asc;";
                    
                    $sqlStudentsNoteTable = $conn->prepare($consulta);
                    $sqlStudentsNoteTable->bindParam(':id_class', $_GET["ID_CLASS"],PDO::PARAM_INT);
                    $sqlStudentsNoteTable->bindParam(':id_subject', $_GET["ID_SUBJECT"],PDO::PARAM_INT);

                    
                    $sqlStudentsNoteTable->execute();
                    $results = $sqlStudentsNoteTable->fetchAll();
                    
//					print_r ($results);
					
                    $cont = 1;
                    if($sqlStudentsNoteTable->rowCount() > 0){
                      foreach($results as $row){
                      echo '
                      <tr>
                        <td>'.$cont.'</td>
                        <td>'.$row['SURNAME'].'  '.$row['SURNAME2'].', '.$row['NAME'].'</td>
                        <td>
                          <input type="text" id="class_name" name="class_name" placeholder="'.$row['NOTE'].'"   >
                        </td>
                      </tr>
                      ';
                      $cont++;
                      }
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



 <!-- Create a Student Modal-->
 <div class="modal fade" id="createNotaModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Create a note</h5>
        </div>
        <div class="modal-body">
        <form method="POST" autocomplete="off">
                  	<!-- CLASSES -->
				<div class="col-xl-3 col-md-6 mb-4">
				<a class="text-white" href="classes.php">
				  <div class="card shadow bg-info text-white h-100 py-2">
					<div class="card-body">
					  <div class="row no-gutters align-items-center">
						<div class="col mr-2">
							  <div class="text-xs font-weight-bold text-uppercase mb-2">
								CLASSES
							  </div>
						</div>
						<div class="col-auto">
							<i class="fas fa-graduation-cap fa-2x text-gray-300"></i>
						</div>
					   </div>
					</div>
				 </div>
				</a>
				</div>
				

                   <!-- SUBJECTS -->
                   <div class="col-xl-3 col-md-6 mb-4">
                  <a class="text-white" href="subjects.php">
                    <div class="card shadow bg-warning text-white h-100 py-2">
                    <div class="card-body">
                      <div class="row no-gutters align-items-center">
                      <div class="col mr-2">
                          <div class="text-xs font-weight-bold text-uppercase mb-2">
                          SUBJECTS
                          </div>
                      </div>
                      <div class="col-auto">
                        <i class="fas fa-book-open fa-2x text-gray-300"></i>
                      </div>
                      </div>
                    </div>
                  </div>
                  </a>
                  </div>
               

		    </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>		  
          <input type="submit" class="btn btn-primary" name="createNote" value="Create">					
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


  <!-- Page level custom scripts -->
  <script src="js/demo/datatables-demo.js"></script>

</body>

</html>
