<?php 
	session_start(); 

	$C_username = "";
 	$errors = array(); 
	$_SESSION['success'] = "";

	$db = mysqli_connect('localhost', 'root', '', 'dict');


	
	if (isset($_POST['login'])) {

		$username = mysqli_real_escape_string($db, $_POST['username']);
		$password = mysqli_real_escape_string($db, $_POST['password']);
		$_SESSION['status'] = false;
	
		if (empty($username)) {
			array_push($errors, "Username is required");
		}
		if (empty($password)) {
			array_push($errors, "Password is required");
		}

		
		if (count($errors) == 0) {
			$password = ($password);
			$query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
			$results = mysqli_query($db, $query);

		
			if (mysqli_num_rows($results) == 1) {
				$_SESSION['username'] = $username;
				$_SESSION['status'] = true;
				$_SESSION['success'] = "You have logged in!"; 
				header('location:log.php'); 
			}else {
				array_push($errors, "Username or password incorrect"); 
			}
			
		}
	}else{
	header("Location: log.php");
	exit();
	}