<?php
// Starting the session, to use and
// store data in session variable
session_start();
error_reporting(0);
include ('../includes/config.php');


  
// If the session variable is empty, this
// means the user is yet to login
// User will be sent to 'login.php' page
// to allow the user to login
if (!isset($_SESSION['uname'])) {
    header('location: ../index.php?error=You have to log in first');
}


$query = mysqli_query($conn, "SELECT * FROM users WHERE username='$_SESSION[uname]'");
$result=mysqli_fetch_array($query);


if(ISSET($_POST['submit'])){

  $travelers = $_POST['travelers'];
  $travelers1=implode('<br>', $travelers);

  $destination = $_POST['destination'];
  $inclusiveDate = $_POST['inclusiveDate'];
  $endDate = $_POST['endDate'];
  $division = $_POST['division'];
  $purpose = $_POST['purpose'];
  $actual = $_POST['actual'];
  $perDiem = $_POST['perDiem'];
  $transpo = $_POST['transpo'];
  $others = $_POST['others'];
  $generalfund = $_POST['generalfund'];
  $projectfund = $_POST['projectfund'];
  $others1 = $_POST['others1'];
  $remakrs = $_POST['remarks'];
  $dateRequested = date("Y/m/d");
  $reqStatus = "Pending";
  $reqStatus2 = "Pending";
  $requestedBy = $result['fullName'];

  $actualCB = $_POST['actualCB'];
  $perDiemCB = $_POST['perDiemCB'];
  $transpoCB = $_POST['transpoCB'];
  $othersCB = $_POST['othersCB'];
  $generalFundCB = $_POST['generalFund'];
  $projectFundCB = $_POST['projectFund'];
  $Others1CB = $_POST['Others1'];



  mysqli_query($conn, "INSERT INTO `travelorder`(travelers, destination, inclusiveDate, endDate, division, purpose, actualDesc, perDiemDesc, transpoDesc, othersDesc, generalfundDesc, projectfundDesc, others1Desc, remarks, dateRequested, reqStatus, reqStatus2, requestedBy,
  actual, perDiem, transpo, others, generalfund, projectfund, others1 ) 
  VALUE 
  ('$travelers1', '$destination', '$inclusiveDate', '$endDate', '$division', '$purpose', '$perDiem', '$transpo', '$travelers1', '$others', '$generalfund', '$projectfund', '$others1', '$remarks', '$dateRequested', '$reqStatus', '$reqStatus2', '$requestedBy',
  '$actualCB', '$perDiemCB', '$transpoCB', '$othersCB', '$generalFundCB', '$projectFundCB', '$Others1CB')") or die(mysqli_error());
  
}


?>


<!DOCTYPE html>

<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
 
    <link rel="stylesheet" href="style_STAFF.css">
    <title>Travel Order Form </title>
  
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
          <a href="index_STAFF.html">
            <i class='fa fa-user-circle' ></i>
            <span class="links_name">Profile</span>
          </a>
        </li>
        <li>
          <a href="travel_form.html" class="active">
            <i class='fa fa-wpforms' ></i>
            <span class="links_name">Request Travel Order</span>
          </a>
        </li>
         <li>
          <a href="gatepass_form.html">
            <i class='bx bx-file' ></i>
            <span class="links_name">Request Gatepass</span>
          </a>
        </li>
        <li>
          <a href="to_record.html">
            <i class='bx bx-file-blank' ></i>
            <span class="links_name">Request History</span>
          </a>
        </li>
        <li class="log_out">
          <a href="login.html">
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
        <span class="dashboard">Request Travel Order</span>
      </div>
    </nav>

  
    <div class="home-content">
      <div class="container">
  
        <header>Travel Order Form</header>
        
        <form method="POST">
    
            <div class="form first">
                <div class="details personal">
                  <span class="title">Local Travel Order</span>


<!--START OF FIELD 1-->
                    <div class="fields">

                      <div class="input-field1">
                         <span>Traveler's Info</span>
                      </div>

                      <div class="input-field1">
                       <button style=" width:40px; height:40px;" type="button" class="btn btn-success btn-sm" onclick="addEntry();"><i class="bx bx-plus"></i></button>
                      </div>

                      <div class="input-field1">
                      <div id="travelers">
                        <div class="form-group">
                          <input type="text" name="travelers[]" placeholder="Name/Position/Division" class="form-control" required="required"/>
                        </div>
                      </div>
                    </div>
                    </div>
                  </div>
<!--JS for Adding Multiple name input -->
<script>
function addEntry(){
  var entry="<input type='text' name='travelers[]' placeholder='Name/Position/Division' class='form-control'/>";
  var element=document.createElement("div");
  element.setAttribute('class', 'form-group');
  element.innerHTML=entry;
  document.getElementById('travelers').appendChild(element);
}
</script>
        
              <div class="DTE">
                  <div class="line"></div>

                  <div class="fields">
                        <div class="input-field1">
                            <label>Travel Order Number</label>
                            <input type="text" placeholder="Control Number to be assigned by the Records Officer" disabled>
                        </div>
                        <div class="input-field1">
                            <label>Destination</label>
                            <input type="text" placeholder="Enter your destination" name="destination" required>
                        </div>

                        <div class="input-field1">
                            <label>Inclusive Date/s of travel</label>
                            <input type="date" name="inclusiveDate" required>
                        </div>
                        <div class="input-field1">
                            <label>End Date of travel</label>
                            <input type="date" name="endDate" required>
                        </div>
            
                      <div class="input-field1">
                            <label>Purpose/s of Travel</label>
                            <input type="text" placeholder="Enter purpose" name="purpose" required>
                        </div>
                </div>
              </div>


<!--START OF FIELD 2-->
              <div class="DTE">
                  <div class="line"></div>
                      <span class="title">Daily Travel Expenses (DTE) to be incured:</span>

                  <div class="fields">
          
                      <div class="input-field1">
                          <label>
                          <input type="checkbox" id="actual" onclick="showBox()" name="actualCB" value="checked">
                          Actual
                          </label>
                      </div>

                      <div class="input-field1">
                          <label></label>
                          <input type="text" placeholder="" id="actualInput" name="actual" disabled>
                      </div>

                      <div class="input-field1">
                          <label>
                          <input type="checkbox" id="perDiem" onclick="showBox()" name="perDiemCB" value="checked">
                          Per Diem
                          </label>
                      </div>
            
                      <div class="input-field1">
                          <label></label>
                          <input type="text" placeholder="eg. meal, incidental expences" id="perDiemInput" name="perDiem" disabled>
                      </div>

                      <div class="input-field1">
                          <label>
                          <input type="checkbox" id="transpo" onclick="showBox()" name="transpoCB" value="checked">
                          Transportation
                          </label>
                      </div>
            
                      <div class="input-field1">
                          <label></label>
                          <input type="text" placeholder="eg. official vehicle, public conveyance" id="transpoInput" name="transpo" disabled>
                      </div>

                      <div class="input-field1">
                          <label>
                          <input type="checkbox" id="others" onclick="showBox()" name="othersCB" value="checked">
                          Others
                          </label>
                      </div>
            
                      <div class="input-field1">
                          <label></label>
                          <input type="text" placeholder="Please Specify" id="othersInput" name="others" disabled>
                      </div>
                </div>
              </div>

                <div class="DTE">
                  <div class="line"></div>
                      <span class="title">Fund to which travel expenses would be charged to:</span>

                  <div class="fields">
          
                       <div class="input-field1">
                          <label>
                          <input type="checkbox" onclick="showBox()" name="generalFund" id="generalFund" value="checked">
                          General Fund (GAA)
                          </label>
                      </div>

                      <div class="input-field1">
                          <label></label>
                          <input type="text" placeholder="" name="generalfund" id="generalfund" disabled>
                      </div>

                      <div class="input-field1">
                          <label>
                          <input type="checkbox" onclick="showBox()" name="projectFund" id="projectFund" value="checked">
                          Project Funds
                          </label>
                      </div>
            
                      <div class="input-field1">
                          <label></label>
                          <input type="text" placeholder="Please Specify" name="projectfund" id="projectfund" disabled>
                      </div>

                      <div class="input-field1">
                          <label>
                          <input type="checkbox" onclick="showBox()" name="Others1" id="Others1" value="checked">
                          Others
                          </label>
                      </div>
            
                      <div class="input-field1">
                          <label></label>
                          <input type="text" placeholder="eg. sponsor/ requesting agency" name="others1" id="others1" disabled>
                      </div>

                </div>
                 </div>

                <div class="DTE">
                  <div class="line"></div>

                  <div class="fields">
        
                      <div class="input-field1">
                          <label>
                         Remarks/ Special Instructions:
                          </label>
                      </div>
            
                      <div class="input-field1">
                          <label></label>
                          <input type="text" placeholder="" name="remarks">
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


      
    </div>

  </section>

  <script>


//lock inputs with checkbox
function showBox() {

  document.getElementById('actual').onchange = function() {
    document.getElementById('actualInput').disabled = !this.checked;
  }

  document.getElementById('perDiem').onchange = function() {
    document.getElementById('perDiemInput').disabled = !this.checked;
  }

  document.getElementById('transpo').onchange = function() {
    document.getElementById('transpoInput').disabled = !this.checked;
  }


  document.getElementById('others').onchange = function() {
    document.getElementById('othersInput').disabled = !this.checked;
  }

  document.getElementById('generalFund').onchange = function() {
    document.getElementById('generalfund').disabled = !this.checked;
  }

  document.getElementById('projectFund').onchange = function() {
    document.getElementById('projectfund').disabled = !this.checked;
  }

  document.getElementById('Others1').onchange = function() {
    document.getElementById('others1').disabled = !this.checked;
  }


}

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






<!-- Bootstrap Popper with Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>

</body>
</html>



