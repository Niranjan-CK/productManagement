<?php
    require 'includes/Init.php';
    require 'includes/Header.php';

    $db = new Database();
    $conn = $db->getConn();
    
    $categories = ProductDetails::getCategory($conn);
    $product1 = ProductDetails::getById($conn,$_GET['id']);

    $product = new ProductDetails();
    if($_SERVER["REQUEST_METHOD"]=="POST")
    {
        $product->productName = $_POST['productName'];
        $product->description = $_POST['description'];
        $product->productPrice = $_POST['productPrice'];
        $product->category = $_POST['category'];
        $product->productId = $_GET['id'];
        if($product->update($conn))
        {
            header("Location:Index.php/EachProduct.php?id=".$_GET['id']);
        }
        else
        {
            
            $errors = $product->errors;
            
        }
        


    }

?>
<?php require 'includes/ProductForm.php'; ?>
<?php require 'includes/Footer.php'; ?>