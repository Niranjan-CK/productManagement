<?php


    require 'includes/Header.php';
    require 'includes/Init.php';



    $db = new Database();
    $conn = $db->getConn();
    // var_dump($conn);
    $categories = ProductDetails::getCategory($conn);

    $paginator = new Paginator($_GET['page'] ?? 1, 4, ProductDetails::getTotal($conn));
    $products = ProductDetails::getPage($conn,$paginator->limit,$paginator->offset);
    // $products = ProductDetails::getAll($conn);
    if($_SERVER['REQUEST_METHOD']=="POST")
    {
        $cateId = $_POST['category'];
        $productByCate = ProductDetails::getByCategoryID($conn,$cateId);
        
    }
    
?>

<form method="POST">
    <div class="mb-3 navbar navbar-expand-lg">
        
            <select name ="category" class="form-select form-select-sm">
                <option selected>select Category</option>
                <?php foreach($categories as $category ) :?>
                    
                    <option value="<?= $category['id']; ?>"><?= $category['categoryName']; ?></option>
                <?php endforeach ;?>
            </select>
        
        
        <button class="btn btn-light " style="margin:10px;">Submit</button>
    </div>
</form>

<?php 
    if(!empty($proudts))
    {
        echo "Products not found";
    }
    else
    {
        
        require 'includes/ViewProduct.php';
    }
?>



<?php require 'includes/Pagination.php' ?>
<?php require 'includes/Footer.php' ?>
