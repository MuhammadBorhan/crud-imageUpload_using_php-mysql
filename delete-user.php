<?php 

include 'config.php';

$deleteId = $_GET['id'];

$deleteUser = "DELETE FROM user WHERE user_id = '{$deleteId}'";

$deleted = mysqli_query($connection,$deleteUser);

if($deleted){
	header("location: users.php");
}else{
	echo "Can't Delete User.";
}

mysqli_close($connection);

?>