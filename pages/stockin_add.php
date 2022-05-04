<?php 
	session_start();
	include('../dist/includes/dbcon.php');
	
	$branch=$_SESSION['branch'];
	$prodid = $_GET['parent_cat'];
	$supid = $_GET['supid'];
	$serial = $_GET['serial'];
	$tweight = $_GET['tweight'];
	$tprice = $_GET['tprice'];
	$qty = $_GET['sub_cat'];
	
	include('../dist/includes/asia_dhaka.php');
	$date = date("Y-m-d H:i:s");
	$id=$_SESSION['id'];
	
	$query=mysqli_query($con,"select cat_name,cat_id from stockin natural join category where prod_id='$prodid'")or die(mysqli_error());
    $row=mysqli_fetch_array($query);
	$catid=$row['cat_id'];
	$cname=$row['cat_name'];
	$remarks="added $qty of $cname";  
	
	mysqli_query($con,"INSERT INTO history_log(user_id,action,date) VALUES('$id','$remarks','$date')")or die(mysqli_error($con));
	mysqli_query($con,"UPDATE stockin SET prod_qty=prod_qty+'$qty' where prod_id='$prodid' and branch_id='$branch'") or die(mysqli_error($con)); 
	mysqli_query($con,"INSERT INTO stockin_details(cat_id,supplier_id,qty,weight,price,date,branch_id,serial) VALUES('$catid','$supid','$qty','$tweight','$tprice','$date','$branch','$serial')")or die(mysqli_error($con));

	echo "<script type='text/javascript'>alert('Successfully added new stocks!');</script>";
	echo "<script>document.location='stockin.php'</script>";  
?>