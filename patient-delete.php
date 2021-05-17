<?php

require_once('includes/db_con.php');

$user_ID = $_GET['user-id'];

$sql = "DELETE FROM patients 
WHERE id='$user_ID'";
mysqli_query($DB_connect,$sql);

header('Location:admin.php');