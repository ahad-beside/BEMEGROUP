<?php session_start();
if(empty($_SESSION['id'])):
header('Location:../index.php');
endif;

include('../dist/includes/dbcon.php');
	$hid = $_POST['hid'];
	$status =$_POST['status'];
	
	
	mysqli_query($con,"update handler set hand_status='$status' where hand_id='$hid'")or die(mysqli_error());
	
	echo "<script type='text/javascript'>alert('Successfully updated application status!');</script>";
	echo "<script>document.location='application.php'</script>";  

	
?>
