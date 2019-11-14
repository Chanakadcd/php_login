<html>
	<head>
		<title>My first PHP website</title>
	</head>
	<?php
	session_start(); //starts the session
	if($_SESSION['user']){ //checks if user is logged in
	}
	else{
		header("location:index.php"); // redirects if user is not logged in
	}
	$user = $_SESSION['user']; //assigns user value
	$id_exists = false;
	?>
	<body>
		<h2>Home Page</h2>
		<p>Hello <?php Print "$user"?>!</p> <!--Displays user's name-->
		<a href="logout.php">Click here to logout</a><br/><br/>
		<a href="home.php">Return to Home page</a>
		<h2 align="center">Currently Selected</h2>
		<table border="1px" width="100%">
			<tr>
				<th>Id</th>
				<th>Details</th>
				<th>Post Time</th>
				<th>Edit Time</th>
				<th>Public Post</th>
			</tr>
			<?php
				if(!empty($_GET['id']))
				{
					$id = $_GET['id'];
					$_SESSION['id'] = $id;
					$id_exists = true;
					$conn=mysqli_connect("localhost", "root","") or die(mysqli_error()); //Connect to server
					mysqli_select_db($conn,"demo") or die("Cannot connect to database"); //connect to database
					$query = mysqli_query($conn,"Select * from list2 Where id='$id'"); // SQL Query
					$count = mysqli_num_rows($query);
					
				    //$sql="Select * from list2 Where id='$id'";
				   // $query =mysqli_query($conn, $sql);
					//$count = mysqli_num_rows($query);
					//var_dump( $sql);
					if($count > 0)
						
					{
						while($row = mysqli_fetch_array($query))
						while($row = mysqli_fetch_array($query))
							
						{
							Print "<tr>";
								Print '<td align="center">'. $row['id'] . "</td>";
								Print '<td align="center">'. $row['details'] . "</td>";
								Print '<td align="center">'. $row['date_posted']. " - ". $row['time_posted']."</td>";
								Print '<td align="center">'. $row['date_edited']. " - ". $row['time_edited']. "</td>";
								Print '<td align="center">'. $row['public']. "</td>";
								var_dump( $row);
							Print "</tr>";
						}
					}
					else
					{
						$id_exists = false;
					}
				}
			?>
		</table>
		<br/>
		<?php
		if($id_exists)
		{
		Print '
		<form action="edit.php" method="POST">
			Enter new detail: <input type="text" name="details"/><br/>
			public post? <input type="checkbox" name="public[]" value="yes"/><br/>
			<input type="submit" value="Update List"/>
		</form>
		';
		}
		else
		{
			Print '<h2 align="center">There is no data to be edited.</h2>';
		}
		?>
	</body>
</html>
<?php
	if($_SERVER['REQUEST_METHOD'] == "POST")
	{
		$conn=mysqli_connect("localhost", "root","") or die(mysql_error()); //Connect to server
		mysqli_select_db($conn,"demo") or die("Cannot connect to database"); //Connect to database
		$details = mysqli_real_escape_string($conn,$_POST['details']);
		//$conn = mysqli_connect("localhost", "root", "","first_db");
		$details = mysqli_real_escape_string($conn,$_POST['details']);
		$public = "no";
		$id = $_SESSION['id'];
		$time = strftime("%X");//time
		$date = strftime("%B %d, %Y");//date
		foreach($_POST['public'] as $list)
		{
			if($list != null)
			{
				$public = "yes";
			}
		}
		
		$sql="UPDATE list2 SET details='$details', public='$public', date_edited='$date', time_edited='$time' WHERE id='$id'";
		mysqli_query($conn, $sql);
		header("location: home.php");
	}
?>