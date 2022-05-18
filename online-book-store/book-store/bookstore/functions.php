<?php 
	session_start();

	// connect to database
	$db = mysqli_connect('localhost', 'root', '', 'bk-store');

	// variable declaration
	$fullname = "";
	$contact  = "";
	$address  = "";
	$email = ""; 

	// call the register() function if register_btn is clicked
	if (isset($_POST['friends_btn'])) {
		friends();
	}
	if (isset($_POST['category_btn'])) {
		add_cat();
	}
	// call the login() function if register_btn is clicked
	if (isset($_POST['change_password'])) {
		reset_pwd();
	}
	if (isset($_POST['submit'])) {
		submit();
	}

	if (isset($_GET['logout'])) {
		session_destroy();
		unset($_SESSION['user']);
		header("location: ../signin.php");
	}

	// REGISTER USER
	function friends(){
		global $db;

		// receive all input values from the form
		$fullname    = e($_POST['fullname']);
		$contact       =e($_POST['contact']);
		$address       =e($_POST['address']);
		$email  = e($_POST['email']);
		$user=$_SESSION['user']['username'];

				$query = "INSERT INTO friends (fullname, contact, address, email, username) 
						  VALUES('$fullname', '$contact', '$address', '$email', '$user')";
				mysqli_query($db, $query);
				echo "<script type='text/javascript'>alert('You have added a friend successfully!!');
				window.location='friends-list.php';</script>";
						
			}

	// REGISTER USER

	// return user array from their id
	function getUserById($id){
		global $db;
		$query = "SELECT * FROM users_details WHERE id=" . $id;
		$result = mysqli_query($db, $query);

		$user = mysqli_fetch_assoc($result);
		return $user;
	}

	// LOGIN USER
	function login(){
		global $db, $username, $errors;

		// grap form values
		$username = e($_POST['username']);
		$password = e($_POST['password']);

		// attempt login if no errors on form
		if (count($errors) == 0) {
			$password = md5($password);

			$query = "SELECT * FROM users WHERE username='$username' AND password='$password' LIMIT 1";
			$results = mysqli_query($db, $query);

			if (mysqli_num_rows($results) == 1) { // user found
				// check if user is admin or user
				$logged_in_user = mysqli_fetch_assoc($results);
				if ($logged_in_user['user_type'] == 'customer') {

					$_SESSION['user'] = $logged_in_user;
					$_SESSION['success']  = "You are now logged in";
					header('location: customer/index.php');

				}elseif ($logged_in_user['user_type'] == 'bookstore') {
					$_SESSION['user'] = $logged_in_user;
					$_SESSION['success']  = "You are now logged in";
					header('location: bookstore/index.php');
						  
				}elseif ($logged_in_user['user_type'] == 'admin') {
					$_SESSION['user'] = $logged_in_user;
					$_SESSION['success']  = "You are now logged in";

					header('location: admin/index.php');
				}
			}else {
				array_push($errors, "Wrong user ID/password combination");
			}
		}
	}


	function isLoggedIn()
	{
		if (isset($_SESSION['user'])) {
			return true;
		}else{
			return false;
		}
	}

	function isAdmin()
	{
		if (isset($_SESSION['user']) && $_SESSION['user']['username'] == 'admin' ) {
			return true;
		}else{
			return false;
		}
	}
	function isEmployer()
	{
		if (isset($_SESSION['user']) && $_SESSION['user']['user_type'] == 'employer' ) {
			return true;
		}else{
			return false;
		}
	}
	function isTutor()
	{
		if (isset($_SESSION['user']) && $_SESSION['user']['user_type'] == 'tutor' ) {
			return true;
		}else{
			return false;
		}
	}

	// escape string
	function e($val){
		global $db;
		return mysqli_real_escape_string($db, trim($val));
	}

	function display_error() {
		global $errors;

		if (count($errors) > 0){
			echo '<div class="error">';
				foreach ($errors as $error){
					echo $error .'<br>';
				}
			echo '</div>';
		}
	}
	function make_payments(){
		global $db, $errors;
		$user_id = $_SESSION['user']['user_id'];
		$code = $_POST['mpesa_code'];
		$sql_m = "SELECT* FROM payments where mpesa_code='$code'";
		$res_m = mysqli_query($db, $sql_m);

		// make sure form is filled properly
		if (empty($code)) {
			array_push($errors, "Mpesa Code is required!!");
		}
		if(mysqli_num_rows($res_m)>0){
			array_push($errors, "Sorry...Mpesa code already exists in our database");
		}
		// attempt login if no errors on form
		if (count($errors) == 0) {
		
		mysql_query("INSERT INTO payments (farmer_id, mpesa_code, payment_status, amount)
			VALUES('$user_id', '$code', 'unconfirmed', '0')")
			or die(mysql_error());
		echo "<script type='text/javascript'>alert('you have entered your code successfully, kindly wait for confirmation message from the admin!!');
        window.location='payments.php';</script>";
	}
}
function reset_pwd(){
		global $db, $errors;
		// receive all input values from the form
		$user_id       =($_POST['user_id']);
		$password  =  ($_POST['password']);
		$password_1  =  ($_POST['password_1']);

		// form validation: ensure that the form is correctly filled
		if (empty($user_id)) { 
			array_push($errors, "User ID is required"); 
		}
		if (empty($password)) { 
			array_push($errors, "Password is required"); 
		}
		if (empty($password_1)) { 
			array_push($errors, "Password_1 is required"); 
		}
		if ($password != $password_1) {
			array_push($errors, "The two passwords do not match");
		}

		// register user if there are no errors in the form
		if (count($errors) == 0) {
			$password = md5($password_1);//encrypt the password before saving in the database
					$query = "UPDATE users_details SET password='$password' WHERE user_id='$user_id'" 
						 ;
					$sql = "SELECT * FROM users_details WHERE user_id='$user_id' LIMIT 1";
					$results = mysqli_query($db, $sql);

					if (mysqli_num_rows($results) == 1) { // user found
				mysqli_query($db, $query);
				echo "<script type='text/javascript'>alert('You have changed your password successfully!!');
				window.location='login.php';</script>";

				}else{
					array_push($errors, "user not found. Kindly, check your user id and try again");
				}
			}
		}
		function submit(){
		global $db, $errors;

		// receive all input values from the form
		$fname    = e($_POST['firstname']);
		$lname       =e($_POST['lastname']);
		$gender  = e($_POST['gender']);
		$email  = e($_POST['email']);
		$phone  = e($_POST['phone_no']);
		$message = e($_POST['message']);

		// form validation: ensure that the form is correctly filled
		if (empty($fname)) { 
			array_push($errors, "Firstname is required"); 
		}
		if (empty($lname)) { 
			array_push($errors, "Lastname is required"); 
		}
		if (empty($gender)) { 
			array_push($errors, "Gender is required"); 
		}
		if (empty($email)) { 
			array_push($errors, "Email is required"); 
		}
		if (empty($phone)) { 
			array_push($errors, "Mobile number is required"); 
		}
		if (empty($message)) { 
			array_push($errors, "Message is required"); 
		}

		// register user if there are no errors in the form
		if (count($errors) == 0) {
				$query = "INSERT INTO contact (firstname, lastname, gender, email, phone_no, message) 
						  VALUES('$fname', '$lname', '$gender' , '$email', '$phone', '$message')";
				mysqli_query($db, $query);
				echo "<script type='text/javascript'>alert('Thank you for contacting us. We shall get back to you in 12hrs time');
				window.location='home.php';</script>";
			}
		}

?>

	