<?php
include('../includes/config.php');

$delId = $_GET['delId'];

$query = mysqli_query($conn,"DELETE FROM roles WHERE id='$delId'");

if ($query == TRUE) {

        echo "<script type = \"text/javascript\">
        window.location = (\"role.php\")
        </script>";  
}
else{

echo "<script type = \"text/javascript\">
        window.location = (\"role.php\")
        </script>";  

}


?>
