<?php
// Starting the session, to use and
// store data in session variable
session_start();
include ('../includes/config.php');
include ('../includes/login_check.php');

  
$query = mysqli_query($conn, "SELECT * FROM users WHERE username='$_SESSION[uname]'");
$rowi=mysqli_fetch_array($query);


?>

<!DOCTYPE html>

<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
 
    <link rel="stylesheet" href="style_HR.css">
    <title>HR-Request Records </title>
  
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
      <img src="profile.png" alt="">
      <span class="logo_name"><?php echo $rowi['fullName'];?></span>
    </div>
      <ul class="nav-links">
        <li>
          <a href="index_HR.html">
            <i class='bx bx-grid-alt'></i>
            <span class="links_name">Dashboard</span>
          </a>
        </li>

       <li>
            <a class="dropdown-btn">
              <i class="bx bx-file-blank"></i>
              <span class="links_name">Request History</span> <i class="fa fa-caret-down arrow"></i>
            </a>

          <div class="dropdown-container">
              <a href="travel_request.php" class="sub-item"> <i></i><span class="links_name">Travel Order</span></a>
              <a href="gatepass_request.php" class="sub-item"> <i></i> <span class="links_name">Gate Pass</span></a>
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
          <a href="../index.php">
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
        <span class="dashboard">Travel Order Requests</span>
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
            <a href="profile_HR.html" class="sub-menu-link">
              <i class='fa fa-user' ></i>
              <p> View Profile </p>
              <span>></span>
            </a>
            <a href="changepass_HR.html" class="sub-menu-link">
              <i class='fa fa-lock' ></i>
              <p> Change Password </p>
              <span>></span>
            </a>
            <a href="../index.php" class="sub-menu-link">
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
          
        <!--Search box-->
      <div class="search">
          <input class="search-box" placeholder="search">
          <button class="search_here"><i class='bx bx-search'></i></button>
      </div>

      <div class="table_section">
        <table class="table_content">
          <thead>
    
             <!-- Table for list of travel request -->
             <tr>
              <th>DATE REQUESTED</th>
              <th>TRAVEL ORDER NO.</th>
              <th>CTRL NO.</th>
              <th>DESTINATION</th>
              <th>INCLUSIVE DATE OF TRAVEL</th>
              <th>END DATE OF TRAVEL</th>
              <th>PURPOSE</th>
              <th>DTE</th>
              <th>APPROPRIATION/FUND</th>
              <th>REMARKS/ SPECIAL INSTRUCTIONS</th>
              <th >HEAD, TOD <br>APPROVAL STATUS</th>
              <th >REGIONAL DIRECTOR<br> APPROVAL STATUS</th>
              <th width="100px">ACTIONS</th>
              <th width="100px"></th>
            </tr>
          </thead>
          <tbody>

<?php

$cnt=1;

$ret=mysqli_query($conn,"SELECT * from travelorder");


      while ($row=mysqli_fetch_array($ret)) {
        ?>

    <tr>
      <td><?php echo $row['dateRequested'];?></td>
      <td><?php  echo $row['travelorderNo'];?></td>
      <td><?php  echo $row['controlNo'];?></td>
      <td><?php  echo $row['destination'];?></td>
      <td><?php  echo $row['inclusiveDate'];?></td>
      <td><?php  echo $row['endDate'];?></td>
      <td><?php  echo $row['purpose'];?></td>
      <td><?php  echo $row['division'];?></td>
      <td>
      <?php 
      if(!empty($row['generalfund'])){
            echo "General Fund:";
            echo "<br>";
            echo $row['generalfundDesc'];
            echo "<br>";

      }

      if(!empty($row['projectfund'])){
        echo "Project Fund:";
        echo "<br>";
        echo $row['projectfundDesc'];
        echo "<br>";
      }

      if(!empty($row['others'])){
        echo "Others:";
        echo "<br>";
        echo $row['othersDesc'];
        echo "<br>";
      }
      
      
      ?>
      </td>
      <td><?php  echo $row['remarks'];?></td>
      <td><?php  echo $row['reqStatus'];?></td>
      <td><?php  echo $row['reqStatus'];?></td>
      <td>
       <a href="../includes/to.php?controlNo=<?php echo $row['controlNo'];?>" target="_blank"><button class="view"><i class="fa fa-eye"></i></button></a>
       </td>
      <?php
      if($row['reqStatus2']=='Approved'){
        echo '<td><a href="../includes/download.php?controlNo='.$row['controlNo'].'target="_blank"><button class="view"><i class="	fa fa-cloud-download"></i></button></a></td>';
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

</body>
</html>



