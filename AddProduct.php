
<?php 
    // require 'classes/Database.php';
    // require 'classes/ProductDetails.php';
    require 'includes/Init.php';
    require 'includes/Header.php' ;
    
    Auth::requireLogin();
    $db = new Database();
    $conn = $db->getConn();

    $categories = ProductDetails::getCategory($conn);


    $product = new ProductDetails();
    if($_SERVER["REQUEST_METHOD"]=="POST")
    {
        $product->productName = $_POST['productName'];
        $product->description = $_POST['description'];
        $product->productPrice = $_POST['productPrice'];
        $product->category = $_POST['category'];
        $product->productImage = $_FILES['productImage']['name'];

        $product->imageDetails = $_FILES['productImage'];
        if($product->uploadImage())
        {
            if($product->addProduct($conn))
            {
                header("Location: index.php");
            }
        }
        else
        {
            echo "Error";
        }
    
    }


?>



<?php require 'includes/ProductForm.php' ?>
<?php require 'includes/Footer.php' ?>