<?php 
	session_start();
	if(empty($_SESSION['id'])):
	header('Location:../index.php');
	endif;
	include('../dist/includes/dbcon.php');

	$branch = $_SESSION['branch'];
	$sid = $_POST['sid'];
	$sdate = $_POST['sdate'];
	$cost = $_POST['cost'];
	
	$inv="INV";
	$idate=($inv."".$sdate);
	
	$query2=mysqli_query($con,"select * from sales where sales_id = $sid and branch_id = '".$_SESSION['branch']."' ")or die(mysqli_error($con));
	$row=mysqli_fetch_array($query2);
	if (($row['ship_cost']=='0.00') and ($row['invcode']=='NULL'))
	{
		
		$pic = $_FILES["image"]["name"];
			if ($pic==""){	
				if ($_POST['image1']<>""){
					$pic=$_POST['image1'];
				}
				else{
					$pic="default.gif";
				}
			}
			else{
				$pic = $_FILES["image"]["name"];
				$type = $_FILES["image"]["type"];
				$size = $_FILES["image"]["size"];
				$temp = $_FILES["image"]["tmp_name"];
				$error = $_FILES["image"]["error"];
	
				if ($error > 0){
					die("Error uploading file! Code $error.");
				}
				else{
					if($size > 100000000000) //conditions for the file
					{
						die("Format is not allowed or file size is too big!");
					}
					else{
						move_uploaded_file($temp, "../dist/uploads/".$pic);
					}	
				}
				
				}
		
		mysqli_query($con,"update sales set ship_file='$pic', invcode='$idate', ship_cost='$cost' where sales_id='$sid'")or die(mysqli_error());
		mysqli_query($con,"update sales_details set invcode ='$idate' where sales_id='$sid'")or die(mysqli_error());
		
		echo "<script type='text/javascript'>alert('Successfully updated Shipment details!');</script>";
		echo "<script>document.location='ship.php'</script>";  
	}
	else
	{
		echo "<script type='text/javascript'>alert('Shipment already Update!');</script>";
		echo "<script>document.location='ship.php'</script>"; 		
	}

?>
