<?php
    require 'includes/Init.php';
    $db = new Database();
    $conn = $db->getConn();
    // $products = ProductDetails::viewProduct($conn);
    // var_dump($products);
?>


    <!-- recently viewed products -->

    <div class="container text-center">
        <fieldset class="row row-cols-3">
            <?php if(!empty($_SESSION['recently_viewed'])):?>
            <legend>Recently Viewed Products</legend>
            <?php foreach($_SESSION['recently_viewed'] as $item): ?>
                <?php $recentProduct = ProductDetails::getById($conn, $item['id']); ?>
                
                <div class="col card" style="margin:5px;padding:10px; width:15rem; ">
                    <img src="images/<?= $recentProduct[0]['productImage'] ?>" class="card-img-top" alt="...">
                    <h2> <?= $recentProduct[0]['productName'] ?> </h2>
                    <p><?= $recentProduct[0]['categoryName'] ?></p>
                    <p> <?= $recentProduct[0]['description'] ?> </p>
                    <p> $<?= $recentProduct[0]['price']?>  </p>
                    <a href="EachProduct.php?id=<?= $recentProduct[0]['id'] ?>"><button class="btn btn-light">View</button></a>
                </div>
            <?php endforeach; ?>
            <?php endif; ?>
        </fieldset>
    </div>










    <!-- end -->

    <article>
    
    <div class="container text-center">
        <fieldset class="row row-cols-3">
            <legend>Products</legend>
            <!-- product by category -->
            <?php if(!empty($productByCate)):?>
                <?php foreach($productByCate as $product): ?>
                    <div class="col card" style="margin:5px;padding:10px; width:15rem; ">
                        <img src="images/<?= $product['productImage'] ?>" class="card-img-top" alt="...">
                        <h2> <?= $product['productName'] ?> </h2>
                        <p> <?= $product['description'] ?> </p>
                        <p> $<?= $product['price'] ?> </p>
                        <a class="nav-link" href="EachProduct.php?id=<?= $product['id'] ?>"><button class="btn btn-light">View</button></a>
                    </div>
                <?php endforeach; ?>
                <!-- all products -->
            <?php else :?>
                <?php foreach($products as $product): ?>
                    <div class="col card" style="margin:5px;padding:10px; width:15rem; ">
                    <img src="images/<?= $product['productImage'] ?>" class="card-img-top" alt="...">
                        <h2> <?= $product['productName'] ?> </h2>
                        <p><?= $product['categoryName'] ?></p>
                        <p> <?= $product['description'] ?> </p>
                        <p> $<?= $product['price'] ?> </p>
                        <a href="EachProduct.php?id=<?= $product['id'] ?>"><button class="btn btn-light">View</button></a>
                    </div>
                <?php endforeach; ?>
            <?php endif ;?>
        </fieldset>
    </div>

</article>