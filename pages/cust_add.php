<?php 
	session_start();
	include('../dist/includes/dbcon.php');
	$branch=$_SESSION['branch'];
	$buyer_name = $_POST['buyer_name'];
	$ebay_name = $_POST['ebay_name'];
	$paypal_name = $_POST['paypal_name'];
	$cust_contact = $_POST['cust_contact'];
	$ship_address = $_POST['ship_address'];
	$ship_country = $_POST['ship_country'];
	
	$timezone = "Asia/Dhaka";
	if(function_exists('date_default_timezone_set')) date_default_timezone_set($timezone);
	$current_date = date("Y-m-d H:i:s");
			
	$query2=mysqli_query($con,"select * from customer where cust_ebay_name='$ebay_name' and cust_paypal_name='$paypal_name' and branch_id='$branch'")or die(mysqli_error($con));
	$count=mysqli_num_rows($query2);
	if ($count>0)
	{
		echo "<script type='text/javascript'>alert('Customer already exist!');</script>";
		echo "<script>document.location='cust_new.php'</script>";  
	}
	else
	{	
		mysqli_query($con,"INSERT INTO customer(cust_name,cust_ebay_name,cust_paypal_name,cust_contact,shipping_address,shipping_country,cust_pic,branch_id,date) 
		VALUES('$buyer_name','$ebay_name','$paypal_name','$cust_contact','$ship_address','$ship_country','default.gif','$branch','$current_date')")or die(mysqli_error($con));
		
		$cust_id=mysqli_insert_id($con);
		$cid=$cust_id;
		echo "<script type='text/javascript'>alert('Successfully added new customer!');</script>";
		echo "<script>document.location='transaction_paypal.php?cid=$cid'</script>";  
	}

?>