<?php
    require 'includes/Init.php';
    require 'includes/Header.php';

    $db = new Database();
    $conn = $db->getConn();
    
    $categories = ProductDetails::getCategory($conn);
    $product1 = ProductDetails::getById($conn,$_GET['id']);

    $product = new ProductDetails();
    if($_SERVER["REQUEST_METHOD"]=="POST")
    {
        $product->productName = $_POST['productName'];
        $product->description = $_POST['description'];
        $product->productPrice = $_POST['productPrice'];
        $product->category = $_POST['category'];
        $product->productId = $_GET['id'];

        $product->productImage = $_FILES['productImage']['name'];


        try{
            switch ($_FILES['productImage']['error']) {
                case UPLOAD_ERR_OK:
                    break;
                case UPLOAD_ERR_NO_FILE:
                    throw new RuntimeException('No File Uploaded');
                    break;
                case UPLOAD_ERR_INI_SIZE:
                    throw new RuntimeException('Exceeded File Size Limit');
                    break;
                case UPLOAD_ERR_FORM_SIZE:
                    throw new RuntimeException('Exceeded File Size Limit');
                    break;
                default:
                    throw new RuntimeException('Unknown Error');
                    break;
                

            }
            if($_FILES['productImage']['size']>4000000)
            {
                throw new RuntimeException('Exceeded File Size Limit');
            }
            $mimeType = ['image/jpeg','image/png','image/gif'];
            $finfo = finfo_open(FILEINFO_MIME_TYPE);
            $mime = finfo_file($finfo,$_FILES['productImage']['tmp_name']);
            if(!in_array($_FILES['productImage']['type'],$mimeType))
            {
                throw new RuntimeException('Invalid File Type');
            }

            // rename file to avoid special characters

            $pathInfo = pathinfo($_FILES['productImage']['name']);
            $base = $pathInfo['filename'];
            $base = preg_replace('/[^a-zA-Z0-9_-]/','_',$base);
            $base = mb_substr($base,0,200);
            $filename = $base . "." . $pathInfo['extension'];

            $designation = "images/$filename";
           

            $i=1;

            while(file_exists($designation))
            {
                echo $designation;
                $designation = $base."-$i.".$pathInfo['extension'];
                $designation = "images/$designation";
                $i++;
            }
            
            echo $designation;
            if(move_uploaded_file($_FILES['productImage']['tmp_name'],$designation))
            {
                $product->productImage = $filename;
                if($product->update($conn))
                {
                    header("Location:Index.php");
                    }
                else
                {
                    
                    $errors = $product->errors;
                    
                }
            }
            else
            {
                throw new RuntimeException('Failed to Upload File');
            }
            

        }
        catch(RuntimeException $e)
        {
            echo $e->getMessage();
        }

        // if($product->update($conn))
        // {
        //     header("Location:Index.php/EachProduct.php?id=".$_GET['id']);
        // }
        // else
        // {
            
        //     $errors = $product->errors;
            
        // }
        


    }

?>
<h3>Upaload Product</h3>
<?php require 'includes/ProductForm.php'; ?>
<?php require 'includes/Footer.php'; ?>