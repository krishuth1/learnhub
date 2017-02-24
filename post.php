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
	<?php include ("header.php");
			
	?>
	<form action="post.php" method="POST">
	<center>
		Topic name: <br/><input type="text" name="topic_name" style="width:400px;"><br/>
		<br/> 
		Content:<br/>
		<textarea style="resize: none; width:400px; height:300px;" name="con"></textarea>
		<br/>
		<input type="submit" name="submit" value="Post" style="width:400px;">
	</center>
	<body>
	
	</body>
	
</html>
<?php
	$t_name = @$_POST['topic_name'];
	$content = @$_POST['con'];
	$date = date("y-m-d"); 
	
	if(isset($_POST['submit'])){
		if($t_name && $content){
			if(strlen($t_name) >=10 && strlen($t_name) <=70){
				$sql="INSERT INTO topics1(`topic_name`,`topic_content`,`topic_creator`,`date`) 
					VALUES ('$t_name','$content','$_SESSION[username]','$date')";
				if($conn->query($sql)===TRUE){
				}else{
					echo "Failure";
				}
			}else{
				echo "Topic name must be between 10 and 70 characters long.";
			}
		}else{
			echo "Please fill in all the fields.";
		}
	}
	
	}else{
		echo "You must be logged in.";
	}
?>