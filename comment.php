<?php
$jad=0;
FUNCTION setcomments($conn)
{  
  if(isset($_POST['commentSubmit']))
  {
	$id1=$_GET['id2'];
	
	$uid=$_POST['uid'];
	$post_id=$_GET['id'];
    $message=$_POST['message'];
    
	$sqld="INSERT INTO chat1(uid,message,replyid) VALUES('$uid','$message','$post_id')";
	$result=$conn->query($sqld);
			$message= "  commented on your post on  ". date("h:i")." ". date("Y-m-d");

			$abc="INSERT INTO notifications4 (message ,not_id, not_type,groupName)
					VALUES('$message','$id1',2,'') ";
			
			if ($conn->query($abc) === TRUE) {
				echo "notification sent";
						}
//}
}

}
FUNCTION getcomments($conn)
{
	$post_id=$_GET['id'];
	$sql="SELECT * FROM chat1 WHERE replyid='$post_id'";
	$result=$conn->query($sql) or die($conn->error);
	
	while($row = $result->fetch_assoc()){
		
			$iod=$row['uid'];
			   $sql1="SELECT * FROM myguests WHERE id='$iod'";
			   $result1=$conn->query($sql1) or die ($conn->error);
			   if($rowl=$result1->fetch_assoc())
			   {
				   
			   echo  "<img src='$rowl[profile_pic]' width='50' height='50'>";
			   echo $rowl['username']."<br>";
			   echo nl2br($row['message'])."<br>";
			  
			   }
	   if(isset($_SESSION['id']))
	   {  
         if($_SESSION['id']==$rowl['id'])
		 { 
	     echo "<form class='delete-button' method='POST' action='".deletecomments($connect)."'>
		<input type='hidden' name='cid' value='".$row['cid']."'>
		<button  name='commentDelete'>Delete</button>
		</form><form class='edit-button' method='POST' action='editcomment.php'>
		<input type='hidden' name='cid' value='".$row['cid']."'>
		<input type='hidden' name='uid' value='".$row['uid']."'>
		<input type='hidden' name='message' value='".$row['message']."'>
		<button>Edit</button>
		</form>";
		}
		else{
		   echo "<form class='edit-button' method='POST' action='replycomment.php'>
		         <input type='hidden' name='cid' value='".$row['cid']."'>
				 <input type='hidden' name='uid' value='".$_SESSION['id']."'>
                 <button>Reply</button>
		      </form>";
	        }
	   }
		
	   
	}
}
FUNCTION editcomments($conn)
{
  if(isset($_POST['commentSubmit']))
  { $cid=$_POST['cid'];
    $uid=$_POST['uid'];
    $message=$_POST['message'];
	echo $cid;
    $sqlda="UPDATE chat1 SET message='$message' WHERE replyid='$cid'" ;
	$result=$conn->query($sqlda) or die($conn->error);
	if($result===TRUE)
	{
		echo "Datas edited";
	}
	
	$sql = "SELECT * FROM topics1";
				$result = $conn->query($sql);
		if ($result->num_rows >0){
		
				while($row = $result->fetch_assoc()){

						$check_u = "SELECT * FROM myguests WHERE username='".$row['topic_creator']."'";
						$result1=$conn->query($check_u);
						while($row_u = $result1->fetch_assoc()){
							$user_id = $row_u['id'];
					}
				}
		}
		$id=$_GET['id'];
		
	header("Location:topic.php?id=$id&id2=$user_id");
  }
}
FUNCTION  deletecomments($conn)
{
  if(isset($_POST['commentDelete']))
  { $cid=$_POST['cid'];
    $sqlda="DELETE FROM chat1 WHERE replyid='$cid'" ;
	$result=$conn->query($sqlda);
	 if($result===TRUE)
	{
		echo "Datas deleted";
	}
	$sql = "SELECT * FROM topics1";
				$result = $conn->query($sql);
		if ($result->num_rows >0){
		
				while($row = $result->fetch_assoc()){

						$check_u = "SELECT * FROM myguests WHERE username='".$row['topic_creator']."'";
						$result1=$conn->query($check_u);
						while($row_u = $result1->fetch_assoc()){
							$user_id = $row_u['id'];
					}
				}
		}
		$ide=$_GET['id'];
		
	header("Location:topic.php?id=$ide&id2=$user_id");
	
  }
}
FUNCTION setreply($conn)
{  
  if(isset($_POST['commentReply']))
  { 
    $uid=$_POST['uid'];
    $message=$_POST['message'];
	$reply_id=$_POST['cid'];
	$GLOBALS['jad']=$reply_id;
	$sqld=$conn->query("INSERT INTO chat1(uid,message,replyid) VALUES('$uid','$message','$reply_id')");
	$_SESSION['cid']=$uid;
    if($sqld===TRUE)
	{
		echo "Datas inserted";
	}
  header("Location:topic.php");
}
FUNCTION getreply($conn)
   { $reply_id=$_SESSION['id'];
	$sql="SELECT * FROM chat1 WHERE id='$reply_id'";
	$result=$conn->query($sql);
	while($row=$result->fetch_assoc())
	{  $iod=$row['uid'];
       $sqll="SELECT * FROM myguests WHERE id='$iod'";
       $resultl=$conn->query($sqll);
	   if($rowl=fetch_assoc($resultl))
	   {
       echo "<div class='comment-box'><p>" ;
	   echo $rowl['username']."<br>";
	   echo nl2br($row['message'])."<br>";
	   echo "</p>";
	   if(isset($_SESSION['id']))
	   {  
         if($_SESSION['id']==$rowl['id'])
		 { 
	     echo "
		<form class='edit-button' method='POST' action='editcomment.php'>
		<input type='hidden' name='id' value='".$row['id']."'>
		<input type='hidden' name='uid' value='".$row['uid']."'>
		<input type='hidden' name='message' value='".$row['message']."'>
		<button>Edit</button>
		</form>";
		}
}
	   echo "</div>";
	   }
    }
}
}
