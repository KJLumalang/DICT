<?php
// Starting the session, to use and
// store data in session variable
session_start();
error_reporting(0);
include ('../includes/config.php');
include ('../includes/login_check.php');

$alertStyle=$_GET['alertStyle'];
$statusMsg=$_GET['statusMsg'];

?>

<!DOCTYPE html>

<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
 
    <link rel="stylesheet" href="style.css">
    <title>Admin-Request Records </title>

     <!-- Bootstrap CSS File-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
   </head>
<body>
            <!-- sidebar menu -->
  <div class="sidebar">
    <div class="logo-details">
      <img src="logo.png" alt="">
      <span class="logo_name">DICT</span>
    </div>
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
          <a href="credits.php">
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
        <span class="dashboard">Manage Requests</span>
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

    <!-- Table for list of request -->
    <div class="home-content">
      <div class="table">
        <div class="table_ctnt">

      <div class="search">
          <input class="search-box d-search table-filter" placeholder="search" data-table="table_content">
          <button class="search_here"><i class='bx bx-search'></i></button>
      </div>
      <div class="table_section">
      <div class="<?php echo $alertStyle;?>" role="alert"><?php echo $statusMsg;?></div>
        <table class="table_content">
          <thead>

                <!-- Table for list of Gatepass request -->
            <tr class="header">
            <th>DATE REQUESTED</th>
              <th>CTRL NO.</th>
              <th width="200px">OFFICIAL</th>
              <th width="200px">PERSONAL</th>
              <th width="90px">DATE</th>
              <th width="200px">VENUE</th>
              <th width="150px">START TIME</th>
              <th width="150px">END TIME</th>
              <th >HEAD, TOD <br>APPROVAL STATUS</th>
              <th >REGIONAL DIRECTOR<br> APPROVAL STATUS</th>
              <th colspan="3">ACTIONS</th>
            </tr>
          </thead>
          <tbody>
           
          <?php

$cnt=1;

$ret=mysqli_query($conn,"SELECT * from gatepass");


      while ($row=mysqli_fetch_array($ret)) {
        ?>

    <tr>
      <td><?php echo $row['dateRequested'];?></td>
      <td><?php  echo $row['id'];?></td>
      <td>
      <?php 
      if(!empty($row['travel'])){
            echo "Travel: ";
            echo $row['travelDesc'];
            echo "<br>";

      }

      if(!empty($row['stcm'])){
        echo "Seminar/Training/Conference/Meeting: ";
        echo $row['stcmDesc'];
        echo "<br>";
      }
      if(!empty($row['pickup'])){
        echo "Transportation Pick-up of documents: ";
        echo $row['pickupDesc'];
        echo "<br>";
      }

      if(!empty($row['others'])){
        echo "Others: ";
        echo $row['othersDesc'];
        echo "<br>";
      }
      
      ?>
      </td>

      <td>
      <?php 
      if(!empty($row['medication'])){
        echo "Medication/Physical Check-Up";
        echo "<br>";
      }
      if(!empty($row['medical'])){
        echo "Medical Attention to Family Member/Relative";
        echo "<br>";
      }

      if(!empty($row['others2'])){
        echo "Others: ";
        echo $row['others2Desc'];
        echo "<br>";
      }
      
      ?>
      </td>

      <td><?php echo $row['dates'];?></td>
      <td><?php  echo $row['venue'];?></td>
      <td><?php  echo $row['startTime'];?></td>
      <td><?php  echo $row['endTime'];?></td>
      <td><?php  echo $row['reqStatus'];?></td>
      <td><?php  echo $row['reqStatus2'];?></td>
      <td>
       <a href="../includes/gp.php?controlNo=<?php echo $row['id'];?>" target="_blank"><button class="view"><i class="fa fa-eye"></i></button></a>
       </td>
       <td>
       <a href="../includes/deleteGP.php?delId=<?php echo $row['id'];?>"><button class="delete"><i class="fa fa-ban"></i></button></a>
       </td>
      <?php
      if($row['reqStatus2']=='Approved'){
        echo '<td><a href="../includes/download1.php?controlNo='.$row['id'].'target="_blank"><button class="view"><i class="	fa fa-cloud-download"></i></button></a></td>';
      }
      ?>
      



      
    </tr>
        
<?php 

$cnt=$cnt+1;


}?>
       
          </tbody>
        </table>
        </div>
      </div>
      </div>
    </div>
  </section>

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
<script src="../includes/search.js"></script>
</body>
</html>



