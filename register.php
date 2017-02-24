<html>
<head><title> Register an account </title></head>
<body>
	<script>
		function validateForm() {
			var x = document.forms["myForm"]["username"].value;
			if (x == "") {
			alert("User name must be filled out");
			return false;
			}
			}
	</script>
	<form name= "myForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" onsubmit="return validateForm()">
		Username:<input type="text" name="username" required>
		<br/>Password: <input type="password" name="password" required>
		<br/>Confirm password:<input type="password" name="repassword" required>
		<br/>Email:<input type="email" name="email"required>
		<br/><input type="submit" name="submit" value="submit"> or <a href="login.php">Login</a>
	</form>
</body>
<?php
require('connect.php');
$username = @$_POST['username'];
$password = @$_POST['password'];
$repass = @$_POST['repassword'];
$email = @$_POST['email'];
$date = date ("Y-m-d");
$pass_en = sha1($password);//hides the password
//$nonce = md5('registration-' . $username . NONCE_SALT);
if(isset($_POST['submit'])){
	if($username && $password && $repass && $email) {
		if(strlen($username)>=5 && strlen($username) <25 && strlen($password)>6){
			if($repass == $password) {
				$sql = "INSERT INTO MyGuests (username,password, email, date)
						
							
							VALUES ('$username','$password','$email','$date')";

				if ($conn->query($sql) === TRUE) {
				echo "New record created successfully Click <a href='login.php'>here</a> to login";
							} else {
							echo "Error: " . $sql . "<br>" . $conn->error;
														}
				}
				else{
				echo "Passwords do not match.";
			}
	   }else{
			if(strlen($username)<5 || strlen($username)>25){
				echo "Username must be between 5 and 25 characters.";
			}
			if(strlen($password)<6){
				echo "Password must be longer than 6 characters";
			}
		}
	} else {
		echo "Please fill in all the fields.";
	}
}
?>
</html>