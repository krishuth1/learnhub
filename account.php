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
  <li><a class="active" href="account.php">My Account</a></li>
  <li><a  href="members.php">Members</a></li>
  <li><a href="group.php">My group</a></li>
  <li><a href="createGroup.php">Create group</a></li>
   <li><a href="notifications.php">My Notifications</a></li>
<li style="float:right"> <a href="index.php?action=logout">Logout</a></li>
</ul>

</body>
</html>
<?php 
	session_start();
	require ('connect.php');
	if(@$_SESSION["username"]){
?>
<html>
	<head>
	<title> Home page </title>
	</head>
	<?php ?>
	<body>
	<center>
	<?php
	
	$sql = "SELECT * FROM myguests WHERE username='$_SESSION[username]' ";
	$result = $conn->query($sql);
	if($result->num_rows >0){
	while($row = $result->fetch_assoc()){
		$username = $row['username'];
		$id = $row['id'];
		$email = $row['email'];
		$date = $row['date'];
		$prof_pic = $row['profile_pic'];
	}
	}
	
	?>
	<?php echo "<img src='$prof_pic' width='70' height='70'>";?> <br/>
	Username: <?php echo $username; ?> <br/>
	ID:<?php echo $id; ?><br/>
	Email:<?php echo $email; ?><br/>
	Date registered:<?php echo $date; ?><br/>

	<a href='account.php?action=cp'> Change password </a><br/>
	<a href='account.php?action=ci'> Change profie pic </a>
	</center>
	</body>
	
</html>
<?php
	if(@$_GET['action'] == "logout"){
			
			session_destroy();
			header("Location: login.php");
	}
	
	if(@$_GET['action'] == "ci") {
		echo '<form action="account.php?action=ci" method="POST" enctype="multipart/form-data"><center>
		<br/>
		Available file extension: <b>.PNG .JPG .JPEG</b><br/> <br/>
		<input type="file" name="image"><br/>
		<input type="submit" name="change_pic" value="Change"><br/>
		';
		if (isset($_POST['change_pic'])){
			$errors = array();
			$allowed_e = array('png', 'jpg', 'jpeg' );
			$file_name = $_FILES['image'] ['name'];
			$file_e = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
			$file_s = $_FILES['image']['size'];
			$file_temp = $_FILES['image']['tmp_name'];
			
			if(in_array($file_e, $allowed_e)== false){
				$errors[] = 'This file extension is not allowed.';
			}
			if ($file_s >2097152){
				$errors[] = 'File must be under 2mb';
			}
			if(empty($errors)){
				move_uploaded_file($file_temp, 'images/'.$file_name);
				$image_up = 'images/'.$file_name;
				$sql = "UPDATE myguests SET profile_pic='".$image_up."' WHERE username='".$_SESSION['username']."'";
				if ($conn->query($sql) === TRUE){
					echo "Your profile pic has been changed";
				}
				
			}else{
				foreach($errors as $error) {
					echo $error, '<br/>';
				}
			}
		}
		echo '</form></center>';
	}

	
	}else{
		echo "You must be logged in.";
	}
?>