<?php
   include 'connect.php';
   include 'comment.php';
   require ('styling.php');
 ?>
<!DOCTYPE html>
<Html>
<Head>
</Head>
<Body>
<br>
<br>
<?php
$cid=$_POST['cid'];
$uid=$_POST['uid'];
$message=$_POST['message'];
echo "<form method='POST' action='".editcomments($conn)."'>
   <input type='hidden' name='cid' value=".$cid.">
   <input type='hidden' name='uid' value=".$uid.">
   <textarea name='message'>".$message."</textarea>
   <br>
   <button type='submit' name='commentSubmit'>Edit</button>
</form>";
?>
</Body>
</Html>