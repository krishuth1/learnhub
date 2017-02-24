<?php
SESSION_START();
include 'connect.php';
include 'comment.php';
require ('styling.php');
?>
<Html>
<Head>

</Head>
<Body>
<br>
<br>
<?php
$cid=$_POST['cid'];
$uid=$_POST['uid'];
$_SESSION['id']=$id;
echo "<form method='POST' action='".setreply($conn)."'>
   <input type='hidden' name='cid' value=".$id.">
   <input type='hidden' name='uid' value=".$uid.">
   <textarea name='message'></textarea>
   <br>
   <button type='submit' name='commentReply'>Replies</button>
   </form>";
  getreply($conn);
  echo "Click <a href='index.php'>Here</a> to go back";
 ?>
</Body>
</Html>