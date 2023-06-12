<?php
    require 'classes/Database.php';
    require 'classes/ProductDetails.php';
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") 
    {
        $db = new Database();
        $conn = $db->getConn();
        $product  = new ProductDetails();
        $product->categoryName=$_POST['categoryName'];
        // echo"product";
        
        if($product->addCategory($conn))
        {
            echo "inserted";
        }
    }
?>
<?php require 'includes/Header.php' ;?>

<?php require 'includes/CategoryForm.php';?>
<?php require 'includes/Footer.php' ;?>
