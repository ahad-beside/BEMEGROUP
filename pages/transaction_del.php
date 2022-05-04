<?php
	
	include("../dist/includes/dbcon.php");
	session_start();
	$branch=$_SESSION['branch'];
	$id = $_REQUEST['id'];
	$cid = $_POST['cid'];
	$pid = $_POST['pid'];
	
	$result=mysqli_query($con,"DELETE FROM temp_trans WHERE temp_trans_id ='$id'")or die(mysqli_error());
	
	mysqli_query($con,"update prod_scheduled set ebay_sold_id='0' where sch_id='$pid' and branch_id='$branch'")or die(mysqli_error());
	echo "<script>document.location='transaction_paypal.php?cid=$cid'</script>";  
	
?>