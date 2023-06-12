<?php
require 'includes/Init.php';

$db = new Database();
$conn = $db->getConn();
if (isset($_GET['id'])) {
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



