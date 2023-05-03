<?php
session_start();
include ('../includes/config.php');
include ('../includes/login_check.php');



if (isset($_GET['controlNo'])) {
    $id = $_GET['controlNo'];

    // fetch file to download from database
    $result = mysqli_query($conn,"SELECT * FROM travelorderfiles2 WHERE controlNo= '$id' ");
    $file = mysqli_fetch_assoc($result);

    $filepath = '../rd/uploads/' . $file['name'];

    if (file_exists($filepath)) {
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename=' . basename($filepath));
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize('../rd/uploads/' . $file['name']));
        readfile('../rd/uploads/' . $file['name']);

        // Now update downloads count
        $newCount = $file['downloads'] + 1;
        $updateQuery = mysqli_query($conn,"UPDATE travelorderfiles SET downloads=$newCount WHERE controlNo=$id");
        exit;
    }

}
?>