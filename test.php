<?php
session_start();
?>
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
  <li><a href="members.php">Members</a></li>
  <li><a  href="group.php">My group</a></li>
  <li><a class="active" href="createGroup.php">Create group</a></li>
   <li><a href="notifications.php">My Notifications</a></li>
<li style="float:right"> <a href="index.php?action=logout">Logout</a></li>
</ul>

</body>
</html>
<!DOCTYPE html>
<html>
<head>
<style> 
input[type=text],select{
    width: 100%;
    padding: 12px 20px;
    margin: 8px 0;
    box-sizing: border-box;
    border: none;
    background-color: #FFFACD;
    color: black;
}

input[type=text1]{
    width: 100%;
	height: 125px;
    padding: 12px 20px;
    margin: 8px 0;
    box-sizing: border-box;
    border: none;
    background-color: #FFFACD;
    color: black;
	 overflow: auto;
}
input[type=submit] {
    width: 100%;
    background-color: #4CAF50;
    color: white;
    padding: 14px 20px;
    margin: 8px 0;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}
</style>
</head>
<body>
<form action="test.php" method="POST">
  <label for="groupName">Group Name</label>
  <input  type="text" name="groupName" >
  <label for="groupGenre">Group Genre</label>
	 <select id="country" name="groupGenre">
      <option value="Education">Education</option>
      <option value="canada">Sports</option>
      <option value="usa">Entertainment</option>
	  <option value="misc">Others</option>
    </select>
  <label for="groupInfo">Group Information</label>
  <input  type="text1"  name="groupInfo" >

  <input type="submit" value="Submit">
</form>

</body>
</html>


<?php
require_once("connect.php");
$groupName = @$_POST['groupName'];
$flag=0;
$_SESSION["groupName"] = $groupName;


if ($groupName)
{
			
			$abc="CREATE TABLE `".$groupName."` ( username VARCHAR(30), email VARCHAR(30) )";
			if ($conn->query($abc) === TRUE) {
				$flag=1;
			}
			else {
				echo "Error creating table: " . $conn->error;
					}
}
				
			if ($flag==1)
			{
				header("Location:addByUsername.php");
			}
// if clicked 
					?>