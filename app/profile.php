<?php
	
  session_start();
  
  require 'includes/database.php';
  require 'chargeGroupUser.php';
  require 'logoutModal.php';
  require 'session.php';	


if ( !empty($_POST['password']) ) {
  try{
    $password = $_POST['password'];
    $passwordVerify = $_POST['passwordVerify'];
    if($password == $passwordVerify){  
      $consulta = "UPDATE users SET password = :password WHERE id_user = :id_user " ;
      $sqlPassword = $conn->prepare($consulta);
      $sqlPassword->bindParam(':id_user', $id_user,PDO::PARAM_INT);
      $sqlPassword->bindParam(':password', $password,  PDO::PARAM_STR);

      $sqlPassword->execute();
      if($sqlPassword->rowCount() > 0){ 
        $count = $sqlPassword -> rowCount();
        echo "<div class='content alert alert-primary' > La password ha sido actualizada </div>";
      }
      else{
        echo "<div class='content alert alert-danger'> No se pudo actulizar el registro el usuario ". $username ." no existe  </div>";
        print_r($sqlPassword->errorInfo()); 
      }
    }else{
      echo "<div class='content alert alert-danger'> No se pudo actulizar el registro, las contraseñas no coinciden </div>";
    }
  }catch(PDOException $error) {
    echo $sqlPassword . "<br>" . $error->getMessage();
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

  <title>AdmSchool - Profile</title>

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
            <h1 class="h3 mb-0 text-gray-800">Profile</h1>
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
								   <h3><?php echo $_SESSION["name"] . ' ' . $_SESSION["lastname"];?></h3>
								
                	<dd><strong>Username</strong> </dd> <dl><?php echo $_SESSION["username"];?> </dl>  
									<dd><strong>Email address</strong> </dd> <dl><?php echo $_SESSION["email"];?> </dl>   	
									<dd><strong>Role</strong> </dd> <dl><?php echo $_SESSION["group_user_name"]?> </dl>
									<dd><strong>User ID</strong> </dd> <dl><?php echo $_SESSION["id_user"]?> </dl>

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
							<a class="text-white" href="#" data-toggle="modal" data-target="#passwordModal">
							  <div class="text-xs font-weight-bold text-primary text-uppercase mb-2">
								CHANGE PASSWORD
							  </div>
							</a>
						</div>
						<div class="col-auto">
							<i class="fas fa-key fa-2x text-gray-300"></i>
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
							<a class="text-white" href="profile-edit.php">
							  <div class="text-xs font-weight-bold text-primary text-uppercase mb-2">
								EDIT PROFILE
							  </div>
							</a>
						</div>
						<div class="col-auto">
							<i class="fas fa-user-edit fa-2x text-gray-300"></i>
						</div>
					   </div>
					</div>
				 </div>
		</div>	
				
		
      <!-- End of Main Content -->

     <!-- Page Footer -->
		<?php 
			require 'footer.php';
		?>

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>
	
  <!-- Password Modal-->
  <div class="modal fade" id="passwordModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Do you want change your password?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
		  	<form action="profile.php" method="POST" autocomplete="off">
				 <div class="form-modal">
                    <input type="password" class="form-control form-control-sm" id="password" name="password" placeholder="Password" >
                  </div>
				 <div class="form-modal">
                    <input type="password" class="form-control form-control-sm" id="passwordVerify" name="passwordVerify" placeholder="Repeat Password">
                  </div> 
			
		</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <input type="submit" class="btn btn-primary" name="changePassword" value="Save" >					
        </div>
      </div>
        </form>
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