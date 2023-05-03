<?php 
session_start(); 
error_reporting(0);
include ('../includes/config.php');


$alertStyle=$_GET['alertStyle'];
$statusMsg=$_GET['statusMsg'];

if(isset($_POST['reset'])){

    $query=mysqli_query($conn,"UPDATE users SET token = '18'");
    
    if($query){

      $alertStyle ="alert alert-success";
      $statusMsg="Reset Succesful!";

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
 
    <link rel="stylesheet" href="style.css">
    <title>Admin-Manage Roles </title>
  
    <!-- Bootstrap CSS File-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
   </head>
<body>
    
    <!--Header-->
  <div class="sidebar">
    <div class="logo-details">
      <img src="logo.png" alt="">
      <span class="logo_name">DICT</span>
    </div>

<!-- sidebar menu -->

<!-- sidebar menu -->
      <ul class="nav-links">
        <li>
          <a href="index.php">
            <i class='bx bx-grid-alt'></i>
            <span class="links_name">Dashboard</span>
          </a>
        </li>
        <li>
          <a href="user.php">
            <i class='bx bxs-group'></i>
            <span class="links_name">Users</span>
          </a>
        </li>
        <li>
          <a href="role.php">
            <i class='fa fa-star'></i>
            <span class="links_name">Role</span>
          </a>
        </li>
        <li>
          <a href="credits.php"  class="active">
            <i class='fa fa-plus'></i>
            <span class="links_name">Request Credits</span>
          </a>
        </li>
        <li>
            <a class="dropdown-btn">
              <i class="bx bx-file-blank"></i>
              <span class="links_name">Request Records</span> <i class="fa fa-caret-down arrow"></i>
            </a>

          <div class="dropdown-container">
              <a href="tra_request.php" class="sub-item"> <i></i><span class="links_name">Travel Order</span></a>
              <a href="gate_request.php" class="sub-item"> <i></i> <span class="links_name">Gate Pass</span></a>
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
    <nav>
      <div class="sidebar-button">
        <i class='bx bx-menu sidebarBtn'></i>
        <span class="dashboard">Request Credits</span>
      </div>
       <div class="profile-details">
        <img src="profile.png" alt="" onclick="toggleMenu()">
        <span class="admin_name" onclick="toggleMenu()">Administrator </span>
      </div>

      <div class="sub-menu-wrap" id="subMenu">
        <div class="sub-menu">
          <div class="user-info">
            <img src="profile.png" alt="">
            <h5>Administrator</h5>
          </div>
          <hr>

            <a href="profile.php" class="sub-menu-link">
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


  


  
    <div class="home-content">
      <div class="table">
      	<div class="table_ctnt">

        <div class="search">
          <input class="search-box d-search table-filter"  placeholder="search" data-table="table_content">
          <button class="search_here"><i class='bx bx-search'></i></button>
      </div>
      <div class="table_section">
      <div class="<?php echo $alertStyle;?>" role="alert"><?php echo $statusMsg;?></div>

        <table class="table_content">
          <thead>
          
            <div class="add">
              <form method="POST">
             <button type="submit" class="addUser" name="reset"><i class="fa fa-plus-circle"></i>
             Reset All
            </button>
              </form>
            </div><br>

            <!-- Table for list of roles -->
            <tr class="header">
              <th width="300px">Name</th>
              <th width="200px">Request Credits</th>
              <th width="100px">ACTION</th>
            </tr>

          </thead>
          <tbody>

            <?php
            $ret=mysqli_query($conn,"SELECT * from users");
            while ($row=mysqli_fetch_array($ret)) {
              ?>
            <tr>
              <td><?php echo $row['fullName'];?></td>
              <td><?php  echo $row['token'];?></td>
              <td >
              <a href="resetCredits.php?delId=<?php echo $row['id'];?>"><button class="delete"><i class="fa fa-plus-circle"></i></button></a>
              </td>
            </tr> 
            <?php 
  
            }?>

          </tbody>
        </table>
      </div>
  </div>
      </div>

      
    </div>

  </section>

<!--Sidebar-->
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

<script>
	var loadFile = function (event) {
  var image = document.getElementById("output");
  image.src = URL.createObjectURL(event.target.files[0]);
};

	</script>


<!-- Bootstrap Popper with Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
    <script src="../includes/search.js"></script>
</body>
</html>



