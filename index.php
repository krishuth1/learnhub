<?php
// Start the session
session_start();

?>
<?php 
	
	require ('connect.php');
	$usey=$_SESSION["username"];
	$sql = "SELECT id, username, email FROM myguests";
	$result = $conn->query($sql);
	if ($result->num_rows > 0) {
    // output data of each row
		while($row = $result->fetch_assoc()) {
		
		if ($usey==$row["username"])
		{
			$username2=$row["username"];
			$email2=$row["email"];
			$id1=$row["id"];
			@$_SESSION["username"]= $username2;
			@$_SESSION["id"]= $id1;
			@$_SESSION["email"]=$email2;
			@$_SESSION["username5"]= $username2;
			@$_SESSION["email5"]=$email2;
		} 
		}
	}
	if(@$_SESSION["username"]){
?>

<?php
	if(@$_GET['action'] == "logout"){
			header("Location: login.php");
			session_destroy();

	}
	
	}else{
		echo "You must be logged in.";
	}
?>
<html>
	<head>
	<title> Home page </title>
	</head>
	<body>
	<?php include ("header.php");
			require ('styling.php');?>
		<center>
		
	<a href = "post.php"><button> Post topic</button></a>
	<br/>
	<br/>
	<?php echo '<table border="1px;">'; ?>
		<tr>
			
			<td width="400px;" style="text-align: center;">
			Name
			</td>
			<td width="80px;" style="text-align: center;">
			Creator
			</td>
			<td width="80px;" style="text-align: center;">
			Date
			</td>
		</tr>
	
	</center>
	</body>
	
</html>
<?php
	$sql = "SELECT * FROM topics1";
	
	$result = $conn->query($sql);
	if ($result->num_rows >0){
		while($row = $result->fetch_assoc()){
			echo "<tr>";
			$id = $row['id'];
			$check_u = "SELECT * FROM myguests WHERE username='".$row['topic_creator']."'";
					$result1=$conn->query($check_u);
					while($row_u = $result1->fetch_assoc()){
						$user_id = $row_u['id'];
					}
			echo "<td><a href='topic.php?id=$id&id2=$user_id'>".$row['topic_name']."</a></td>";
			echo "<td>".$row['topic_creator']."</td>";
			echo "<td>".$row['date']."</td>";
			echo "</tr>";
			
		}
	}else{
		echo "No topics found";
	}
	echo "</table>";
	if(@$_GET['action'] == "logout"){
			
			session_destroy();
			header("Location: login.php");
	}
	
	
?>