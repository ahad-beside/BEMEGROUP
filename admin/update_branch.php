<?php
include('dbcon.php');

 if (isset($_POST['update']))
 { 
	 $id = $_POST['branch_id'];
	 $auctiva_name = $_POST['auctiva_name'];
	 $auctiva_mail = $_POST['auctiva_mail'];
	 $paypal_mail = $_POST['paypal_mail'];
	 $skin = $_POST['skin'];
	
	 mysqli_query($con,"UPDATE branch SET auctiva_name='$auctiva_name', auctiva_mail = '$auctiva_mail', paypal_mail = '$paypal_mail', skin = '$skin' where branch_id='$id'")
	 or die(mysqli_error($con)); 

		echo "<script type='text/javascript'>alert('Successfully updated Branch details!');</script>";
		echo "<script>document.location='branch.php'</script>";
	
} 

