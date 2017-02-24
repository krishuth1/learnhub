<!DOCTYPE html>
<html>
<head>
<style>
ul {
    list-style-type: none;
    margin: 0;
    padding: 0;
    overflow: hidden;
    background-color: #333;
}

li {
    float: left;
}

li a {
    display: block;
    color: white;
    text-align: center;
    padding: 14px 16px;
    text-decoration: none;
}

li a:hover:not(.active) {
    background-color: #111;
}

.active {
    background-color: #4CAF50;
}
</style>
</head>
<body>

<ul>
  <li><a  href="index.php">Home</a></li>
  <li><a href="account.php">My Account</a></li>
  <li><a class="active" href="members.php">Members</a></li>
  <li><a href="group.php">My group</a></li>
  <li><a href="createGroup.php">Create group</a></li>
   <li><a href="notifications.php">My Notifications</a></li>
<li style="float:right"> <a href="index.php?action=logout">Logout</a></li>
</ul>

</body>
</html><?php 
	session_start();
	require ('connect.php');
	if(@$_SESSION["username"]){
?>
<html>
	<head>
	<title> Home page </title>
	</head>
	
	<body>
	<?php
	echo "<center><h1>Members</h1>";
	$sql = "SELECT * FROM myguests";
	$result = $conn->query($sql);
	while($row = $result->fetch_assoc()){
		$id = $row['id'];
		echo "<a href='profile.php?id=$id'>".$row['username']."</a><br/>";
	}
	echo "</center>";
	?>
	
	</body>
	
</html>
<?php
	if(@$_GET['action'] == "logout"){
			
		
			session_destroy();
			header("Location: login.php");
	}
	
	}else{
		echo "You must be logged in.";
	}
?>