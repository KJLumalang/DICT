<?php 
session_start(); 
error_reporting(0);
include ('../includes/config.php');
include ('../includes/login_check.php');

$query = mysqli_query($conn,"select * from users where id='$_SESSION[id]'");
$rowi = mysqli_fetch_array($query);   

if(ISSET($_POST['save'])){


  $controlNo = $_POST['controlNo'];
  $travelorderNo = $_POST['dataid'];

  $update = mysqli_query($conn, "UPDATE travelorder SET controlNo = '$controlNo' where travelorderNo = '$travelorderNo' ");

  if($update){

    $alertStyle ="alert alert-success";
    $statusMsg="Control No. Added";

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
    <title>Record Officer-Request Records </title>
  
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
          <a href="index.php">
            <i class='bx bx-grid-alt'></i>
            <span class="links_name">Dashboard</span>
          </a>
        </li>
        <li>
          <a href="RO_travel_request.php" class="active">
            <i class='bx bx-clipboard' ></i>
            <span class="links_name">Request Records</span>
          </a>
        </li>

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
        <span class="admin_name" onclick="toggleMenu()">Records Officer</span>
      </div>

      <div class="sub-menu-wrap" id="subMenu">
        <div class="sub-menu">
          <div class="user-info">
            <img src="profile.png" alt="">
            <h5><?php echo $rowi['fullName'];?></h5>
          </div>
          <hr>
            <a href="profile_RO.php" class="sub-menu-link">
              <i class='fa fa-user' ></i>
              <p> View Profile </p>
              <span>></span>
            </a>
            <a href="changepass_RO.php" class="sub-menu-link">
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

     <!-- Modal -->
        <div class="modal fade" id="AddNoModal" tabindex="-1" aria-labelledby="AddNoModalLabel" aria-hidden="true">


          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="AddNoModalLabel">Add Travel Order Number</h5>
              </div>
              <div class="modal-body">
                
                <!-- Form to be fill-out to add Travel order number and control number -->
                <form method="POST">

        
                

                    <div class="travel_no">
                      <label for="tn">Control No.</label>
                      <input type="text" class="form-control" id="tn" name="controlNo" required >
                      <!--control number -->
                      <input type="text" class="form-control" name="dataid" id="dataid" value="" hidden/>
            
                    

                    </div><br>

                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                      <button type="submit" class="btn btn-primary" name="save">Save</button>
                    </div><br>
                </form>
              </div>
            </div>
          </div>
        </div>

    <div class="home-content">
      <div class="table">
        <div class="table_ctnt">
          
        <!--Search box-->
      <div class="search">
          <input class="search-box d-search table-filter" placeholder="search" data-table="table_content">
          <button class="search_here"><i class='bx bx-search'></i></button>
      </div>

      <div class="table_section">
      <div class="<?php echo $alertStyle;?>" role="alert"><?php echo $statusMsg;?></div>
        <table class="table_content">
          <thead>
              <!-- Table for list of travel request -->
            <tr class="header">
              <th width="200px">ACTIONS</th>
              <th>Name/s:</th>
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
            </tr>
          </thead>
          <tbody>
            
          <?php

$cnt=1;

$ret=mysqli_query($conn,"SELECT * from travelorder where reqStatus = 'Pending' ");


      while ($row=mysqli_fetch_array($ret)) {
        ?>

    <tr>
      <td class="addbtn">
      <button data-id="<?php echo $row['travelorderNo']; ?>" type="button" class="addNo" onclick="$('#dataid').val($(this).data('id')); $('#AddNoModal').modal('show');"><i class="bx bx-plus"></i></button>
      <br><br>
      </td>
      <td><?php echo $row['travelers'];?></td>
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

<!-- Bootstrap Popper with Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
    <script src="../includes/search.js"></script>
  </body>
</html>



