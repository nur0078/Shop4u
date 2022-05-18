<?php
include('config.php');
if (isset($_GET['bookId']) && is_numeric($_GET['bookId']))
{
$bookId = $_GET['bookId'];
$result = mysql_query("DELETE FROM books WHERE bookId=bookId")
or die(mysql_error());
header("Location: books-list.php");
}
else
{
header("Location: books-list.php");
}
?>
