<?php if (! empty($errors)) : ?>
    <ul class="text-danger-emphasis bg-danger-subtle border border-danger-subtle">
        <?php foreach ($errors as $e) : ?>
            <li><?= $e ?></li>    
        <?php endforeach; ?>
    </ul>
<?php endif; ?>

<div class="card container text-center" style=" width:30rem; padding:10px; margin-top:20px;">
    <form method="POST" id="productForm" enctype="multipart/form-data">
        <div class="mb-3">
            <lable> Product Name : <input class="form-control" type="text" name="productName" id="productName" value="<?= htmlspecialchars($product->productName);?>"></label>
        </div>
        <div class="mb-3">
            <lable> Description : <textarea class="form-control" name="description" id="description" rows="4" cols="40" value="<?= htmlspecialchars($product->description);?>"></textarea></label>
        </div>
        <div class="mb-3">
            <lable> Price : <input class="form-control" type="number" name="productPrice" id="productPrice" value="<?= htmlspecialchars($product->productPrice);?>"></label>
        </div>

        <div class="mb-3">
            <label> Upload Image : <input class="form-control" type="file" name="productImage" id="productImage"></label>
        </div>
        
        <div class="mb-3">
            <label> Category : 
            
                    <select class="form-select form-select-sm" name="category" >
                        <option value="<?= htmlspecialchars($product->category);?>">select Category</option>
                        <?php foreach($categories as $category) :?>
                            <option value="<?= $category['id']; ?>"><?= $category['categoryName']; ?></option>
                        <?php endforeach ;?>
                    </select>
        </div>
        <button class="btn btn-primary" >Submit</button>
    </form>
</div>