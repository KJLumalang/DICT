<?php
include('../includes/config.php');

$delId = $_GET['delId'];

$query = mysqli_query($conn,"DELETE FROM users WHERE id='$delId'");

if ($query == TRUE) {

        echo "<script type = \"text/javascript\">
        window.location = (\"user.php\")
        </script>";  
}
else{

echo "<script type = \"text/javascript\">
        window.location = (\"user.php\")
        </script>";  

}


?>
