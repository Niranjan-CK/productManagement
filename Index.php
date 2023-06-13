<?php


    require 'includes/Header.php';
    require 'includes/Init.php';



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
