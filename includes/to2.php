<?php
session_start(); 
error_reporting();
include ('../includes/config.php');
include ('../includes/login_check.php');

if(isset($_GET['controlNo'])){

    $controlNo = $_GET['controlNo'];

    $query = mysqli_query($conn,"select * from travelorder where controlNo='$controlNo'");

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
    <type="text/css" media="print" />
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

			.button {
			background-color: #4CAF50; /* Green */
			border: none;
			color: white;
			padding: 7px 20px;
			text-align: center;
			text-decoration: none;
			display: inline-block;
			font-size: 12px;
			margin: 4px 2px;
			cursor: pointer;
			-webkit-transition-duration: 0.4s; /* Safari */
			transition-duration: 0.4s;
			float: right;
			}

			.button1 {
			box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.19);
			}

			.button2:hover {
			box-shadow: 0 12px 16px 0 rgba(0,0,0,0.24),0 17px 50px 0 rgba(0,0,0,0.19);
			}

    </style>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js "></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
	<script>
		window.jsPDF = window.jspdf.jsPDF;
		var docPDF = new jsPDF();
		function print(){
		var elementHTML = document.querySelector("#print");
		docPDF.html(elementHTML, {
		callback: function(docPDF) {
		docPDF.save('<?php echo $controlNo;?>');
		},
		x: 15,
		y: 15,
		width: 100%,
		windowWidth: 650
		});
		}
	</script>	
    <title><?php echo "TO#".$controlNo."_".$rowi['requestedBy']."_".$rowi['dateRequested'];?></title> 
</head>

<body>

    <div class="container" id="print">
	<!--Header-->	
    <table style="margin-left: auto;  margin-right: auto;">
	<tr>
	<td><img style="width:130px; display:block;" src="DICT logo.png">
	</td>


	<td>

	<h5 style="text-align: center; letter-spacing: 4px; font-size:12px; color:#0f5387;">REPUBLIC OF THE PHILIPPINES</h5>
	<h4 style="text-align: center; word-spacing: 4px; letter-spacing: 2px; font-size:13px; color:#0f5387;">DEPARTMENT OF INFORMATION AND
	</h4>
	<h4 style="text-align: center; word-spacing: 4px; letter-spacing: 2px; font-size:13px; color:#0f5387;">COMMUNICATION TECHNOLOGY</h4>

	</td>
	</tr>
	</table>

	<!--Display the Travel Order & Control number and date.-->
		<table style="padding-top: 10px; padding-bottom: 20px;">
			<tr>
				<td style="width:600px">
					<!--Display Travel Order Number-->
					<b>LOCAL TRAVEL ORDER NO:</b>
					<b> <?php echo $rowi['travelorderNo'];?></b>
				</td>

				<td style="text-align:right;">
					<!--Display Date Requested-->
					<b>DATE: </b>
				</td>
				<td>
					<p>&nbsp;<?php echo $rowi['dateRequested'];?></p>
				</td>
			</tr>

			<tr>
				<td>
					<p>Series of 2023</p>
				</td>

				<td style="text-align:right;">
					<!--Display Control Number-->
					<b>CTRL No:</b>
				</td>
				<td>
					<p>&nbsp;<?php echo $rowi['controlNo'];?></p>
				</td>
			</tr>
		</table>

		<p> Authority to travel is hereby granted to:</p>

		<!--Display Personal Details of a person who is traveling.-->
		<table style="padding-top: 10px; padding-bottom: 20px; padding-left: 100px;">
			<tr>
				<td style="width:300px">
				<b>NAME/ POSITION/ DIVISION</b>
				</td>
			</tr>

			<tr>
				<td style="width:300px;">
				<p><?php echo $rowi['travelers'];?></p>
				</td>
			</tr>
		</table>

		<hr>

		<!--Display the Travel Details-->
		<table style="padding-top: 10px; border-spacing: 20px 5px;">
			<tr>
				<td style="width:400px">
					<b>Destination</b>
				</td>

				<td style="width:400px">
					<b>Purpose of Travel</b>
				</td>
			</tr>
			<tr>
				<td style="border-bottom:1px solid;">
					<!--Destination info-->
					<p><?php echo $rowi['destination'];?></p>
				</td>
					<!--Purpose of Travel info-->
				<td style="border-bottom:1px solid;">
					<p><?php echo $rowi['purpose'];?></p>
				</td>
			</tr>
		</table>

		<table style="padding-top: 10px; padding-bottom: 20px; border-spacing: 20px 5px;">
			<tr>
				<td style="width:400px">
				<b>Inclusive Date of Travel</b>
				</td>

				<td style="width:400px">
				<b>End Date of Travel</b>
				</td>
			</tr>
			<tr>
				<!--For Includive Date-->
				<td style="border-bottom:1px solid;">
				<p><?php echo $rowi['inclusiveDate'];?></p>
				</td>
				<!--For End Date-->
				<td style="border-bottom:1px solid;">
				<p><?php echo $rowi['endDate'];?></p>
				</td>
			</tr>
		</table>
<div>
	<div style="width: 100%; height:200px;">
        	<div style="width: 30%; height:150px; float: left;"> 

        		<!--Display Daily Travel Expenses (DTE)-->
            	<table style=" width:250px; padding-left:10px; padding-top: 10px;">
			      		<caption>
							
							<b>Daily Travel Expenses (DTE) to be incurred:</b>
							
						</caption>

						<tr>
							<td>
							<b><input type="checkbox" <?php echo $rowi['actual'];?> disabled> Actual</b>
							<p style="padding-left: 30px;"><?php echo $rowi['actualDesc'];?></p>
							</td>
						</tr>

						<tr>
							<td>
							<b><input type="checkbox" <?php echo $rowi['perDiem'];?> disabled> Per Diem</b>
							<p style="padding-left: 30px;"><?php echo $rowi['perDiemDesc'];?></p>
							</td>
						</tr>

						<tr>
							<td>
							<b><input type="checkbox" <?php echo $rowi['transpo'];?> disabled> Transportation</b>
							<p style="padding-left: 30px;"><?php echo $rowi['transpoDesc'];?></p>
							</td>
						</tr>

						<tr>
							<td>
							<b> <input type="checkbox" <?php echo $rowi['others'];?> disabled> Others</b>
							<p style="padding-left: 30px;"><?php echo $rowi['othersDesc'];?></p>
							</td>
						</tr>
			    </table>
        	</div>

        	<div style="margin-left: 30%;  height:200%px;"> 

        		<!--Display Appropriation/ Fund to which travel expenses would be charged to.-->

            	<table style=" width:570px;padding-left:10px; padding-top: 10px; border-spacing:20px 5px;">
			      		<caption>
							<b>Appropriation/ Fund to which travel expenses would be charged to:</b>	
						</caption>

						<tr style="text-align:center;">
							<td style="width:100px;">
							<b><input type="checkbox" <?php echo $rowi['generalfund'];?> disabled> General Fund</b>
							</td>
							<td style="width:100px;">
							<b><input type="checkbox" <?php echo $rowi['projectfund'];?> disabled> Project Funds</b>
							</td>
							<td style="width:100px;">
							<b><input type="checkbox" <?php echo $rowi['others1'];?> disabled> Others</b>
							</td>
						</tr>

						<tr style="text-align:center;">
							<td style="border-bottom:1px solid;">
							<p><?php echo $rowi['generalfundDesc'];?></p>
							</td>
							<td style="border-bottom:1px solid;">
							<p><?php echo $rowi['projectfundDesc'];?></p>
							</td>
							<td style="border-bottom:1px solid;">
							<p><?php echo $rowi['others1Desc'];?></p>
							</td>
						</tr>

			    </table>
        	</div>
    	</div>

    	<!-- Display Special Instructions -->
		<table style="padding-top: 10px; padding-bottom: 20px; border-spacing: 0px;">
			<tr>
				<td style="width:300px;">
				<b>Remarks/ Special Instructions:</b>
				</td>

				<td style="width:540px; border-bottom: 1px solid;">
				<p><?php echo $rowi['remarks'];?></p>
				</td>
			</tr>
		</table>

		<div style="width:790px;">
			<p> A report of your travel must be submitted to the Agency Head/ Supervising Official within 7days from 
			completion of travel. Liquidation of cash should be in accordance with Executive Order No. 77: Rules
			and Regulation and New Rates of Allowances for Official Local and Foreign Travels of Government Personnel.
			</p>
		</div>

		<!-- For Approver's Info and Signature -->
		<table style="padding-top: 20px;">
			<tr>
				<td style="width:800px;">
					<b>RECOMMENDING APPROVAL:</b>
				</td>

				<td style="width:500px;">
					<b>APPROVED:</b>
				</td>
			</tr>
			<tr>
				<td style="width:800px; height:150px; padding-bottom:0px;">
					<b></b>
					<p>Head, Technical Operations Division</p>
				</td>

				<td style="width:500px;">
					<b></b>
					<p>Regional Director</p>
				</td>
			</tr>
		</table>

		<hr>

		<table style=" margin-left: auto;  margin-right: auto;">


			<td>

			<p style="text-align: center; color:#0f5387;">DICT Regional IV-A and IV-B</p>
			<p style="text-align: center; color:#0f5387;">DICT Telecom Road, Capitol Site, Kumintang Ibaba, Batangas City 4200</p>
			<p style="text-align: center; color:#0f5387;">Telepphone Number: (043) 773 0275</p>
			</td>
			</tr>
		</table>
		
    </div>
	

	
</body>
</html>