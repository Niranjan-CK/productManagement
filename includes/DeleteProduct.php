<?php
require 'includes/Init.php';

$db = new Database();
$conn = $db->getConn();
echo "<script>alert('delete page');</script>";
if (isset($_GET['id'])) {
    echo"<script>alert('delee');</script>";
    $product = ProductDetails::getByID($conn, $_GET['id']);
    $deleteProduct = new ProductDetails();
    $deleteProduct->productId =  $_GET['id'];
    if ( ! $product) {
        die("product not found");
    }

} else {
    die("id not supplied, product not found");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    if ($deleteProduct->delete($conn)) {

        Url::redirect("/Ecommerce");

    }
}

?>



