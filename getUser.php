<!DOCTYPE html>
<html>
<head>
</head>
<body>
<?php
require('connect.php');
$q = $_GET['q'];
mysqli_select_db($conn,"myproject");
$sql="SELECT * FROM MyGuests WHERE username = '".$q."'";
$result = mysqli_query($conn,$sql);
while($row = mysqli_fetch_array($result)) {
    echo "<tr>";
	echo "username is ";
    echo  $row['username'] ;
	echo "<br>";
	echo "email is ";
    echo  $row['email'] ;
	echo "<br>";
	$prof_pic = $row['profile_pic'];
	echo "<img src='$prof_pic' width='70' height='70'>";
}
?>
</body>
</html>