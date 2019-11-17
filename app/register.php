
<?php

  require 'database.php';

  $message  = '';
  $username = '';
  $password ='';
  $email = ''; 

if ( !empty($_POST['username']) && !empty($_POST['password']) && !empty($_POST['email']) ) {
	try{
	$sql = "INSERT INTO users (username, password, group_user_id, email, name, lastname) VALUES (:username, :password, :groupUserId, :email, :firstName, :lastName)";
	$stmt = $conn->prepare($sql);
	
	$stmt->bindParam(':username', $_POST['username']);
	$password = password_hash($_POST['password'], PASSWORD_BCRYPT);
	$stmt->bindParam(':password', $password);
	$stmt->bindParam(':email', $_POST['email']);
	$stmt->bindParam(':groupUserId', $_POST['groupUserId']);
	$stmt->bindParam(':firstName', $_POST['firstName']);
	$stmt->bindParam(':lastName', $_POST['lastName']);
	
	$username = $_POST['username'];
	$password = $_POST['password'];
	$email = $_POST['email'];
	
	$sqlVerifyUsername = "SELECT COUNT(*) FROM users WHERE username = '$username'";
	$resultVerifyUsername = $connexion->query($sqlVerifyUsername);
	
	$sqlVerifyEmail = "SELECT COUNT(*) FROM users WHERE email = '$email'";
	$resultVerifyEmail = $connexion->query($sqlVerifyEmail);
		
		if($resultVerifyUsername->num_rows>0 OR $resultVerifyEmail->num_rows>0){
			$message = 'This username/email is already taken';
		}
		else{
			if ($stmt->execute()) {
				$message = 'Successfully created new user' ;
				$login = 'Yes';
			}
		}
	}
	
	catch(PDOException $e) {
		$message = 'Sorry there must have been an issue creating your account';
	}

 $conn = null;
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

  <title>SB Admin 2 - Register</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">
	 
    <?php if(!empty($message)): ?>
      <div class="message"> 
        <?= $message ?>
         <?php if(!empty($login)): ?>
              <a href="login.php">LOGIN</a>
         <?php endif; ?>
      </div>
    <?php endif;	?>

  <div class="container">
    <div class="card o-hidden border-0 shadow-lg my-5">
      <div class="card-body p-0">
        <!-- Nested Row within Card Body -->
        <div class="row">
          <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
          <div class="col-lg-7">
            <div class="p-5">
              <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
              </div>
              <form class="user" action="register.php" method="POST" autocomplete="off">
                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="text" class="form-control form-control-user" id="firstName" name="firstName" placeholder="First Name" >
                  </div>
                  <div class="col-sm-6">
                    <input type="text" class="form-control form-control-user" id="lastName" name="lastName" placeholder="Last Name">
                  </div>
                </div>
				<div class="form-group">
                  <input type="text" class="form-control form-control-user" id="username" name="username" placeholder="*Username" required="true">
                </div>
                <div class="form-group">
                  <input type="email" class="form-control form-control-user" id="email" name="email" placeholder="*Email Address" required="true">
                </div>
                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="password" class="form-control form-control-user" id="password" name="password" placeholder="Password" required="true">
                  </div>
                  <div class="col-sm-6">
                    <input type="password" class="form-control form-control-user" id="repeatPassword" name="repeatPassword" placeholder="Repeat Password" required="true">
                  </div>
				</div>
				<div class="form-group row">
				  <div class="col-sm-6">						
						<select class="form-control mdb-select md-form" name="groupUserId">
							<option value="" disabled selected>*Choose your permission</option>
						<?php
								// Realizamos la consulta para extraer los datos
								$sql = "SELECT * FROM group_user";
								$result = $connexion->query($sql);
								if($result->num_rows>0){
									while($row = $result->fetch_assoc()) {
										echo '<option value="'.$row[group_user_id].'">'.$row[descripcion].'</option>';
									}
								}
								
								$connexion->close();
								?>
						</select>
				  </div>
				</div>
				<input type="submit" class="btn btn-primary btn-user btn-block" id="register" value="Register Account">					
                <!--<a href="index.html" class="btn btn-google btn-user btn-block">
                  <i class="fab fa-google fa-fw"></i> Register with Google
                </a>
                <a href="index.html" class="btn btn-facebook btn-user btn-block">
                  <i class="fab fa-facebook-f fa-fw"></i> Register with Facebook
                </a>-->
              </form>
              <hr>
              <div class="text-center">
                <a class="small" href="forgot-password.html">Forgot Password?</a>
              </div>
              <div class="text-center">
                <a class="small" href="login.php">Already have an account? Login!</a>
              </div>
            </div>
          </div>
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

</body>

</html>
