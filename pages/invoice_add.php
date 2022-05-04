<?php 
	session_start();
	include('../dist/includes/dbcon.php');
	
	$branch=$_SESSION['branch'];
	$invno = $_POST['brand'];
	$cost = $_POST['cost'];
	$hname = $_POST['hname'];
		
	$str = "$invno";
	$inv_str= explode("-",$str);
	$y_code = $inv_str[0];
	$m1_code = $inv_str[1]; $m_code = "-"."$m1_code"."-";
	$d1_code = $inv_str[2]; $d_code = "$d1_code"."-";
	$i_code = $inv_str[3];
	
	include('../dist/includes/asia_dhaka.php');
	$date = date("Y-m-d H:i:s");
	
	$sql="select * from  inv_details where invcode = '$invno' and branch_id = '".$_SESSION['branch']."'";
	$query2=mysqli_query($con,$sql)or die(mysqli_error($con));
	$row=mysqli_fetch_array($query2);
			
	if ($row['inv_Hcost']>'0.00')
	{
	
	echo "<script type='text/javascript'>alert('Invoice already Update!');</script>";
	echo "<script>document.location='invoice.php'</script>";
	  
	}
	else
	{
		
		mysqli_query($con,"INSERT INTO invoicecode(inv_year, inv_month, inv_day, inv_incre) values('$y_code', '$m_code', '$d_code', '$i_code')") or die(mysql_error($con));
	
	$query= "SELECT sum(ship_cost), count(ship_cost) FROM `sales` WHERE invcode = '$invno'";
 	$row1 = mysqli_query($con, $query);
	$row2=mysqli_fetch_array($row1);
	$sum = $row2['sum(ship_cost)'];
	$count = $row2['count(ship_cost)'];
 
	mysqli_query($con,"INSERT INTO inv_details(invcode, hand_id, total_order, inv_Hcost, inv_Tship_cost, date, branch_id) values ('$invno', '$hname', '$count', '$cost', '$sum', '$date', '$branch')") or die (mysqli_error($con));
	echo "<script type='text/javascript'>alert('Successfully added shipment cost!');</script>";
	echo "<script>document.location='invoice.php'</script>";
		
	}
?>