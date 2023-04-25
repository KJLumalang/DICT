<?php 
session_start(); 
error_reporting();
include ('../includes/config.php');
include ('../includes/login_check.php');

$query = mysqli_query($conn,"select * from users where id='$_SESSION[id]'");
$rowi = mysqli_fetch_array($query);   


// Uploads files and approved
if (isset($_POST['upload'])) { // if save button on the form is clicked
    // name of the uploaded file
    $filename = $_FILES['myfile']['name'];
    $controlNo =$_POST['controlNo'];
    $dateApproved = date("Y/m/d");

    // destination of the file on the server
    $destination = 'uploads/' . $filename;

    // get the file extension
    $extension = pathinfo($filename, PATHINFO_EXTENSION);

    // the physical file on a temporary uploads directory on the server
    $file = $_FILES['myfile']['tmp_name'];
    $size = $_FILES['myfile']['size'];

    if (!in_array($extension, ['zip', 'pdf', 'docx'])) {
        echo "You file extension must be .zip, .pdf or .docx";
    } elseif ($_FILES['myfile']['size'] > 1000000) { // file shouldn't be larger than 1Megabyte
        echo "File too large!";
    } else {
        // move the uploaded (temporary) file to the specified destination
        if (move_uploaded_file($file, $destination)) {

            $sql=mysqli_query($conn,"INSERT INTO travelorderfiles (controlNo, name, size, downloads) VALUES ('$controlNo', '$filename', $size, 0)");

            if ($sql) {

                $alertStyle ="alert alert-success";
                $statusMsg="File Added Successfully!";
          
                $update = mysqli_query($conn, "UPDATE travelorder SET reqStatus2 = 'Approved', dateApproved = '$dateApproved' where controlNo = '$controlNo'");


            }
        } else {

            $alertStyle ="alert alert-danger";
            $statusMsg="An error Occurred!";

        }
    }
}

//if disapproved
if (isset($_POST['disapproved'])) { 

  $controlNo =$_POST['controlNo'];
  $update = mysqli_query($conn, "UPDATE travelorder SET reqStatus2 = 'Disapproved' where controlNo = '$controlNo'");

}
?>

<!DOCTYPE html>

<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
 
    <link rel="stylesheet" href="RD_style.css">
    <title>RD-Travel Request </title>
  
    

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
          <a href="employee_gatepass.php">
            <i class='bx bx-door-open' ></i>
            <span class="links_name">Gatepass Request</span>
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
    <nav>
      <div class="sidebar-button">
        <i class='bx bx-menu sidebarBtn'></i>
      </div>
       <div class="profile-details">
        <img src="profile.png" alt="" onclick="toggleMenu()">
        <span class="admin_name" onclick="toggleMenu()">DICT Employee</span>
      </div>

      <div class="sub-menu-wrap" id="subMenu">
        <div class="sub-menu">
          <div class="user-info">
            <img src="profile.png" alt="">
            <h5><?php echo $rowi['fullName'];?></h5>
          </div>
          <hr>

            <a href="employee_profile.php" class="sub-menu-link">
              <i class='fa fa-user' ></i>
              <p> View Profile </p>
              <span>></span>
            </a>
            <a href="employee_changepass.php" class="sub-menu-link">
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
          
    <!--List of Travel Request that will be checked by the approver-->
      	<div class="table_ctnt">
          
        <div class="twelve">
          <h4>List of Travel Request</h4>
        </div>

      <div class="search">
          <input class="search-box" placeholder="search">
          <button class="search_here"><i class='bx bx-search'></i></button>
      </div><br>

      <div class="<?php echo $alertStyle;?>" role="alert"><?php echo $statusMsg;?></div>

      <div class="table_section">

     
        <table class="table_req">
          
          <tbody>
          
          <?php
            $cnt=1;
            $ret=mysqli_query($conn,"SELECT * from travelorder where reqStatus = 'Approved' and reqStatus2 = 'Pending' and controlNo != '0'");


      while ($row=mysqli_fetch_array($ret)) {
        ?>
            <form method="POST" enctype="multipart/form-data">
            <tr>
            <td data-label="DATE REQUESTED"><?php echo $row['dateRequested'];?></td>
            <td data-label="TRAVEL ORDER NUMBER"><?php echo $row['travelorderNo'];?></td>
            <td data-label="CONTROL NUMBER"><?php echo $row['controlNo'];?></td>
            <td data-label="TRAVEL REQUEST FILE"><i class='bx bxs-file-pdf' ></i><a href="../includes/downloadRD.php?controlNo=<?php echo $row['controlNo'];?>" target="_blank"><?php echo "TO#".$row['controlNo']."_".$row['requestedBy']."_".$row['dateRequested'];?></a></td>
  
            <td height="80px" data-label="SIGNED/APPROVED REQUEST">
              <input class="upload_btn" type="file" id="upload-file" name="myfile" required>
              <input value="<?php echo $row['controlNo'];?>" name="controlNo" type="hidden">

              </button>
            </td>

            <td data-label="ACTION">
              <button class="action_btn" id="approve" for= "upload-file" type="submit" class="upload_btn" value="Upload" name="upload">Approve</button>
              <button class="action_btn" id="disapprove" value="Disapproved" type="submit" name="disapproved" formnovalidate>Disapprove</button>
            </td>
          </tr>
      </form>
        
<?php 

$cnt=$cnt+1;


}?>


        </tbody>
        </table>
      </div>
      </div>
    </div>
    </div>

      
    </div>

  </section>

<script>
            let btn = document.querySelector(".loader"),
                spinIcon = document.querySelector(".spinner"),
                btnText = document.querySelector(".btn-text");

            btn.addEventListener("click", () => {
                btn.style.cursor = "wait";
                btn.classList.add("checked");
                spinIcon.classList.add("spin");
                btnText.textContent = "Uploading";

            setTimeout(() => {
                btn.style.pointerEvents = "none";
                spinIcon.classList.replace("spinner", "check");
                spinIcon.classList.replace("fa-spinner", "fa-check");
                btnText.textContent = "File Uploaded";

            }, 5000) //1s = 1000ms
            });
</script>

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



