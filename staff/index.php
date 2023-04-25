<?php
// Starting the session, to use and
// store data in session variable
session_start();
include ('../includes/config.php');
include ('../includes/login_check.php');

  



$query = mysqli_query($conn, "SELECT * FROM users WHERE username='$_SESSION[uname]'");
$result=mysqli_fetch_array($query);


?>


<!DOCTYPE html>

<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
 
    <link rel="stylesheet" href="style_STAFF.css">
    <title>Staff-Profile</title>
    
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
   </head>
<body>
            <!-- sidebar menu -->
 <div class="sidebar">
    <div class="logo-details">
      <img src="profile.png" alt="">
      <span class="logo_name"><?php echo $result['fullName'];?></span>
    </div>
      <ul class="nav-links">
        <li>
          <a href="index.php" class="active">
            <i class='fa fa-user-circle' ></i>
            <span class="links_name">Profile</span>
          </a>
        </li>
        <li>
          <a href="travel_form.php">
            <i class='fa fa-wpforms' ></i>
            <span class="links_name">Request Travel Order</span>
          </a>
        </li>
         <li>
          <a href="gatepass_form.php">
            <i class='bx bx-file' ></i>
            <span class="links_name">Request Gatepass</span>
          </a>
        </li>
        <li>
            <a class="dropdown-btn">
              <i class="bx bx-file-blank"></i>
              <span class="links_name">Request History</span> <i class="fa fa-caret-down arrow"></i>
            </a>

          <div class="dropdown-container">
              <a href="to_record.php" class="sub-item"> <i></i><span class="links_name">Travel Order</span></a>
              <a href="gp_record.php" class="sub-item"> <i></i> <span class="links_name">Gate Pass</span></a>
          </div>
        </li>

                <script>
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

    </nav>

         

       <div class="home-content">

       	<!--Staff Profile Information-->
      	<div class="wrapper">
      		<div class="top">
      			<img src="profile.png" alt="user" width="100">
      			<h3><?php echo $result['fullName'];?></h3>
      			<p>Staff</p>
      		</div>
      		<div class="bottom">
      			<div class="info">


		        	<h4>Account Information</h4>

		     <!--Staff Account Details-->
      				<div class="info_data">
      					<div class="data">
      						<h6> User Email</h6>
      						<p><?php echo $result['username'];?></p>
      					</div>
      					<div class="data">
      						<h6> Full Name</h6>
      						<p><?php echo $result['fullName'];?></p>
      					</div>
      					<div class="data">
      						<h6> Sex</h6>
      						<p><?php echo $result['sex'];?></p>
      					</div>
      					<div class="data">
      						<h6>Age</h6>
      						<p><?php echo $result['age'];?></p>
      					</div>
      					<div class="data">
      						<h6>Position</h6>
      						<p><?php echo $result['position'];?></p>
      					</div>
                <div class="data">
                  <h6>Region</h6>
                  <p><?php echo $result['region'];?></p>
                </div>
                <div class="data">
                  <h6>Province</h6>
                  <p><?php echo $result['province'];?></p>
                </div>
                <div class="data">
                  <h6>Municipality</h6>
                  <p>Municipality</p>
                </div>
                <div class="data">
                  <h6>Division</h6>
                  <p><?php echo $result['division'];?></p>
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


<!--CSS Only-->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

<!-- Bootstrap Popper with Bundle -->
 <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>

 <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>

</body>
</html>



