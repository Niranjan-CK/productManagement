<?php require 'includes/Init.php' ?>
<!Doctype html>
<html>
    <head>
        <title>Ecommerse Website</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>    
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
        <script src="https://unpkg.com/feather-icons"></script>
    </head>
    <body>
        <div class="container">

            <nav class="navbar navbar-expand-lg bg-body-tertiary">
                <div class="container-fluid">
                    
                    <ul class="navbar-nav">
                        <li class="navbar-brand"> <a class="nav-link " href="/Ecommerce">Shop</a></li>
                        <?php if($_SESSION['isLoggedIn'])  :?>
                            <?php if($_SESSION['userType']<>'normalUser' ) :?>
                                
                                <li class="nav-item"><a  class="nav-link "href="/Ecommerce/AddProduct.php"> Add Product </a></li>
                                <li class="nav-item"><a  class="nav-link "href="/Ecommerce/AddCategory.php"> Add Category </a></li>
                            <?php endif ;?>

                            <?php if ($_SESSION['userType']=='admin') :?>
                                <li class="nav-item"><a  class="nav-link "href="SignUp.php?type=editor"> Add Editor </a></li>
                            <?php endif;?>
                    </ul>
                    <ul class="navbar-nav nav navbar-right">
                                
                        <li class="nav-item nav-link">Hello <?= $_SESSION['username']?></li>
                        <li class="nav-item ">
                            <a href="Logout.php"><button class="btn btn-primary">Logout</button></a>
                        </li>
                    </ul>
                            
                            
                        <?php else: ?>
                            <ul class="nav navbar-nav navbar-right">
                                <li class="nav-item m-2">
                                    <a href="Login.php" class="link"><button class="btn btn-primary">Login</button></a>
                                </li>
                                
                            </ul>
                            
                        <?php endif ;?>
                    </ul>
                </div>
            </nav>

