<?php
    require 'includes/Init.php';
    require 'includes/Header.php';

    $db = new Database();
    $conn = $db->getConn();

    $product = ProductDetails::getById($conn,$_GET['id']);
    
?>
<h2 class="m-3"><?= $product[0]['productName']; ?> </h2>
<article class="card conatiner  " style="width:20rem; padding:20px;">

<?php if($_SESSION['isLoggedIn'] &&  $_SESSION['userType']<> "normalUser"):?>
    <!-- edit -->
    <div class="nav align-self-end">
            <a class="m-1" href="EditProduct.php?id=<?= $product[0]['id']?>">
                <button class="btn btn-primary"> 
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pen-fill" viewBox="0 0 16 16">
                        <path d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001z"/>
                    </svg>
                </button>
            </a>
    <!-- edit -->

            <!-- delete product -->
            <?php if($_SESSION['userType']=='admin'):?>
            <a class="m-1" id="delete-product" href="DeleteProduct.php?id=<?=$product[0]['id'] ?>"> 
                <button class="btn btn-primary">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                        <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z"/>
                    </svg>
                </button>
            </a>
            <?php endif ;?>

            <!-- delete -->
        </div>
    <?php endif ;?>
    <img src="images/<?= $product[0]['productImage'];?>" class="card-img-top" alt="...">

    <p>Description: <?= $product[0]['description'];?></p>

    <p>Price: <?= $product[0]['price'];?></p>

    

</article>

<article>
    <div class="container text-center bg-body-secondary mt-3 rounded p-4">
        <fieldset class="row row-cols-3">
        <?php $recentProduct = ProductDetails::recommended($conn, $product[0]['category'],$product[0]['id']); ?>
            <?php if(!empty($recentProduct)):?>
            <legend>Recommended Product</legend>
                <?php foreach($recentProduct as $item): ?>
                <div class="col card" style="margin:5px;padding:10px; width:15rem; ">
                    <img src="images/<?= $item['productImage'] ?>" class="card-img-top" alt="...">
                    <h2> <?= $item['productName'] ?> </h2>
                    <p><?= $item['categoryName'] ?></p>
                    <p> <?= $item['description'] ?> </p>
                    <p> $<?= $item['price']?>  </p>
                    <a href="EachProduct.php?id=<?= $item['id'] ?>"><button class="btn btn-light">View</button></a>
                </div>
                
            <?php endforeach; ?>
            <?php endif; ?>
        </fieldset>
    </div>
</article>
<script src="js/script.js"></script>
<script src="js/jquery-3.7.0.min.js"></script>
<?php require 'includes/Footer.php'; ?>