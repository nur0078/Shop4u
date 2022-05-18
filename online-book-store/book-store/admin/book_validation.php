<?php

	$title = mysql_real_escape_string(htmlspecialchars($_POST['title']));
	$author = mysql_real_escape_string(htmlspecialchars($_POST['author']));
	$description=$_POST['description'];
	$category=$_POST['category'];
	$price=$_POST['price'];
	$path1 = $_FILES["txtFile"]["name"];
	  move_uploaded_file($_FILES["txtFile"]["tmp_name"],"images/books/"  .$_FILES["txtFile"]["name"]);
	// Establish Connection with MYSQL
	$con = mysql_connect ("localhost","root");
	// Select Database
	mysql_select_db("bk-store", $con);
	// Specify the query to Insert Record
	$sql = "insert into books(title,author, description, category, price, image) values('".$title."','".$author."','".$description."','".$category."','".$price."','".$path1."')";
	// execute query
	mysql_query ($sql,$con);
	// Close The Connection
	mysql_close ($con);
	
	echo "<script type='text/javascript'>alert('You have added a book successfully!!');
				window.location='books-list.php';</script>";


?>

