<?php
include('config.php');
if (isset($_GET['userId']) && is_numeric($_GET['userId']))
{
$userId = $_GET['userId'];
$result = mysql_query("DELETE FROM users WHERE userId=$userId")
or die(mysql_error());
header("Location: users-list.php");
}
else
{
header("Location: users-list.php");
}
?>
