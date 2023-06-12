<?php


    require 'includes/Header.php';
    require 'includes/Init.php';



    session_start();

    $maxLength = 5;

    if (!isset($_SESSION['recently_viewed'])) {
        $_SESSION['recently_viewed'] = [];
    }

    // Remove older items if the recently viewed list exceeds the maximum length
    if (count($_SESSION['recently_viewed']) > $maxLength) {
        array_splice($_SESSION['recently_viewed'], 0, count($_SESSION['recently_viewed']) - $maxLength);
    }

    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        // Check if the ID already exists in the recently viewed list
        $existingItem = array_filter($_SESSION['recently_viewed'], function($item) use ($id) {
            return $item['id'] === $id;
        });

        if (empty($existingItem)) {
            // Add the new item to the list
            $_SESSION['recently_viewed'][] = ["id" => $id, "count" => 1];
        } else {
            // Increment the count for the existing item
            $existingItemId = array_keys($existingItem)[0];
            $_SESSION['recently_viewed'][$existingItemId]['count']++;

        }
    }

    // Sort the recently viewed list by count in acending order
    usort($_SESSION['recently_viewed'], function($a, $b) {
        return $a['count'] <=> $b['count'];
    });

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
    <div class="mb-3">
        Select Category :
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



<?php require 'includes/pagination.php' ?>
<?php require 'includes/Footer.php' ?>
