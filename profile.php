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
.card {
    /* Add shadows to create the "card" effect */
    box-shadow: 0 4px 8px 0 rgba(0,0,0,0.8);
    transition: 0.3s;
}

/* On mouse-over, add a deeper shadow */
.card:hover {
    box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
}

/* Add some padding inside the card container */
.container {
    padding: 2px 16px;
}
.card {
    box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
    transition: 0.3s;
    border-radius: 5px; /* 5px rounded corners */
}

/* Add rounded corners to the top left and the top right corner of the image */
img {
    border-radius: 5px 5px 0 0;
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
</html>
<?php 
	session_start();
	require ('connect.php');
	require ('styling.php');
	if(@$_SESSION["username"]){
?>
<html>
	<head>
	<title> Home page </title>
	</head>
	
	<body>
	<?php 
	echo "<center>";
	//So essentially GET is used to retrieve remote data, and POST is used to insert/update remote data.
	if(@$_GET['id']){
		$sql = "SELECT * FROM myguests WHERE id='".$_GET['id']."'";
		$result = $conn->query($sql);
		if ($result->num_rows >0){
			while ($row = $result->fetch_assoc()){
					echo"<div class='card'>
						<img src='".$row['profile_pic']."' alt='Avatar' style=width='70' height='70'>
						<div class='container'>
							<h4><b>".$row['username']."</b></h4> 
							<h4><b>".$row['date']."</b></h4>
							<h4><b>".$row['email']."</b></h4>
							
							
					</div>
					</div>";
					//echo "<h1>""</h1><img src='".$row['profile_pic']."' width='50' height='50'><br/>";
					//echo "Date registered: ".$row['date']."<br/>";
					//echo "Email: ".$row["email"];
					//echo "Replies: ".$row['replies']."<br/>";
					//echo "Topics created: ".$row['topics']."<br/>";
					//echo "Score(scr): ".$row['score']."<br/>";
			}
		}else{
			echo "ID not found.";
		}
	}else{
		header("Location: index.php");
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