<?php
session_start();
require ('styling.php');
?>
<html>
<head>
<p id="demo"></p>
<script>
function showUser(str) {

  if (str=="") {

    document.getElementById("txtHint").innerHTML="";
    return;
  } 
  if (window.XMLHttpRequest) {
	 
   // code for IE7+, Firefox, Chrome, Opera, Safari
    xmlhttp=new XMLHttpRequest();
  } else { // code for IE6, IE5
    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	
  }
  xmlhttp.onreadystatechange=function() {

    if (this.readyState==4 && this.status==200) {
      document.getElementById("txtHint").innerHTML=this.responseText;
    }
  }
  xmlhttp.open("GET","getuser.php?q="+str,true);
  xmlhttp.send();
}
</script>
</head>
<body>

		<form action="addByUsername.php" method="POST" >		
		user name :<input type="text" value="Hello" name="username1" onchange="showUser(this.value)">
		</form>
				<div id="txtHint"><b>Person info will be listed here.</b></div>
	</body>
</html>

<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "myproject";
$conn = new mysqli($servername, $username, $password, $dbname);
$session_username= $_SESSION["username"];

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$name1=@$_POST['username1'];
if ($name1)
{
$sql = "SELECT id, username, email FROM myguests";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
		
		if ($name1==$row["username"])
		{
	
			$message=$session_username. " <a href=aaa.php>click here</a> to join the group ".$_SESSION['groupName']. " on  ". date("h:i")." ". date("Y-m-d");
			$username2=$row["username"];
			$email2=$row["email"];
			$id1=$row["id"];
			$abc="INSERT INTO notifications4 (message ,not_id, not_type,groupName)
					VALUES('$message','$id1',1,'$_SESSION[groupName] ') ";
			
			if ($conn->query($abc) === TRUE) {
				echo "notification sent";
						}
			else {
				echo "Error: " . $sql . "<br>" . $conn->error;
				}
			
			//they have to accept it
		// $sql = "INSERT INTO $_SESSION[groupName] (username,email)
		//VALUES ('$username2', '$email2')";

		//if ($conn->query($sql) === TRUE) {
				
		//} else {
			//	echo "Error: " . $sql . "<br>" . $conn->error;
//}
		
					}
    }
} else {
    echo "0 results";
}
}
else
{

}
?>
