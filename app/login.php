<!DOCTYPE html>

<?php
 $message='';

 session_start();
  
 require 'includes/database.php';
  
  if (!empty($_POST['username']) && !empty($_POST['password'])) {
   
    $username = $_POST['username'];
    $sql = $conn->prepare('SELECT * FROM users WHERE username = :username');
    $sql->bindParam(':username', $username);

    $sql->execute();
    $results = $sql->fetchAll();

    //Array
   /* while( $results = $sql->fetch(PDO:: FETCH_ASSOC) ){
                    $message = print_r($results);
      }
    */  
    
    //Numero de registros de la query
    $totalRow = $sql->rowCount();
    
    if ($totalRow > 0) {
      //Correr el array
      foreach($results as $row){
        if($_POST['password'] == $row['PASSWORD']) {
        
          $_SESSION['username'] = $_POST['username'];
          $_SESSION['id_user']  = $row['ID_USER'];
          $_SESSION['email']    = $row['EMAIL'];
          $_SESSION['group_user_id'] = $row['GROUP_USER_ID'];
          $_SESSION['name']     = $row['NAME'];
          $_SESSION['lastname'] = $row['LASTNAME'];
        
          header('Location: index.php');
        }else{
          $message = 'Sorry, those password do not match with this user --> ' . $row['USERNAME'] ;
        }
      }       
  }else {
     $message = 'Sorry, those credentials do not match';
  }

	
}

?>


<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>SB Admin 2 - Login</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

 <?php if(!empty($message)): ?>
      <div class="message">  <?= $message ?> </div>
    <?php endif;	?>
	
  <div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

      <div class="col-xl-10 col-lg-12 col-md-9">

        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
              <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
              <div class="col-lg-6">
                <div class="p-5">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Apps Login</h1>
                  </div>
                  <form class="user" method="POST" action="login.php">
                    <div class="form-group">
                      <input type="text" name="username" class="form-control form-control-user" id="username" aria-describedby="emailHelp" placeholder="Enter username...">
                    </div>
                    <div class="form-group">
                      <input type="password" name="password" class="form-control form-control-user" id="password" placeholder="Password">
                    </div>
                    <div class="form-group">
                      <div class="custom-control custom-checkbox small">
                        <input type="checkbox" class="custom-control-input" id="customCheck">
                        <label class="custom-control-label" for="customCheck">Remember Me</label>
                      </div>
                    </div>
 
				        	<input type="submit" class="btn btn-primary btn-user btn-block" name="login" value="Login" >					
                    <!--
                    <hr>
                    <a href="index.html" class="btn btn-google btn-user btn-block">
                      <i class="fab fa-google fa-fw"></i> Login with Google
                    </a>
                    <a href="index.html" class="btn btn-facebook btn-user btn-block">
                      <i class="fab fa-facebook-f fa-fw"></i> Login with Facebook
                    </a>-->
                  </form>
                  <hr>
                  <div class="text-center">
                    <a class="small" href="forgot-password.html">Forgot Password?</a>
                  </div>

                  <div class="text-center">
                    <a class="small" href="register.php">Create an Account!</a>
                  </div>
                </div>
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