<?php
	
  session_start();

  require 'includes/database.php';
  require 'chargeGroupUser.php';
  require 'logoutModal.php';
  require 'session.php';	
  


	if (!empty(isset($_POST['profileEdit']))) {
    try {
      $consulta = "UPDATE users SET name = :name, 
                                    lastname = :lastname,
                                    username = :username,
                                    email = :email
                   WHERE id_user = :id_user " ;
      $sqlProfile = $conn->prepare($consulta);
      $sqlProfile->bindParam(':id_user', $id_user,PDO::PARAM_INT);
      $sqlProfile->bindParam(':name', $_POST['name'],  PDO::PARAM_STR);
      $sqlProfile->bindParam(':lastname', $_POST['lastname'],  PDO::PARAM_STR);
      $sqlProfile->bindParam(':username', $_POST['username'],  PDO::PARAM_STR);
      $sqlProfile->bindParam(':email', $_POST['email'],  PDO::PARAM_STR);

      $sqlProfile->execute();
      if($sqlProfile->rowCount() > 0){
          $_SESSION["name"] = $_POST['name'];
          $_SESSION["lastname"] = $_POST['lastname'];
          $_SESSION["username"] = $_POST['username'];
          $_SESSION["email"] = $_POST['email'];

        
        //echo "<div class='content alert alert-primary'> Datos del usuario actualizados </div>";        
        header("Refresh:0; url=profile.php");

      }else{
        echo "<div class='content alert alert-danger'> No se pudo actulizar el registro el usuario ". $username ." no existe  </div>";
        print_r($sqlProfile->errorInfo()); 
      }

      

    } catch(PDOException $error) {
        echo $sqlProfile . "<br>" . $error->getMessage();
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

  <title>AdmSchool - Edit Profile</title>

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

          <!-- Page Heading
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Edit Profile</h1>
          </div>
          <!-- Content Row -->

      <div class="row">
		<!-- Area Chart -->
        <div class="col-xl-12 col-lg-10">
			<div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
				      <h6 class="m-0 font-weight-bold text-primary">Profile Detail</h6>
            </div>
			
            <!-- Card Body -->
            <div class="card-body">
					<div class="h-100 py-2">
						<div class="row align-items-center">
							<div class="col-lg-6">
								<img src="https://image.flaticon.com/icons/svg/149/149071.svg" class="bg-profile-image">
							</div>
							<div class="col-lg-6">
                  <form method="POST" autocomplete="off">
									
                   <dd><strong>Name</strong> </dd> 
									<dl>
                      <input type="text" class="form-control form-control-user" id="name" name="name" value="<?php echo $_SESSION["name"];?> "   >
          				</dl>
									
									<dd><strong>Lastname</strong> </dd> 
									<dl>
										<input type="text" class="form-control form-control-user" id="lastname" name="lastname" value="<?php echo $_SESSION["lastname"];?> "  >
									</dl>
                  <dd><strong>Username</strong> </dd>
									<dl>          
                    <div class="input-group-prepend">
                        <div class="input-group-text">@</div>
                          <input type="text" class="form-control form-control-user" id="username" name="username" value="<?php echo $_SESSION["username"];?> " >
                    </div>

									</dl>
									
									<dd><strong>Email address</strong> </dd> 
									<dl>
										<input type="text" class="form-control form-control-user" id="email" name="email" value="<?php echo $_SESSION["email"];?> " >
									</dl>                
              </div>
						</div>
					  </div>
					</div>
			</div>
		</div>

		<div class="col-xl-3 col-md-6 mb-4">
				  <div class="card shadow h-100 py-2">
					<div class="card-body">
					  <div class="row no-gutters align-items-center">
						<div class="col mr-2">
                  <input class="btn text-xs font-weight-bold text-primary text-uppercase mb-2" type="submit" name="profileEdit" value="Save">              
              </form>
						</div>
						<div class="col-auto">
							<span style="color: #80F115;">
								<i class="fas fa-check fa-2x"></i>
							</span>
						</div>
					   </div>
					</div>
				 </div>
		</div>	

		<div class="col-xl-3 col-md-6 mb-4">
				  <div class="card shadow h-100 py-2">
					<div class="card-body">
					  <div class="row no-gutters align-items-center">
						<div class="col mr-2">
							<a class="text-white" href="profile.php">
							  <div class="text-xs font-weight-bold text-primary text-uppercase mb-2">
								Back
							  </div>
							</a>
						</div>
						<div class="col-auto">
							<span style="color: #C12D2D;">
							<i class="fas fa-undo fa-2x"></i>
							</span>
						</div>
					   </div>
					</div>
				 </div>
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
	