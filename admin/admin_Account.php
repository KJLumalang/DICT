<?php 
session_start(); 
error_reporting(0);
include ('../includes/config.php');

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
 
    <link rel="stylesheet" href="style.css">
    <title>Admin-Manage Users </title>
  
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
      <ul class="nav-links">
        <li>
          <a href="index.php">
            <i class='bx bx-grid-alt'></i>
            <span class="links_name">Dashboard</span>
          </a>
        </li>
        <li>
          <a href="User.php" class="active">
            <i class='bx bxs-group'></i>
            <span class="links_name">Users</span>
          </a>
        </li>
        <li>
          <a href="role.html">
            <i class='fa fa-star'></i>
            <span class="links_name">Role</span>
          </a>
        </li>
        <li>
          <a href="tra_request.php">
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
        <span class="dashboard">User Management</span>
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
            <a href="../index.php" class="sub-menu-link">
              <i class='fa fa-sign-out'></i>
              <p> Logout </p>
              <span>></span>
            </a>

        </div>
      </div>
    </nav>

     <!-- Modal -->
        <div class="modal fade" id="AddUserModal" tabindex="-1" aria-labelledby="AddUserModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="AddUserModalLabel">Add New User</h5>
              </div>
              <div class="modal-body">

                <!-- Form to be fill-out to add new user -->
                <form method="POST">
                	<div class="profile_pic">
                      <img src="profile.png" id="output" width=100 height=100 alt="">
                      <div class="round">
                        <input id="file" type="file" onchange="loadFile(event)"/>
                        <i class="fa fa-camera" style="color:#fff"></i>
                      </div>
                    </div>

                    <div class="full_name">
                      <label for="addUser01">Full Name*</label>
                      <input type="text" class="form-control" id="addUser01" name="fullname" required >
                    </div><br>

                    <div class="sex">
                      <label for="sex">Sex*</label><br>
                      <input type="radio" id="male" name="sex" value="Male" required>
                      <label for="male">Male</label><br>
                      <input type="radio" id="css" name="sex" value="Female" required>
                      <label for="female">Female</label>
                    </div><br>

                    <div class="age">
                      <label for="age">Age*</label>
                      <input type="text" class="form-control" id="age" name="age" required >
                    </div><br>

                    <div class="position">
                      <label for="addUser02">Position*</label>
                      <input type="text" class="form-control" id="addUser02" name="position"required>
                    </div><br>


                    <div class="role">
                      <label for="addUser03">Role*</label>
                      <input type="text" class="form-control" id="addUser03" name="role" required>
                    </div><br>

                    <div class="region">
                      <label for="addUser04">Region*</label>
                      <input type="text" class="form-control" id="addUser04" name="region" required>
                    </div><br>


                    <div class="province">
                      <label for="addUser05">Province*</label>
                      <input type="text" class="form-control" id="addUser05"  name="province" required>
                    </div><br>

                    <div class="municipality">
                      <label for="addUser06">Municipality*</label>
                      <input type="text" class="form-control" id="addUser06" name="municipality" required>
                    </div><br>


                    <div class="division_agency">
                      <label for="addUser07">Division/Agency*</label>
                      <input type="text" class="form-control" id="addUser07" name="division" required>
                    </div><br>

                    <div class="user_email">
                      <label for="addUser08">User Email*</label>
                      <input type="text" class="form-control" id="addUser08" name="email" required>
                    </div><br>

                    <div class="password">
                      <label for="addUser09">Password*</label>
                      <input type="text" class="form-control" id="addUser09" name="password" required>
                    </div><br>

                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      <button type="submit" class="btn btn-primary" name="submit">Add User</button>
                    </div><br>
                </form>
              </div>
            </div>
          </div>
        </div>

  
    <div class="home-content">
      <div class="table">
          <div class="btn">
              <a href="user.php">Staff</a>
              <a href="hr_Account.php">HR/AFD</a>
              <a href="RO_Account.php">Record Officer</a> >
              <a href="TOD_Account.php">Head TOD</a> >
              <a href="RD_Account.php">Regional Director</a> >
              <a href="admin_Account.php" class="act">Admin</a>
          </div>
        <div class="table_ctnt">
        
      <div class="search">
          <input class="search-box" placeholder="search">
          <button class="search_here"><i class='bx bx-search'></i></button>
      </div>

      <div class="table_section">

      <div class="<?php echo $alertStyle;?>" role="alert"><?php echo $statusMsg;?></div>
      
        <table class="table_content">
          <thead>

            <!--Modal - Button used to add new user-->
            <div class="add">
             <button type="button" class="addUser" data-toggle="modal" data-target="#AddUserModal"><i class="bx bx-user-plus"></i>
              Add New User
            </button>
            </div><br>

            <!-- Table for list of users -->
            <tr>
              <th width="100px">ID NO.</th>
              <th>IMAGE</th>
              <th width="500px">FULLNAME</th>
              <th width="150px">USER EMAIL</th>
              <th width="100px">POSITION</th>
              <th>ROLE</th>
              <th width="200px">REGION</th>
              <th width="150px">PROVINCE</th>
              <th width="150px">DIVISION/AGENCY</th>
              <th width="200px">ACTION</th>
            </tr>
          </thead>
          <tbody>
             <?php

        $cnt=1;

        $ret=mysqli_query($conn,"SELECT * from users where userType = 'admin' ");
        

              while ($row=mysqli_fetch_array($ret)) {
                ?>

            <tr>
              <td><?php echo $row['id'];?></td>
              <td><img src="profile.png" width=50 height=50 alt=""></td>
              <td><?php  echo $row['fullName'];?></td>
              <td><?php  echo $row['username'];?></td>
              <td><?php  echo $row['position'];?></td>
              <td><?php  echo $row['userType'];?></td>
              <td><?php  echo $row['region'];?></td>
              <td><?php  echo $row['province'];?></td>
              <td><?php  echo $row['division'];?></td>
              <td>
               <a href="viewProfile.php?editId=<?php echo $row['id'];?>"><button class="view"><i class="fa fa-eye"></i></button></a>
               <a href="viewProfile.php?editId=<?php echo $row['id'];?>"><button class="edit"><i class="fa fa-edit"></i></button></a>
               <a href="deleteUser.php?delId=<?php echo $row['id'];?>"><button class="delete"><i class="fa fa-trash"></i></button></a>
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

</body>
</html>



