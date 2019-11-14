<?php
	session_start();
	if($_SESSION['user']){
	}
	else{
		header("location:index.php");
	}
	if($_SERVER['REQUEST_METHOD'] == "POST")//Added an if to keep the page secured
	{
		$conn =mysqli_connect("localhost", "root","") or die(mysqli_error()); //Connect to server
		mysqli_select_db($conn,"demo") or die("Cannot connect to database"); //Connect to databas
		
		$details = mysqli_real_escape_string($conn,$_REQUEST['details']);
		$time = strftime("%X");//time
		$date = strftime("%B %d, %Y");//date
		$decision ="no";
		 var_dump($details);
		foreach($_POST['public'] as $each_check) //gets the data from the checkbox
 	{
 			if($each_check !=null ){ //checks if the checkbox is checked
 				$decision = "yes"; //sets teh value
 			}
 		}
		
		$sql="INSERT INTO list2 (details, date_posted, time_posted, public) VALUES ('$details','$date','$time','$decision')";
		
		mysqli_query($conn, $sql);
		
		
		header("location: home.php");
	}
	else
	{
		//var_dump($_POST);
		header("location: home.php"); //redirects back to hom
	}
	
?> 