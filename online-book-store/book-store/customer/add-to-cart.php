<?php 
  include('functions.php');

  if (!isLoggedIn()) {
    $_SESSION['msg'] = "You must log in first";
    header('location: login.php');
  }
?>
<?php include("config.php");
$username = $_SESSION['user']['username'];
if (isset($_GET['id']) && is_numeric($_GET['id']) && $_GET['id'] > 0)
{
$id = $_GET['id'];
$book = "SELECT* FROM orders where bookId='$id' and username='$username'";
	$results = mysqli_query($db, $book);
	if(mysqli_num_rows($results)>0){
		echo '<script type="text/javascript">alert("Book already added to the cart!!");window.location=\'available-books.php\';</script>';
}

else {
$username = $_SESSION['user']['username'];
$result = mysql_query("SELECT * FROM books WHERE bookId=$id")
or die(mysql_error());
$row = mysql_fetch_array($result);
if($row)
{
$id = $row['bookId'];
$price = $row['price'];
mysql_query("INSERT INTO orders (username, price, quantity, bookId)
VALUES('$username', '$price', '1','$id') ")
or die(mysql_error());
echo "<script type='text/javascript'>alert('Book added successfully!!');
        window.location='available-books.php';</script>";

}
}
}







