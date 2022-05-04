<?php
       $servername = "localhost";
       $database = "mayagrou_bemegroup";
       $username = "mayagrou_admin";
       $password = "11111111112018";

	$con = mysqli_connect($servername, $username, $password, $database);
	// Check connection
	if (mysqli_connect_errno())
  	{
  		echo "Failed to connect to MySQL: " . mysqli_connect_error();
  	}
?>