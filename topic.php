<?php 
	session_start();
	require ('connect.php');
	require ('comment.php');
	
	if(@$_SESSION["username"]){
?>
<html>
	<head>
	<title> post </title>
	<link rel="stylesheet" href="style1.css">
	</head>
	<?php include ("header.php");
	require ('styling.php');
	?>
	
	<center>
		
	<a href = "post.php"><button> Post topic</button></a>
	<br/>
	<br/>
	<?php
		if($_GET["id"]){
			$ram=$_GET["id"];
			$sql = "SELECT * FROM topics1 WHERE id='".$ram."'";          
			$result= $conn->query($sql);
			if($result->num_rows >0){
				while ($row = $result->fetch_assoc()){
					$check_u = "SELECT * FROM myguests WHERE username='".$row['topic_creator']."'";
					$result=$conn->query($check_u);
					while($row_u = $result->fetch_assoc()){
						$user_id = $row_u['id'];
					}
					echo "<h1>".$row['topic_name']."</h1>";
					echo "<h5>By<a href='profile.php?id=$user_id'>".$row['topic_creator']."</a><br/>Date:".$row['date']."</h5>";
					echo "<br/>".$row['topic_content'];
				}
			}else{
				echo "Topic not found.";
			}
		}else{
				header("Location: index.php");
		}
		
	?>
	<body>
	
	
	<?php
		
			$check_uu = "SELECT * FROM myguests WHERE username='".$_SESSION["username"]."'";
			$result=$conn->query($check_uu);
			while($row_uu = $result->fetch_assoc()){
				$user_idd = $row_uu['id'];
			}
		echo '<br><br><form method="POST" action="'.setcomments($conn).'">
		<input type="hidden" name="uid" value=$user_idd>
		<textarea name="message"></textarea>
		<br>
		<button type="submit" onclick="myFunction()" name="commentSubmit">ADD A COMMENT</button>
		</form>
		<div id="snackbar">You commented on a post</div>

<script>
function myFunction() {
    var x = document.getElementById("snackbar");
    x.className = "show";
    setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);
}
</script>
</body>
	
</html>	 
";   
		
	?>
	<?php getcomments($conn);?>
	
	

<?php
		
	}else{
		echo "You must be logged in.";
	}
?>