<?php


require('db_config.php');


if(isset($_GET['id']))
{
     $sql = "DELETE FROM users WHERE id=".$_GET['id'];
     $mysqli->query($sql);
	 echo 'Deleted successfully.';
}


?>