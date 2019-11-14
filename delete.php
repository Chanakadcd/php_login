<?php
	session_start(); //starts the session
	if($_SESSION['user']){ //checks if user is logged in
	}
	else{
		header("location:index.php"); // redirects if user is not logged in
	}
	if($_SERVER['REQUEST_METHOD'] == "GET")
	{
		$conn=mysqli_connect("localhost", "root","") or die(mysql_error()); //Connect to server
		mysqli_select_db($conn,"demo") or die("Cannot connect to database"); //Connect to database
		//$conn = mysqli_connect("localhost", "root", "","first_db");
		$id = $_GET['id'];
		$sql=mysqli_query($conn,"DELETE FROM list2 WHERE id='$id'");
		//$sql="DELETE FROM list2 WHERE id='$id'";
		mysqli_query($conn, $sql);
		header("location: home.php");
	}