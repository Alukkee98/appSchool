<?php
	
  session_start();

  require 'includes/db.php';
  require 'database.php';
  require 'chargeGroupUser.php';
  require 'session.php'; 
  require 'logoutModal.php'; 


	if (!empty(isset($_POST['editProfile']))) {
    echo "<script type='text/javascript'>alert('$password');</script>";

    try {

      $connection = new PDO($dsn, $username, $password, $options);


      $user =[
        "username"  => $_POST['username'],
        "email"     => $_POST['email']
      ];
  
      $sql = "UPDATE users 
      SET   username = :username 
      WHERE id_user = '$id_user' ";


      $result = $connexion->fecthAll();
      $result = $connection->prepare($sql);

      header("Refresh:0; url=profile.php");
      

    } catch(PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
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

          <!-- Page Heading -->
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
								   <h3><?php echo $_SESSION["name"] . ' ' . $_SESSION["lastname"];?></h3>
									<dd><strong>Username</strong> </dd>
									<dl>  
										<input type="text" class="form-control form-control-user" id="username" name="username" placeholder="<?php echo $_SESSION["username"];?> " >
									</dl>
									
									<dd><strong>Email address</strong> </dd> 
									<dl>
										<input type="text" class="form-control form-control-user" id="email" name="email" placeholder="<?php echo $_SESSION["email"];?> " >
									</dl>   	
									
									<dd><strong>Role</strong> </dd> 
									<dl>
                    <select class="form-control form-control-sm" id="selectClass" name="selectClass" readonly> 
                        <option value="">Select</option>
                        <?php 
                        $sqlGroupUserView = "SELECT * FROM group_user";
                        $result = $connexion->query($sqlGroupUserView);
                        if($result->num_rows>0){
                        while($row = $result->fetch_assoc()) {
                          echo '<option value="'.$row[GROUP_USER_ID].'">'.$row['DESCRIPCION'].'</option>
                                ';
                        }
                        }
                        ?>
                    </select>
          				</dl>
									
									<dd><strong>User ID</strong> </dd> 
									<dl>
										<input type="text" class="form-control form-control-user" id="id_user" name="id_user" placeholder="<?php echo $_SESSION["id_user"];?> " readonly >
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
							  <div class="text-xs font-weight-bold text-primary text-uppercase mb-2">
                  <input type="submit" name="editProfile" value="Save">              
              </form>
							  </div>
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
	