
<?php 
    // require 'classes/Database.php';
    // require 'classes/ProductDetails.php';
    require 'includes/Init.php';
    $db = new Database();
    $conn = $db->getConn();

    $categories = ProductDetails::getCategory($conn);
    // var_dump($categories);

    $product = new ProductDetails();
    if($_SERVER["REQUEST_METHOD"]=="POST")
    {
        $product->productName = $_POST['productName'];
        $product->description = $_POST['description'];
        $product->productPrice = $_POST['productPrice'];
        $product->category = $_POST['category'];
        
        if($product->addProduct($conn))
        {
            header("Location:Index.php");
        }
        else
        {
            
            $errors = $product->errors;
            
        }
    }


?>

<?php require 'includes/Header.php' ?>
<?php require 'includes/ProductForm.php' ?>
<?php require 'includes/Footer.php' ?>