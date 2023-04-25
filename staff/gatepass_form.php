<?php
// Starting the session, to use and
// store data in session variable
session_start();
error_reporting(0);
include ('../includes/config.php');
include ('../includes/login_check.php');

$query = mysqli_query($conn, "SELECT * FROM users WHERE username='$_SESSION[uname]'");
$result=mysqli_fetch_array($query);
$name = $result['fullName'];

if(ISSET($_POST['submit'])){

    $travel = $_POST['travel'];
    $travelDesc = $_POST['travelDesc'];
    $stcm = $_POST['stcm'];
    $stcmDesc = $_POST['stcmDesc'];
    $pickup = $_POST['pickup'];
    $pickupDesc = $_POST['pickupDesc'];
    $others = $_POST['others'];
    $othersDesc = $_POST['othersDesc'];
    $medication = $_POST['medication'];
    $medical = $_POST['medical'];
    $others2 = $_POST['others2'];
    $others2Desc = $_POST['others2Desc'];
    $dates = $_POST['date'];
    $startTime = $_POST['start'];
    $endTime = $_POST['end'];
    $venue = $_POST['venue'];
    $requestedBy = $name;
    $dateRequested = date("Y/m/d");

    mysqli_query($conn, "INSERT INTO `gatepass`(travel, travelDesc, stcm, stcmDesc, pickup, pickupDesc, others, othersDesc, medication, medical, others2, others2Desc,
    dates, startTime, endTime, venue, requestedBy, reqStatus, reqStatus2, dateRequested) 
  VALUE 
  ('$traveler', '$travelerDesc', '$stcm', '$stcmDesc', '$pickup', '$pickupDesc', '$others', '$othersDesc', '$medication', '$medical', '$others2', '$others2Desc',
  '$dates','$startTime', '$endTime', '$venue', '$requestedBy', 'Pending', 'Pending', '$dateRequested')") or die(mysqli_error());
  



}




?>



<!DOCTYPE html>

<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
 
    <link rel="stylesheet" href="style_STAFF.css">
    <title>Gatepass Form </title>
  
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
      <span class="logo_name"><?php echo $result['fullName'];?></span>
    </div>
      <ul class="nav-links">
        <li>
          <a href="index.php">
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
          <a href="gatepass_form.php" class="active">
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
    <nav>
      <div class="sidebar-button">
        <i class='bx bx-menu sidebarBtn'></i>
        <span class="dashboard">Request Gatepass</span>
      </div>
    </nav>

  
    <div class="home-content">
    	      <div class="container">
  
        <header>Gate Pass Form</header>
        
        <form method="POST">
    
            <div class="form first">
                <div class="details personal">
                  <span class="title">Official</span>

<!--START OF FIELD 1-->
                    <div class="fields">

                      <div class="input-field1">
                          <label>
                          <input type="checkbox" name="travel" value="checked">
                          Travel(Please Specify)
                          </label>
                      </div>

                      <div class="input-field1">
                          <label></label>
                          <input type="text" placeholder="Tech4aed Census/On-site Vsitation" name="travelDesc" >
                      </div>

                      <div class="input-field1">
                          <label>
                          <input type="checkbox"  name="stcm" value="checked">
                          Seminar/Training/Conference/Meeting
                          </label>
                      </div>
            
                      <div class="input-field1">
                          <label></label>
                          <input type="text" placeholder="" name="stcmDesc">
                      </div>

                      <div class="input-field1">
                          <label>
                          <input type="checkbox" name="pickup" value="checked">
                          Transportation Pick-up of documents
                          </label>
                      </div>
            
                      <div class="input-field1">
                          <label></label>
                          <input type="text" placeholder="" name="pickupDesc">
                      </div>

                      <div class="input-field1">
                          <label>
                          <input type="checkbox" name="others" value="checked">
                          Others
                          </label>
                      </div>
            
                      <div class="input-field1">
                          <label></label>
                          <input type="text" placeholder="" name="othersDesc">
                      </div>
                    </div>

                  </div>
        
        

<!--START OF FIELD 2-->
              <div class="DTE">
                  <div class="line"></div>
                      <span class="title">Personal</span>

                  <div class="fields">
          
                       <div class="input-field1">
                          <label>
                          <input type="checkbox" name="medication" value="Medication/Physical Check-Up">
                          Medication/Physical Check-Up</label>
                      </div>
            
                      <div class="input-field1">
                          <label></label>
                        
                      </div>

                      <div class="input-field1">
                          <label>
                          <input type="checkbox" name="medical" value="Medical Attention to Family Member/Relative">
                          Medical Attention to Family Member/Relative</label>       
                      </div>
                        
                      <div class="input-field1">
                          <label></label>   
                      </div>
                      <div class="input-field1">
                          <label>
                          <input type="checkbox" name="others2" value="checked">
                          Others
                          </label>
                      </div>
            
                      <div class="input-field1">
                          <label></label>
                          <input type="text" placeholder="" name="others2Desc">
                      </div>
                    </div>


                </div>


                  <div class="fields">
          
                       <div class="input-field1">
                          <label>Date/s:</label>
                          <input type="date" class="" placeholder="" name="date" required>
                      </div>
            
                      <div class="input-field1">
                          <label>Venue:</label>
                          <input type="text" placeholder="" name="venue"  required>
                      </div>
            
                      <div class="title">
                          <label style="font-size:15px;">Start Time:</label>
                          <br>
                          <input type="time" placeholder="" name="start" required>
                          <label style="font-size:15px;">to</label>
                          <input type="time" placeholder="" name="end" required>
                      </div>

                </div>

          
               <div class="buttons">

                      <input class="reset" type="reset">  
                      <button class="submit" name="submit">
                          <span class="btnText">Submit</span>
                      </button>
                   
                </div>


          </div>  

        </form>
        </div>


    <!--
       <div class="container">
        <header> GATEPASS FORM</header>

        <form action="#">
          <div class="form first">
              
                <span class="title">Official</span>


                  <div class="fields">
                      <div class="input-field1">
                          <label>
                          <input type="checkbox"  required>
                          Travel(Please Specify)
                          </label>
                      </div>

                      <div class="input-field1">
                          <label></label>
                          <input type="text" placeholder="Tech4aed Census/On-site Vsitation" required>
                      </div>

                      <div class="input-field1">
                          <label>
                          <input type="checkbox"  required>
                          Seminar/Training/Conference/Meeting
                          </label>
                      </div>
            
                      <div class="input-field1">
                          <label></label>
                          <input type="text" placeholder="" required>
                      </div>

                      <div class="input-field1">
                          <label>
                          <input type="checkbox"  required>
                          Transportation Pick-up of documents
                          </label>
                      </div>
            
                      <div class="input-field1">
                          <label></label>
                          <input type="text" placeholder="" required>
                      </div>

                      <div class="input-field1">
                          <label>
                          <input type="checkbox"  required>
                          Others
                          </label>
                      </div>
            
                      <div class="input-field1">
                          <label></label>
                          <input type="text" placeholder="" required>
                      </div>

                  </div>

              </div>

                <div class="DTE">
                  <span class="title">Personal</span>

                  <div class="fields">   
            
                      <div class="input-field1">
                          <label>
                          <input type="checkbox">
                          Medication/Physical Check-Up</label>
                      </div>
            
                      <div class="input-field1">
                          <label></label>
                        
                      </div>

                      <div class="input-field1">
                          <label>
                          <input type="checkbox">
                          Medical Attention to Family Member/Relative</label>       
                      </div>
                        
                      <div class="input-field1">
                          <label></label>
                            
                      </div>
<!--OTHER GUI-->
            <!--
                      <div class="input-field1">
                          <label>
                          <input type="checkbox">
                          Others
                          <input type="text" style="width:400px;" class="oth" placeholder="Please specify" required>
                          </label>
                      </div>
        
                  </div> 
                </div> 

                <div class="fields">   
                      <div class="input-field1">
                          <label>Date/s:</label>
                          <input type="date" class="" placeholder="" required>
                      </div>
            
                      <div class="input-field1">
                          <label>Venue:</label>
                          <input type="text" placeholder="" required>
                      </div>
            
                      <div class="title">
                          <label>Start Time</label>
                          <input type="time" placeholder="" required>
                          <label>to</label>
                          <input type="time" placeholder="" required>
                      </div>
                </div>

        
                <div class="buttons">

                      <input class="reset" type="reset">  
                      <button class="submit">
                          <span class="btnText">Submit</span>
                      </button>
                   
                </div>

            </div>
        </form>
   </div>
    </div>
	
<!-->
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


</body>
</html>



