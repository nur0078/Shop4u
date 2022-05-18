<?php include "functions.php" ?>
<?php include "config.php" ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <link rel="stylesheet" type="text/css" href="style.css">
        <title>Shop4U</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <!-- Bootstrap icons-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="css/styles.css" rel="stylesheet" />
    </head>
    <body>
        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container px-4 px-lg-5">
                <a class="navbar-brand" href="#!">Shop4U</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                        <li class="nav-item"><a class="nav-link active" aria-current="page" href="index.php">Home</a></li>
                        <li class="nav-item"><a class="nav-link" href="about.php">About</a></li>
                        <li class="nav-item"><a class="nav-link" href="signin.php">Sign in</a></li>
                        <li class="nav-item"><a class="nav-link" href="signup.php">Sign Up</a></li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Shop</a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="#!">All Products</a></li>
                                <li><hr class="dropdown-divider" /></li>
                                <li><a class="dropdown-item" href="#!">Popular Items</a></li>
                                <li><a class="dropdown-item" href="#!">New Arrivals</a></li>
                            </ul>
                        </li>
                    </ul>
                    <form class="d-flex">
                        <button class="btn btn-outline-dark" type="submit">
                            <i class="bi-cart-fill me-1"></i>
                            Cart
                            <span class="badge bg-dark text-white ms-1 rounded-pill">0</span>
                        </button>
                    </form>
                </div>
            </div>
        </nav>
        <!-- Header-->
        <header class="bg-dark py-5">
            <div class="container px-4 px-lg-5 my-5">
                <div class="text-center text-white">
                    <h1 class="display-4 fw-bolder">Shop Books in style</h1>
                    <p class="lead fw-normal text-white-50 mb-0">With Shop4U</p>
                </div>
            </div>
        </header>
        <!-- Section-->

            <div style="text-align: center; margin-top: 0px" id="primary_right">
                <div style="text-align: center;" class="title" margin-top: -21px>
            <h2>Book Details</h2>
                    </div>
                    <br>
            <div class="prod-det">
            <!-- <div class="td">
            <div class="tb"> -->
                    
<?php
                            include('config.php');
                            $id = $_GET['id'];
                            $result = mysql_query("SELECT* from books inner JOIN categories on books.category=categories.categoryId where bookId='$id'");
                            while($row = mysql_fetch_array($result)) {
                                // echo '<div class="productinfo">';
                            echo '<image src = "admin/images/books/'.$row['image'].'" width="160" height="200">';
                            echo'<h1><font color="dodgerblue">'.$row['title'].'</font></h1>';
                            echo'<h3><font color="darkorange">$ '.$row['price'].'</h3></font>';
                            echo'<h2> <font color="black" size="3px">Category: '.$row['name'].'</h2></font>';
                            echo'<p><font color="orange">Description:</font>'.$row['description'].'</p>';
                            echo'<p><button><a href="signin.php"><font color="black" name="btn">Add to Cart</font></button></p>';
                            echo'</div>';

                            }
                            ?>



                        
                        </form>
                    </div>
                </div>
            </div>

                        

</body>
</html>
<?php              
function categories(){

        $query = mysql_query("SELECT * FROM categories") or die (mysql_error());
        while($row = mysql_fetch_array($query)){
                echo "<li class = 'even'><a href ='category.php?id=".$row['categoryId']."'>".$row['name']."</a></li>";                      
            }
        echo "</ul>";
        }
        ?>
        <!-- Footer-->
        <?php include "footer.php"?>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
    </body>
</html>
