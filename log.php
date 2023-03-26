<?php 
session_start(); 
include ('includes/config.php');

if (isset($_POST['username']) && isset($_POST['password'])) {

	function validate($data){
       $data = trim($data);
	   $data = stripslashes($data);
	   $data = htmlspecialchars($data);
	   return $data;
	}

	$uname = validate($_POST['username']);
	$pass = validate($_POST['password']);

	if (empty($uname)) {
		header("Location: index.php?error=Username is required");
	    exit();
	}else if(empty($pass)){
        header("Location: index.php?error=Password is required");
	    exit();
	}else{
		$sql = "SELECT * FROM users WHERE username='$uname' AND password='$pass'";

		$result = mysqli_query($conn, $sql);

		if (mysqli_num_rows($result) === 1) {

			$row = mysqli_fetch_assoc($result);

            if ($row['username'] === $uname && $row['password'] === $pass) {


				if($row['userType']=='Admin'){
					header("Location: admin/index.html");
					exit();
				}
				
				elseif($row['userType']=='Regional Director'){
					header("Location: ro/index.html");
					exit();
				}

				elseif($row['userType']=='TOD'){
					header("Location: tod/index.html");
					exit();
				}

				elseif($row['userType']=='HR'){
					header("Location: hr/index.html");
					exit();
				}

				elseif($row['userType']=='AFD'){
					header("Location: hr/index.html");
					exit();
				}

				elseif($row['userType']=='Record Officer'){
					header("Location: ro/index.html");
					exit();
				}
			
				else{
					header("Location: staff/index.html");
					exit();
				}

            	
            }else{
				
				header("Location: index.php?error=Incorrect username or password");
		        exit();


			}
		}else{
			header("Location: index.php?error=Incorrect username or password");
	        exit();
		}
	}
	
}else{
	header("Location: index.php");
	exit();
}