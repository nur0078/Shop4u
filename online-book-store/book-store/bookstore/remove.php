<?php
include('config.php');
if (isset($_GET['friendsId']) && is_numeric($_GET['friendsId']))
{
$friendsId = $_GET['friendsId'];
$result = mysql_query("DELETE FROM friends WHERE friendsId=$friendsId")
or die(mysql_error());
header("Location: friends-list.php");
}
else
{
header("Location: friends-list.php");
}
?>
