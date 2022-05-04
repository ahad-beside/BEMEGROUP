<?php 
	session_start();
	$id=$_SESSION['id'];
	$branch=$_SESSION['branch'];
	
	include('../dist/includes/dbcon.php');

	$cid = $_POST['cid'];
	$pid = $_POST['prod_id'];
	//$qty = $_POST['qty'];
	
	$query=mysqli_query($con,"select prod_price,sch_id,cat_id from prod_scheduled where sch_id='$pid'")or die(mysqli_error());
	$row=mysqli_fetch_array($query);
	$price=$row['prod_price'];
	$cat_id=$row['cat_id'];
		
	$query1=mysqli_query($con,"select * from temp_trans where sch_id='$pid' and branch_id='$branch'")or die(mysqli_error());
	$count=mysqli_num_rows($query1);
		
	//$total=$price*$qty;
	if ($count>0){
		//mysqli_query($con,"update temp_trans set qty=qty+'$qty',price=price+'$total' where sch_id='$pid' and branch_id='$branch'")or die(mysqli_error());
	}
	else{
		mysqli_query($con,"INSERT INTO temp_trans(sch_id,cat_id,price,qty,branch_id) VALUES('$pid','$cat_id','$price','1','$branch')")or die(mysqli_error($con));
		mysqli_query($con,"update prod_scheduled set ebay_sold_id='NULL' where sch_id='$pid' and branch_id='$branch'")or die(mysqli_error());
	}
	
	$_SESSION['pid']=$pid;
	echo "<script>document.location='transaction_paypal.php?cid=$cid'</script>";  
?>