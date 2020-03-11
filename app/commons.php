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
	//$password = password_hash($_POST['password'], PASSWORD_BCRYPT);
	$stmt->bindParam(':password', $password);
	$stmt->bindParam(':email', $_POST['email']);
	$stmt->bindParam(':groupUserId', $_POST['groupUserId']);
	$stmt->bindParam(':firstName', $_POST['firstName']);
	$stmt->bindParam(':lastName', $_POST['lastName']);
	
	$username = $_POST['username'];
	$password = $_POST['password'];
	$email = $_POST['email'];
	
	$sqlVerify = "SELECT COUNT(*) FROM users WHERE username = '$username' OR  email = '$email'";
	$resultVerify = $connexion->query($sqlVerify);
		
		if($sqlVerify->num_rows>0){
			$message = 'This username/email is already taken';
		}else{
			if ($stmt->execute()) {
				$message = 'Successfully created new user' ;
				header('Location: login.php');
			}
		}
	}
	
	catch(PDOException $e) {
		$message = 'Sorry there must have been an issue creating your account';
	}

 $conn = null;
}
  
?>


?>