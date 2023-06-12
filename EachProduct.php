<?php
    require 'includes/Init.php';
    require 'includes/Header.php';

    $db = new Database();
    $conn = $db->getConn();

    $product = ProductDetails::getById($conn,$_GET['id']);
    
?>
<h2><?= $product[0]['productName']; ?></h2>
<article class="card conatiner  " style="width:20rem; padding:20px;">

    <img src="images/<?= $product[0]['productImage'];?>" class="card-img-top" alt="...">

    <p>Description: <?= $product[0]['description'];?></p>

    <p>Price: <?= $product[0]['price'];?></p>

    <div class="nav">
        <a class="nav-link" href="EditProduct.php?id=<?= $product[0]['id']?>"> <button class="btn btn-primary"> Edit </button></a>
        <a class="nav-link btn-primary" id="delete-product" href="DeleteProduct.php?id=<?=$product[0]['id'] ?>"> <button class="btn btn-primary">Delete</button> </a>
    </div>

</article>

<article>
    <div class="container text-center">
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
<script src="script.js"></script>
<script src="js/jquery-3.7.0.min.js"></script>
<?php require 'includes/Footer.php'; ?>