<?php
include('../includes/config.php');

$delId = $_GET['delId'];

$query = mysqli_query($conn,"UPDATE users SET token ='18' WHERE id='$delId' ");

if ($query == TRUE) {

        echo "<script type = \"text/javascript\">
        window.location = (\"credits.php?alertStyle=alert alert-success&statusMsg=Reset Succesful!\")
        </script>";  
}
else{

echo "<script type = \"text/javascript\">
        window.location = (\"credits.php?alertStyle=alert alert-danger&statusMsg=An error Occurred!\")
        </script>";  

}


?>
