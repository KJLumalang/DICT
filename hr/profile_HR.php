<?php 
session_start(); 
error_reporting(0);
include ('../includes/config.php');

$query = mysqli_query($conn,"select * from users where id='$_SESSION[id]'");
$rowi = mysqli_fetch_array($query);   

// Retrieve user input from registration form
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



    $query=mysqli_query($conn,"insert into users(fullName,username,password,sex,age,position,userType,region,province,municipality,division) value('$fullname','$email','$password','$sex','$age','$position','$role','$region','$province','$municipality','$division')");
    
    if($query){

      $alertStyle ="alert alert-success";
      $statusMsg="User Added Successfully!";

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
 
    <link rel="stylesheet" href="style_HR.css">
    <title>HR-Profile </title>
    
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

  <section class="home-section">
    <nav class="nav_menu">
      <div class="sidebar-button">
        <i class='bx bx-menu sidebarBtn'></i>
        <span class="dashboard">Profile</span>
      </div>
      <div class="profile-details">
        <img src="profile.png" alt="" onclick="toggleMenu()">
        <span class="admin_name" onclick="toggleMenu()"><?php echo $rowi['userType'];?></span>
      </div>

      <div class="sub-menu-wrap" id="subMenu">
        <div class="sub-menu">
          <div class="user-info">
            <img src="profile.png" alt="">
            <h5><?php echo $rowi['fullName'];?></h5>
          </div>
          <hr>

            <a href="profile_HR.php" class="sub-menu-link">
              <i class='fa fa-user' ></i>
              <p> View Profile </p>
              <span>></span>
            </a>
            <a href="changepass_HR.php" class="sub-menu-link">
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

          <div class="modal fade" id="EditProfileModal" tabindex="-1" aria-labelledby="EditUserModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="EditProfileModalLabel">Edit Profile</h5>
              </div>
              <div class="modal-body">

                <!-- Form to be fill-out to Edit Admin Profile -->
                <form  method="POST">
                    <div class="profile_pic">
                      <img src="profile.png" id="output" width=100 height=100 alt="">
                      <div class="round">
                        <input id="file" type="file" onchange="loadFile(event)"/>
                        <i class="fa fa-camera" style="color:#fff"></i>
                      </div>
                    </div>

                    <div class="full_name">
                      <label for="addUser01">Full Name*</label>
                      <input type="text" class="form-control" id="addUser01" name="fullname" value="<?php echo $rowi['fullName'];?>" required>
                    </div><br>

                    <div class="sex">
                      <label for="sex">Sex*</label><br>
                      <input type="radio" id="male" name="sex" value="Male">
                      <label for="male">Male</label><br>
                      <input type="radio" id="css" name="sex" value="Female">
                      <label for="female">Female</label>
                    </div><br>

                    <div class="age">
                      <label for="age">Age*</label>
                      <input type="text" class="form-control" id="age" name="age" value="<?php echo $rowi['age'];?>" required >
                    </div><br>

                    <div class="position">
                      <label for="addUser02">Position*</label>
                      <input type="text" class="form-control" id="addUser02" name="position" value="<?php echo $rowi['position'];?>" required>
                    </div><br>


                    <div class="role">
                      <label for="addUser03">Role*</label>
                      <?php 
                         echo '<select class="form-control" name="role" required>';
                         echo'<option value="">Please select role</option>';      
                         $query=mysqli_query($conn,"select roleName from roles");                                                                                                   
                         $count = mysqli_num_rows($query);                   
                          if($count > 0){                                          
                          while ($row = mysqli_fetch_array($query)) {
                          echo'<option value="'.$row['roleName'].'" >'.$row['roleName'].'</option>';
                            }
                              }
                           echo '</select>';
                            ?>   
                    </div><br>

                    <div class="region">
                      <label for="addUser04">Region*</label>
                      <input type="text" class="form-control" id="addUser04" name="region" value="<?php echo $rowi['region'];?>" required>
                    </div><br>


                    <div class="province">
                      <label for="addUser05">Province*</label>
                      <input type="text" class="form-control" id="addUser05"  name="province" value="<?php echo $rowi['province'];?>" required>
                    </div><br>

                    <div class="municipality">
                      <label for="addUser06">Municipality*</label>
                      <input type="text" class="form-control" id="addUser06" name="municipality" value="<?php echo $rowi['municipality'];?>" required>
                    </div><br>


                    <div class="division_agency">
                      <label for="addUser07">Division/Agency*</label>
                      <input type="text" class="form-control" id="addUser07" name="division" value="<?php echo $rowi['division'];?>" required>
                    </div><br>

                    <div class="user_email">
                      <label for="addUser08">User Email*</label>
                      <input type="text" class="form-control" id="addUser08" name="email" value="<?php echo $rowi['username'];?>" required>
                    </div><br>

                    <div class="password">
                      <label for="addUser09">Password*</label>
                      <input type="password" class="form-control" id="addUser09" name="password" value="<?php echo $rowi['password'];?>" required>
                    </div><br>

                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                      <button type="submit" class="btn btn-primary" name="submit">Update</button>
                    </div><br>
                </form>
                
              </div>
            </div>
          </div>
        </div>

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


		        	<h4>Account Information</h4>

		     <!--Admin Account Details-->
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



