<?php 
session_start(); 
error_reporting(0);
include ('../includes/config.php');
include ('../includes/login_check.php');

$query = mysqli_query($conn,"select * from users where id='$_SESSION[id]'");
$rowi = mysqli_fetch_array($query);   

if(ISSET($_POST['submit'])){

    $query1 = mysqli_query($conn, "SELECT * FROM users where id='$_SESSION[id]' ");
    $result1=mysqli_fetch_array($query1);
  
    $password = $_POST['password'];
    $newpassword = $_POST['newpassword'];
    $confirmPassword = $_POST['confirmPassword'];
 
  
    if($password==$result1['password']){

        if($newpassword==$confirmPassword){

            $update = mysqli_query($conn, "UPDATE users SET password = '$newpassword' where id='$_SESSION[id]' ");

            if($update){
          
              $alertStyle ="alert alert-success";
              $statusMsg="Password Changed";
          
            }
            else{
              
              $alertStyle ="alert alert-danger";
              $statusMsg="An error Occurred!";
          
            }

        }
        else{
            $alertStyle ="alert alert-danger";
            $statusMsg="Password did not match";
        }
    
  
  
    }

    else{
        $alertStyle ="alert alert-danger";
        $statusMsg="Wrong password";
    }


}


?>


<!DOCTYPE html>

<html lang="en" dir="ltr">
    <head>
        <meta charset="UTF-8">
     
        <link rel="stylesheet" href="style_HR.css">
        <title>HR-Change Password </title>
      

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    
        <!-- jQuery library -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    
        <!-- Latest compiled JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
         <meta name="viewport" content="width=device-width, initial-scale=1.0">
       </head>
<body>
           <!-- sidebar menu -->
 <div class="sidebar">
    <div class="logo-details">
      <img src="profile.png" alt="">
      <span class="logo_name"><?php echo $rowi['fullName'];?></span>
    </div>

    <div class="sidenav">
		  <a href="index.php" style:"text-decoration: none;"><i class='bx bx-grid-alt'></i>
		    <span class="links_name">Dashboard</span></a>

		  <button class="dropdown-btn"> <i class='fa fa-wpforms'></i>
		    <span class="links_name">Travel Order</span>
		    <i class="fa fa-caret-down arrow" style="padding-left: 24px;"></i>
		  </button>
		  	<div class="dropdown-container">
		    <a href="todApproved.php">TOD Approved</a>
		    <a href="rdApproved.php">TOD & RD Approved</a>
			</div>

      <button class="dropdown-btn"> <i class='fa fa-wpforms'></i>
		    <span class="links_name">Gatepass</span>
		    <i class="fa fa-caret-down arrow" style="padding-left: 24px;"></i>
		  </button>
		  	<div class="dropdown-container">
		    <a href="todgpApproved.php">TOD Approved</a>
		    <a href="employeegpApproved.php">TOD & DE Approved</a>
			</div>

			<button class="dropdown-btn">  <i class="bx bx-file-blank"></i>
		    <span class="links_name">Request History</span>
		    <i class="fa fa-caret-down arrow" style="padding-left: 0px;"></i>
		  </button>
		  	<div class="dropdown-container">
		    <a href="travel_request.php">Travel Order</a>
		    <a href="gatepass_request.php">GatePass</a>
			</div>

		
	          <a href="../includes/logout.php" class="log_out">
	            <i class='bx bx-log-out'></i>
	            <span class="links_name">Log out</span>
	          </a>
</div>

<script>
      /* Loop through all dropdown buttons to toggle between hiding and showing its dropdown content - This allows the user to have multiple dropdowns without any conflict */
      var dropdown = document.getElementsByClassName("dropdown-btn");
      var i;
      
      for (i = 0; i < dropdown.length; i++) {
        dropdown[i].addEventListener("click", function() {
          this.classList.toggle("active");
          var dropdownContent = this.nextElementSibling;
          if (dropdownContent.style.display === "block") {
            dropdownContent.style.display = "none";
          } else {
            dropdownContent.style.display = "block";
          }
        });
      }
      </script>
          
</div>

   <!-- Top Navigation-->
  <section class="home-section">
    <nav class="nav_menu">
      <div class="sidebar-button">
        <i class='bx bx-menu sidebarBtn'></i>
        <span class="dashboard">Change Password</span>
      </div>
      <div class="profile-details">
        <img src="profile.png" alt="" onclick="toggleMenu()">
        <span class="admin_name" onclick="toggleMenu()">Human Resources</span>
      </div>

      <div class="sub-menu-wrap" id="subMenu">
        <div class="sub-menu">
          <div class="user-info">
            <img src="profile.png" alt="">
            <h5>Human Resources</h5>
          </div>
          <hr>
            <a href="profile_HR.php" class="sub-menu-link">
              <i class='fa fa-user' ></i>
              <p> View Profile </p>
              <span>></span>
            </a>
            <a href="changepass.php" class="sub-menu-link">
              <i class='fa fa-lock' ></i>
              <p> Change Password </p>
              <span>></span>
            </a>
            <a href="../includes/logout.php" class="sub-menu-link">
              <i class='fa fa-sign-out'></i>
              <p> Logout </p>
              <span>></span>
            </a>

        </div>
      </div>

    </nav>

  <section class="home-content">

  <div class="<?php echo $alertStyle;?>" role="alert"><?php echo $statusMsg;?></div>

    <div class="mainDiv">
        <div class="cardStyle">
          <form method="POST" class="formStyle"  name="signupForm" id="signupForm">
            <div class="form_top">
            <h2 class="formTitle">
              Change Password
            </h2>
          </div>
            <div class="form_bottom">
                <div class="inputDiv">
                <label class="inputLabel" for="currentpassword">Current Password*</label>
                <input class="input_box" type="password" id="currentpassword" name="password" required>
                </div>
                
                <div class="inputDiv">
                <label class="inputLabel" for="password">New Password*</label>
                <input class="input_box" type="password" id="password" name="newpassword" required>
                </div>
                
                <div class="inputDiv">
                <label class="inputLabel" for="confirmPassword">Confirm New Password*</label>
                <input class="input_box" type="password" id="confirmPassword" name="confirmPassword" required>
                </div>

                <div class="buttonWrapper">
                <button name="submit" type="submit" id="submitButton" class="submitButton">
                  <span><i class="fa fa-lock" style="font-size:36p"></i>CHANGE</span>
                </button>
                </div>
           </div>
            
        </form>
        </div>
      </div>

  <script>

var password = document.getElementById("password")
  , confirm_password = document.getElementById("confirmPassword");

document.getElementById('signupLogo').src = "https://s3-us-west-2.amazonaws.com/shipsy-public-assets/shipsy/SHIPSY_LOGO_BIRD_BLUE.png";
enableSubmitButton();

function validatePassword() {
  if(password.value != confirm_password.value) {
    confirm_password.setCustomValidity("Passwords Don't Match");
    return false;
  } else {
    confirm_password.setCustomValidity('');
    return true;
  }
}

password.onchange = validatePassword;
confirm_password.onkeyup = validatePassword;

function enableSubmitButton() {
  document.getElementById('submitButton').disabled = false;
  document.getElementById('loader').style.display = 'none';
}

function disableSubmitButton() {
  document.getElementById('submitButton').disabled = true;
  document.getElementById('loader').style.display = 'unset';
}

function validateSignupForm() {
  var form = document.getElementById('signupForm');
  
  for(var i=0; i < form.elements.length; i++){
      if(form.elements[i].value === '' && form.elements[i].hasAttribute('required')){
        console.log('There are some required fields!');
        return false;
      }
    }
  
  if (!validatePassword()) {
    return false;
  }
  
  onSignup();
}

function onSignup() {
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    
    disableSubmitButton();
    
    if (this.readyState == 4 && this.status == 200) {
      enableSubmitButton();
    }
    else {
      console.log('AJAX call failed!');
      setTimeout(function(){
        enableSubmitButton();
      }, 1000);
    }
    
  };
  
  xhttp.open("GET", "ajax_info.txt", true);
  xhttp.send();
}
  </script>

  <script>
   let sidebar = document.querySelector(".sidebar");
let sidebarBtn = document.querySelector(".sidebarBtn");
sidebarBtn.onclick = function() {
  sidebar.classList.toggle("active");
  if(sidebar.classList.contains("active")){
  sidebarBtn.classList.replace("bx-menu" ,"bx-menu-alt-right");
}else
  sidebarBtn.classList.replace("bx-menu-alt-right", "bx-menu");
}
 </script>

<!-- Admin profile Submenu-->
 <script>
    let subMenu=document.getElementById("subMenu");

    function toggleMenu(){
      subMenu.classList.toggle("open-menu");
    }
</script>

 

</body>
</html>
