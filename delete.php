<?php require_once('db.php');
$db =  new Database(); 
$id=$_GET['id']??'';
$sql="DELETE FROM users WHERE id='$id'";
$res=$db->delete_record($sql);
if ($res===TRUE) {
	header('location:index.php');
}

?>
