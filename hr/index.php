<?php 
session_start(); 
error_reporting();
include ('../includes/config.php');
include ('../includes/login_check.php');

$query = mysqli_query($conn,"select * from users where id='$_SESSION[id]'");
$rowi = mysqli_fetch_array($query);   

$result=mysqli_query($conn,"SELECT * from travelorder where reqStatus2 = 'Pending' ");
$travelnum = mysqli_num_rows($result);

$result=mysqli_query($conn,"SELECT * from travelorder where reqStatus2 = 'Approved' ");
$approvedtravelnum = mysqli_num_rows($result);

$result=mysqli_query($conn,"SELECT * from travelorder where reqStatus = 'Disapproved' or reqStatus2 = 'Disapproved'  ");
$distravelnum = mysqli_num_rows($result);


$result=mysqli_query($conn,"SELECT * from gatepass where reqStatus2 = 'Pending' ");
$gatepassnum = mysqli_num_rows($result);

$result=mysqli_query($conn,"SELECT * from gatepass where reqStatus2 = 'Aprroved' ");
$approvedgatepassnum = mysqli_num_rows($result);

$result=mysqli_query($conn,"SELECT * from gatepass where reqStatus = 'Disapproved' or reqStatus2 = 'Disapproved'  ");
$disgatepassnum = mysqli_num_rows($result);


?>

<!DOCTYPE html>

<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
 
    <link rel="stylesheet" href="style_HR.css">
    <title>HR/AFD-Dashboard </title>
  
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

  
  <!-- Top Navigation-->
  <section class="home-section">
    <nav class="nav_menu">
      <div class="sidebar-button">
        <i class='bx bx-menu sidebarBtn'></i>
        <span class="dashboard">Dashboard</span>
      </div>
      <div class="profile-details">
        <img src="profile.png" alt="" onclick="toggleMenu()">
        <span class="admin_name" onclick="toggleMenu()"><?php echo $rowi['userType'];?> </span>
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

    <!--Dashboard page content-->
    <div class="home-content">
      <div class="overview-boxes">
        <div class="box one">
          <div class="right-side">
            <div class="box-topic">Gatepass</div>
            <div class="box-status">Approved</div>
            <div class="number"><?php echo$approvedgatepassnum;?></div>
          </div>
          <i class='bx bx-credit-card pic app'></i>
        </div>
        <div class="box two">
          <div class="right-side">
            <div class="box-topic">Travel Order</div>
            <div class="box-status">Approved</div>
            <div class="number"><?php echo $approvedtravelnum;?></div>
          </div>
          <i class='bx bx-credit-card-front pic app' ></i>
        </div>
         <div class="box three">
          <div class="right-side">
            <div class="box-topic">Gatepass</div>
            <div class="box-status">Pending</div>
            <div class="number"><?php echo $gatepassnum;?></div>
          </div>
          <i class='bx bx-loader pic gate' ></i>
        </div>
        <div class="box four">
          <div class="right-side">
            <div class="box-topic">Travel Order</div>
            <div class="box-status">Pending</div>
            <div class="number"><?php echo $travelnum;?></div>
          </div>
          <i class='bx bx-loader-circle pic gate' ></i>
        </div>
         <div class="box five">
          <div class="right-side">
            <div class="box-topic">Gate Pass</div>
            <div class="box-status">Disapproved</div>
            <div class="number"><?php echo$disgatepassnum;?></div>
          </div>
          <i class='bx bxs-dislike pic dis' ></i>
        </div>
        <div class="box six">
          <div class="right-side">
            <div class="box-topic">Travel Order</div>
            <div class="box-status">Disapproved</div>
            <div class="number"><?php echo $distravelnum;?></div>
          </div>
          <i class='bx bx-dislike pic dis' ></i>
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


<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

<!-- Bootstrap Popper with Bundle -->
 <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>

 <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>


</body>
</html>



