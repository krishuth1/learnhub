<!DOCTYPE html>
<html>
<head>
<style>
body {
    background-color: #FFFACD;
}
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
  <li><a href="index.php">Home</a></li>
  <li><a href="account.php">My Account</a></li>
  <li><a href="members.php">Members</a></li>
  <li><a href="group.php">My group</a></li>
  <li><a href="createGroup.php">Create group</a></li>
   <li><a  class="active" href="notifications.php">My Notifications</a></li>
<li style="float:right"> <a href="index.php?action=logout">Logout</a></li>
</ul>

</body>
</html>

<?php
// Start the session
session_start();
?>
<?php
require ('styling.php');
//notification table
//divide into types of notification
require('connect.php');
$sql = "SELECT not_id, not_type, message,groupName FROM notifications4 ORDER BY id DESC";
$result = $conn->query($sql);
$my_id=@$_SESSION["id"];
if($result->num_rows >0){
			while($row = $result->fetch_assoc()){
				$db_id = $row['not_id'];
				$db_message= $row['message'];
				@$_SESSION["groupName1"]=$row['groupName'];
				if($my_id==$db_id)
				{
					echo "<h3>$db_message</h3>";
				}
				
			}
}
?>
</body>
</html>