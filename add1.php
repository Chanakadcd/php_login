<?php
	
	$conn=mysqli_connect("localhost", "root","") or die(mysql_error()); //Connect to server
		mysqli_select_db($conn,"demo") or die("Cannot connect to database"); //Connect to database
	if(isset($_POST['Addtolist'])){
	
		$details = $_POST['details'];
		$time = strftime("%X");//time
		$date = strftime("%B %d, %Y");//date
		$decision ="yes";
		
		echo $time ,$date ;
		//$password = mysqli_real_escape_string($link, $_REQUEST['password']);
		//$sql="INSERT INTO list2 (details, date_posted, time_posted,date_edited,time_edite, public) VALUES ('$details','$date','$time','','','$decision')";
		
		//if(mysqli_query($conn, $sql)){
			
		//	header("location: home.php");
		///} else
		//{
          //   header("register.php"); 
		//}
 
 
}
// Close connection
//mysqli_close($conn);
?>