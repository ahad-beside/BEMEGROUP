<?php 
	session_start();
	if(empty($_SESSION['id'])):
	header('Location:../index.php');
	endif;
	
	include('../dist/includes/dbcon.php');
	$branch=$_SESSION['branch'];
	$pid = $_POST['pid'];
	$cid = $_POST['cid'];
	$itemNo =$_POST['itemNo'];
	
	$sql="select ebay_sold_id from prod_scheduled where sch_id = '$pid' and branch_id = '".$_SESSION['branch']."'";
	$query2=mysqli_query($con,$sql)or die(mysqli_error($con));
	$row=mysqli_fetch_array($query2);
	if (($row['ebay_sold_id']=='NULL') and ($row['branch_id']='$branch'))
	{
		mysqli_query($con,"update prod_scheduled set ebay_sold_id='$itemNo' where sch_id='$pid'")or die(mysqli_error());
		echo "<script type='text/javascript'>alert('Successfully Updated eBay Sales Item!');</script>";
		echo "<script>document.location='transaction_paypal.php?cid=$cid'</script>";  
	}
	else
	{
		echo "<script type='text/javascript'>alert('eBay Sales ID already Update!');</script>";
		echo "<script>document.location='transaction_paypal.php?cid=$cid'</script>"; 	
	}
	
?>
