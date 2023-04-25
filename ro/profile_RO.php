<?php 
session_start(); 
error_reporting(0);
include ('../includes/config.php');
include ('../includes/login_check.php');



    $query = mysqli_query($conn,"select * from users where id='$_SESSION[id]'");
    $rowi = mysqli_fetch_array($query);   


//UPDATE
    if(isset($_POST['submit'])){

        $fullname = $_POST['fullname'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $sex = $_POST['sex'];
        $age = $_POST['age'];
        $position = $_POST['position'];
        $role = $_POST['role'];
        $region = $_POST['region'];
        $province = $_POST['province'];
        $municipality = $_POST['municipality'];
        $division = $_POST['division'];
    
    
    
        $ret=mysqli_query($conn,"update users set fullName='$fullname',username='$email',password='$password',sex='$sex',age='$age',position='$position',userType='$role',region='$region',province='$province',municipality='$municipality',division='$division' where id='$_SESSION[editId]'");
        
        if($ret){

        echo "<script type = \"text/javascript\">
        window.location = (\"viewProfile.php?editId=$_SESSION[editId];\")
        </script>"; 
   
        }
        else{
          
          $alertStyle ="alert alert-danger";
          $statusMsg="An error Occurred!";
    
        }
    }

?>





<!DOCTYPE html>

<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
 
    <link rel="stylesheet" href="style_RO.css">
    <title>Record Officer-Profile </title>
    
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
   </head>
<body>
            <!-- sidebar menu -->
 <div class="sidebar">
    <div class="logo-details">
      <img src="profile.png" alt="">
      <span class="logo_name"><?php echo $rowi['fullName'];?></span>
    </div>
      <ul class="nav-links">
        <li>
          <a href="index.php">
            <i class='bx bx-grid-alt' ></i>
            <span class="links_name">Dashboard</span>
          </a>
        </li>
 
        <li>
          <a href="RO_travel_request.html">
            <i class='bx bx-clipboard' ></i>
            <span class="links_name">Request Records</span>
          </a>
        </li>
        
        <li class="log_out">
          <a href="../includes/logout.php">
            <i class='bx bx-log-out'></i>
            <span class="links_name">Log out</span>
          </a>
        </li>
      </ul>
  </div>

  <section class="home-section">
    <nav class="nav_menu">
      <div class="sidebar-button">
        <i class='bx bx-menu sidebarBtn'></i>
        <span class="dashboard">Profile</span>
      </div>
      <div class="profile-details">
        <img src="profile.png" alt="" onclick="toggleMenu()">
        <span class="admin_name" onclick="toggleMenu()">Records Officer</span>
      </div>

      <div class="sub-menu-wrap" id="subMenu">
        <div class="sub-menu">
          <div class="user-info">
            <img src="profile.png" alt="">
            <h5><?php echo $rowi['fullName'];?></h5>
          </div>
          <hr>

            <a href="profile_RO.html" class="sub-menu-link">
              <i class='fa fa-user' ></i>
              <p> View Profile </p>
              <span>></span>
            </a>
            <a href="changepass_RO.html" class="sub-menu-link">
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

        

       <div class="home-content">

       	<!--Admin Profile Information-->
      	<div class="wrapper">
      		<div class="top">
      			<img src="profile.png" alt="user" width="100">
                  <h3><?php echo $rowi['fullName'];?></h3>
      			<p><?php echo $rowi['userType'];?></p>   
      		</div>
      		<div class="bottom">
      			<div class="info">
      				

                    <div class="<?php echo $alertStyle;?>" role="alert"><?php echo $statusMsg;?></div>
		        	<h4>Account Information</h4>

		     <!--Account Details-->
      				<div class="info_data">     		
      					<div class="data">
      						<h6> Full Name</h6>
      						<p><?php echo $rowi['fullName'];?></p>
      					</div>
      					
      					<div class="data">
      						<h6>Email</h6>
      						<p><?php echo $rowi['username'];?></p>
      					</div>

      					<div class="data">
      						<h6>Role</h6>
      						<p><?php echo $rowi['userType'];?></p>
      					</div>

                          <div class="data">
      						<h6>Sex</h6>
      						<p><?php echo $rowi['sex'];?></p>
      					</div>

                          <div class="data">
      						<h6>Age</h6>
      						<p><?php echo $rowi['age'];?></p>
      					</div>

                          <div class="data">
      						<h6>Position</h6>
      						<p><?php echo $rowi['position'];?></p>
      					</div>

                          <div class="data">
      						<h6>Region</h6>
      						<p><?php echo $rowi['region'];?></p>
      					</div>

                          <div class="data">
      						<h6>Municipality</h6>
      						<p><?php echo $rowi['municipality'];?></p>
      					</div>

                          <div class="data">
      						<h6>Division/Agency</h6>
      						<p><?php echo $rowi['division'];?></p>
      					</div>

      				</div>
      			</div>
      		</div>
      	</div>
       	</div>

  </section>
  
<!--Sidebar Menu-->
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

<!-- To change profile image-->
<script>
  var loadFile = function (event) {
  var image = document.getElementById("output");
  image.src = URL.createObjectURL(event.target.files[0]);
};

</script>


<!--CSS Only-->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

<!-- Bootstrap Popper with Bundle -->
 <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>

 <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>

</body>
</html>



