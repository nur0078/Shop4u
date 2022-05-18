<?php
include('config.php');
if (isset($_GET['categoryId']) && is_numeric($_GET['categoryId']))
{
$categoryId = $_GET['categoryId'];
$result = mysql_query("DELETE FROM categories WHERE categoryId=categoryId")
or die(mysql_error());
header("Location: categories-list.php");
}
else
{
header("Location: categories-list.php");
}
?>
