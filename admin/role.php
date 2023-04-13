<?php 
session_start(); 
error_reporting(0);
include ('../includes/config.php');

if(isset($_POST['submit'])){

    $role = $_POST['role'];
  

    $query=mysqli_query($conn,"insert into roles (roleName) value('$role')");
    
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
          <a href="role.php" class="active">
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
        <span class="dashboard">List of Roles</span>
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


     <!-- Add Role Modal -->
        <div class="modal fade" id="AddRoleModal" tabindex="-1" aria-labelledby="AddRoleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="AddRoleModalLabel">Add New Roles</h5> 
              </div>
              <div class="modal-body">

                <!-- Form to be fill-out to add New role -->
                <form method="POST">
                    <div class="role_name">
                      <label for="role_name">Role Name*</label>
                      <input type="text" class="form-control" id="role" name="role" required >
                    </div><br>

                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      <button type="submit" class="btn btn-primary" name="submit">Add</button>
                    </div><br>
                </form>
              </div>
            </div>
          </div>
        </div>

    

  
    <div class="home-content">
      <div class="table">
      	<div class="table_ctnt">
        

      <div class="table_section">
      <div class="<?php echo $alertStyle;?>" role="alert"><?php echo $statusMsg;?></div>

        <table class="table_content">
          <thead>

            <!--Modal - Button used to add New Role-->
            <div class="add">
             <button type="button" class="addUser" data-toggle="modal" data-target="#AddRoleModal"><i class="fa fa-plus-circle"></i>
              Add New
            </button>
            </div><br>

            <!-- Table for list of roles -->
            <tr>
              <th width="200px">NO.</th>
              <th width="300px">ROLE</th>
              <th width="200px">ACTION</th>
            </tr>

          </thead>
          <tbody>

            <?php
            $ret=mysqli_query($conn,"SELECT * from roles");
            while ($row=mysqli_fetch_array($ret)) {
              ?>
            <tr>
              <td><?php echo $row['id'];?></td>
              <td><?php  echo $row['roleName'];?></td>
              <td>
              <a href="deleteRole.php?delId=<?php echo $row['id'];?>"><button class="delete"><i class="fa fa-trash"></i></button></a>
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

</body>
</html>



