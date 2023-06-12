<?php
    require 'includes/Init.php';
    $db = new Database();
    $conn = $db->getConn();
    // $products = ProductDetails::viewProduct($conn);
    // var_dump($products);
?>

<article>
    <div class="container text-center">
        <div class="row row-cols-3">
            <?php if(!empty($productByCate)):?>
                <?php foreach($productByCate as $product): ?>
                    <div class="col card">
                        <h2> <?= $product['productName'] ?> </h2>
                        <p> <?= $product['description'] ?> </p>
                        <p> $<?= $product['price'] ?> </p>
                        <a class="nav-link" href="EachProduct.php?id=<?= $product['id'] ?>"><button class="btn btn-light">View</button></a>
                    </div>
                <?php endforeach; ?>
            <?php else :?>
                <?php foreach($products as $product): ?>
                    <div class="col card" style="margin:5px;padding:10px;">
                        <h2> <?= $product['productName'] ?> </h2>
                        <p> <?= $product['description'] ?> </p>
                        <p> $<?= $product['price'] ?> </p>
                        <a href="EachProduct.php?id=<?= $product['id'] ?>"><button class="btn btn-light">View</button></a>
                    </div>
                <?php endforeach; ?>
            <?php endif ;?>
        </div>
    </div>

</article>