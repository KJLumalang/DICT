<?php
session_start(); 
error_reporting();
include ('../includes/config.php');
include ('../includes/login_check.php');

if(isset($_GET['controlNo'])){

    $controlNo = $_GET['controlNo'];

    $query = mysqli_query($conn,"select * from gatepass where id='$controlNo'");

    $rowi = mysqli_fetch_array($query);   

    }

else{
    echo "<script type = \"text/javascript\">
    window.location = (\"../tod/index.php\")
    </script>"; 
}    


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- CSS-->
    <style>
    	/* ===== Google Font Import - Poppins ===== */
			@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600&display=swap');
			*{
			    margin: 0;
			    padding: 0;
			    box-sizing: border-box;
			    font-family: 'Poppins', sans-serif;
			}
			body{
			    min-height: 100vh;
			    display: flex;
			    align-items: center;
			    justify-content: center;
			    font-size:12px;
			    background: rgb(150, 145, 145);;
			}
			.container{
			    position: relative;
			    max-width: 1000px;
			    width: 100%;
			    height:100%;
			    border-radius: 6px;
			    padding-left: 40px;
			    margin: 0 15px;
			    background-color: #fff;
			}
			.center {
			  margin-left: auto;
			  margin-right: auto;
			}
    </style>
     

    <title><?php echo "GATEPASS#".$controlNo."_".$rowi['requestedBy']."_".$rowi['dateRequested'];?></title> 
</head>
<body>

    <div class="container" style=" height:1000px;">
	
	<!--Header-->	
    <table style="margin-left: auto;  margin-right: auto;">
	<tr>
		<td><img style="width:130px;" src="DICT logo.png">
	</td>


	<td>

	<h5 style="text-align: center; letter-spacing: 4px; font-size:12px; color:#0f5387;">REPUBLIC OF THE PHILIPPINES</h5>
	<h4 style="text-align: center; word-spacing: 4px; letter-spacing: 2px; font-size:13px; color:#0f5387;">DEPARTMENT OF INFORMATION AND
	</h4>
	<h4 style="text-align: center; word-spacing: 4px; letter-spacing: 2px; font-size:13px; color:#0f5387;">COMMUNICATION TECHNOLOGY</h4>

	</td>
	</tr>
		</table>

		<table style="width:100%; padding-top: 10px; padding-bottom: 20px;">
			<tr>
				<td style=" border:1px solid; text-align: center;">
				<b>GATE PASS</b>
				</td>
			</tr>
		</table>
	<!-- End of Header -->

		<p style=" padding-left: 20px;" >Official</p>

		<!-- Display Official -->
		<table style="padding-top: 10px; padding-left: 20px; border-spacing: 20px 5px;">
			<tr>
				<td style="width:400px">
				<p><input type="checkbox" <?php echo $rowi['travel'];?>>Travel</p>
				</td>

				<td style="width:400px; border-bottom: 1px solid;">
				<b><?php echo $rowi['travelDesc'];?></b>
				</td>
			</tr>

			<tr>
				<td style="width:400px;">
				<p><input type="checkbox" <?php echo $rowi['stcm'];?>>Seminar/Training/ Conference/ Meeting</p>
				</td>
				<td style="width:400px; border-bottom: 1px solid;">
				<b><?php echo $rowi['stcmDesc'];?></b>
				</td>
			</tr>

			<tr>
				<td style="width:400px;">
				<p><input type="checkbox" <?php echo $rowi['pickup'];?>> Pick-up of documents</p>
				</td>
				<td style="width:400px; border-bottom: 1px solid;">
				<b><?php echo $rowi['pickupDesc'];?></b>
				</td>
			</tr>

			<tr>
				<td style="width:400px;">
				<p> <input type="checkbox" <?php echo $rowi['others'];?>> Others</p>
				</td>
				<td style="width:400px; border-bottom: 1px solid;">
				<b><?php echo $rowi['othersDesc'];?></b>
				</td>
			</tr>
		</table>
		
		<p style="padding-top: 20px; padding-left: 20px;" >Personal</p>

		<!-- Display Personal -->
		<table style="padding-top: 10px; padding-left: 20px; border-spacing: 20px 5px;">
			<tr>
				<td style="width:400px">
				<p><input type="checkbox" <?php if(!empty($rowi['medication'])){echo 'checked';}?>> Medication/Physical Check-up(subject to presentation of Doctor's Certificate)</p>
				</td>
				
			</tr>

			<tr>
				<td style="width:400px;">
				<p><input type="checkbox" <?php if(!empty($rowi['medical'])){echo 'checked';}?>> Medical Attention to Family Member/Relative</p>
				</td>
			
			</tr>

			<tr>
				<td style="width:400px;">
				<p> <input type="checkbox" <?php echo $rowi['others2'];?>> Others</p>
				</td>
				<td style="width:400px; border-bottom: 1px solid;">
				<b><?php echo $rowi['others2Desc'];?></b>
				</td>
			</tr>
		</table>
		
		<!--Display Gate Pass Details-->
		<table style="padding-top: 10px; padding-bottom: 20px; border-spacing: 10px 5px;">
			<tr>
				<td>
				<p>Date:</p>
				</td>
				<td style="width:400px; border-bottom:1px solid;">
				<b><?php echo $rowi['dates'];?></b>
				</td>

				<td>
				<p>Start Time:</p>
				</td>
				<td style="width:150px; border-bottom:1px solid;">
				<b><?php echo $rowi['startTime'];?></b>
				</td>

				<td>
				<p>to</p>
				</td>
				<td style="width:150px; border-bottom:1px solid;">
				<b><?php echo $rowi['endTime'];?></b>
				</td>
			</tr>
			<tr>
				<td>
				<p>Venue:</p>
				</td>
				<td colspan="5" style="width:80px; border-bottom:1px solid;">
				<b><?php echo $rowi['venue'];?></b>
				</td>
			</tr>
		</table>

		<!-- For Approver's Info and Signature -->
		<table style="padding-top: 20px;">
			<tr>
				<td style="width:800px;">
					<b>APPROVED BY:</b>
				</td>
			</tr>
			<tr>
				<td style="width:900px; height:150px; padding-bottom:0px;">
					<b></b>
					<p>Head, Technical Operations Division</p>
				</td>

				<td style="width:500px;">
					<b></b>
					<p>DICT Employee</p>
				</td>
			</tr>
		</table>

    </div>
</body>
</html>