<html>
<head><title>Login with your account</title> </head>
<body>
	<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
		Username:<input type="text" name="username"><br/>
		Password:<input type="password" name="password"><br/>
		<input type="submit" value="Login" name="submit">
	</form>
</body>
</html>
<?php
session_start();
require ('connect.php');
$username = @$_POST['username'];
$password = @$_POST['password'];
if(isset($_POST['submit'])){
	if($username && $password){
		$check1 = $conn->query("SELECT * FROM myguests WHERE username='".$username."'");
		
		if($check1->num_rows >0){
			while($row = $check1->fetch_assoc()){
				$db_username = $row['username'];
				$db_password = $row['password'];
				$email=$row['email'];
				$_SESSION['id'] = $row['id'];
			}
			if($username == $db_username && $password == $db_password){
				@$_SESSION["username"] = $username;
				@$_SESSION["email"]=$email;
				
					
				
				header("Location:index.php");
			}else{
				echo "Your password is wrong";
			}
		}else{
			die("Couldn't find the username");
		}
	}else{
		echo "Please fill in all fields";
	}
}
?>