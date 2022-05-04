<?php 
	
	session_start();
	if(empty($_SESSION['id'])):
	header('Location:../index.php');
	endif;
	
	include('../dist/includes/dbcon.php');
	$branch=$_SESSION['branch'];
	$pid = $_POST['pid'];
	$itemNo =$_POST['itemNo'];
			
	mysqli_query($con,"update prod_scheduled set ebay_sold_id='$itemNo' where sch_id='$pid'")or die(mysqli_error());
	echo "<script type='text/javascript'>alert('Successfully updated eBay Sales Item!');</script>";
	echo "<script>document.location='scheduled.php'</script>";  

?>
