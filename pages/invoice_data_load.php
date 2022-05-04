
<div class="box-body">
<table id="example1" class="table table-bordered table-striped">
<thead>
	<tr>
    	<th>Order NO</th>
        <th>Address</th>
        <th>Item(Qty)</th>
		<th>S-Cost(TK)</th>
	</tr>
</thead>
<tbody>

<?php  
 
 include('../dist/includes/dbcon.php'); 
 $output = '';
 
 $query1= "SELECT sum(ship_cost), count(ship_cost) FROM `sales` WHERE invcode = '".$_POST['brand_id']."'";
 $row1 = mysqli_query($con, $query1);
 $row2=mysqli_fetch_array($row1);
 $sum = $row2['sum(ship_cost)'];
 $count = $row2['count(ship_cost)'];

 $query2= "SELECT * FROM `inv_details` natural join handler WHERE inv_details.invcode='".$_POST['brand_id']."'";
 $row3=mysqli_query($con, $query2);
 $row4=mysqli_fetch_array($row3);
 $cost=$row4['inv_Hcost'];
 $name=$row4['hand_first']." ".$row4['hand_mi']." ".$row4['hand_last'];
 
 echo '<b>Shipment to name: </b>'.$name;
 echo '<br/>';
 echo '<b>Total Order: </b>'.$count;
 echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Total S-Cost(TK): </b>'.$sum;
 echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Handling Fee(TK): </b>'.$cost;
 
	  
 if(isset($_POST["brand_id"]))  
 {  
      if($_POST["brand_id"] != '')  
      {  
           //$sql = "SELECT * FROM product WHERE brand_id = '".$_POST["brand_id"]."'";  
		  $sql = "select sales.sales_id, invcode, sales.ship_cost, payment.or_no, payment.item_qty, customer.shipping_address from sales left join payment on sales.sales_id = payment.sales_id left join customer on payment.cust_id = customer.cust_id where sales.invcode = '".$_POST['brand_id']."'";
      }  
      else  
      {  
           $sql = "select sales.sales_id, invcode, sales.ship_cost, payment.or_no, payment.item_qty, customer.shipping_address from sales left join payment on sales.sales_id = payment.sales_id left join customer on payment.cust_id = customer.cust_id where sales.invcode";  
      }  
      $result = mysqli_query($con, $sql);  
      while($row = mysqli_fetch_array($result))  
      {  
	  	   $output .= '<tr>';
           $output .= '<td>'.$row["or_no"].'</td>';  
		   $output .= '<td>'.$row["shipping_address"].'</td>';  
		   $output .= '<td>'.$row["item_qty"].'</td>';
		   $output .= '<td>'.$row["ship_cost"].'</td>';
   	  	   $output .= '</tr>';
	  }
	  
	  echo $output;

 }  

?> 

</tbody>
</table>
</div>