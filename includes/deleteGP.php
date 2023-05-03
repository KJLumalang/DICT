<?php
session_start();
include ('../includes/config.php');
include ('../includes/login_check.php');


$delId = $_GET['delId'];
$query = mysqli_query($conn,"DELETE FROM gatepass WHERE id='$delId'");


if ($query == TRUE) {

    echo "<script type = \"text/javascript\">
    window.location = (\"../admin/gate_request.php?alertStyle=alert alert-danger&statusMsg=Record Deleted\")
    </script>";  
}
else{

echo "<script type = \"text/javascript\">
    window.location = (\"../admin/gate_request.php\")
    </script>";  

}
?>