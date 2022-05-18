<?php
include('config.php');
if (isset($_GET['bookId']) && is_numeric($_GET['bookId']))
{
$bookId = $_GET['bookId'];
$result = mysql_query("UPDATE books SET status='rejected' WHERE bookId='$bookId'")
or die(mysql_error());
header("Location: offers-list.php");
}
else
{
header("Location: offers-list.php");
}
?>