<?php
/**
 * 
 * 
 */
    class ProductDetails{
        
        public $categoryName;

        public $productName;

        public $description;

        public $productPrice;
        
        public $category;

        public $productId;

        public $errors=[];

        public $imageDetails=[];

        public $productImage;


        public  function addCategory($conn)
        {
            $sql = "INSERT INTO category (id,categoryName) VALUES( NULL,:cName)";
            $stmt = $conn->prepare($sql);
            $stmt->bindValue(':cName',$this->categoryName,PDO::PARAM_STR);
            return $stmt->execute();
        }

        public static function getCategory($conn)
        {
            $sql = "SELECT * FROM category";
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        public function addProduct($conn)
        {

            if($this->validate())
            {
                $sql = "INSERT INTO product 
                        (id,productName,description,price,category,productImage) 
                        VALUES ( NULL,:name,:desc,:price,:cateId,:productImage)";
                $stmt = $conn->prepare($sql);
                echo $this->productImage;
                $stmt->bindValue(':name',$this->productName,PDO::PARAM_STR);
                $stmt->bindValue(':desc',$this->description,PDO::PARAM_STR);
                $stmt->bindValue(':price',$this->productPrice,PDO::PARAM_INT);
                $stmt->bindValue(':cateId',$this->category,PDO::PARAM_INT);
                $stmt->bindValue(':productImage',$this->productImage,PDO::PARAM_STR);
                return $stmt->execute();
            }
            else
            {
                return false;
            }
        }

        

        public static function viewProduct($conn)
        {
            $sql = "SELECT product.* , category.categoryName 
                    FROM product 
                    JOIN category 
                    ON product.category =  category.id
                    ORDER BY category.id";

            $stmt = $conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        
        public static function getById($conn,$id)
        {
            
            $sql = "SELECT * FROM product WHERE id = :id";
            $stmt = $conn->prepare($sql);
            $stmt->bindValue(':id',$id,PDO::PARAM_INT);
            $stmt->execute();


            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        public function update($conn)
        {
            if($this->validate())
            {
                $sql = "UPDATE product
                        SET productName = :productName,
                        description = :description,
                        price = :price,
                        category = :category,
                        productImage = :productImage
                        WHERE id = :id";
                $stmt = $conn->prepare($sql);
                $stmt->bindValue(':id',$this->productId,PDO::PARAM_INT);
                $stmt->bindValue(':productName',$this->productName,PDO::PARAM_STR);
                $stmt->bindValue(':description',$this->description,PDO::PARAM_STR);
                $stmt->bindValue(':price',$this->productPrice,PDO::PARAM_INT);
                $stmt->bindValue(':category',$this->category,PDO::PARAM_INT);
                $stmt->bindValue(':productImage',$this->productImage,PDO::PARAM_STR);


                return $stmt->execute();
            }
            else
            {
                return false;
            }
        }

        public function delete($conn)
        {
            echo"delete function";
            $sql = "DELETE FROM product
                    WHERE id = :id";

            $stmt = $conn->prepare($sql);

            $stmt->bindValue(':id', $this->productId, PDO::PARAM_INT);

            return $stmt->execute();
        }

        public static function getByCategoryID($conn,$cateId)
        {
            
            $sql = "SELECT * FROM product
                    WHERE category = :cateId";
            $stmt = $conn->prepare($sql);
            $stmt->bindValue(':cateId',$cateId,PDO::PARAM_INT);
            $stmt->execute();
            
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        protected function validate()
        {
            if(empty($this->productName))
            {
                array_push($this->errors,"Product Name is required");
            }
            if(empty($this->description))
            {
                array_push($this->errors,"Description is required");
            }
            if(empty($this->productPrice))
            {
                array_push($this->errors,"Price is required");
            }
            if(empty($this->category))
            {
                array_push($this->errors,"Category is required");
                
            }
            if(!empty($this->errors))
            {
                
                return false;
            }
            else
            {
                return true;
            }
        }

        public static function getTotal($conn)
        {
            echo $conn->query('SELECT COUNT(*) FROM product')->fetchColumn();
            return $conn->query('SELECT COUNT(*) FROM product')->fetchColumn();
        }

        public static function getPage($conn,$limit,$offset)
        {
            $sql = "SELECT product.* , category.categoryName
                    FROM product
                    JOIN category
                    ON product.category = category.id
                    ORDER BY category
                    LIMIT :limit
                    OFFSET :offset";
            $stmt = $conn->prepare($sql);
            $stmt->bindValue(':limit',$limit,PDO::PARAM_INT);
            $stmt->bindValue(':offset',$offset,PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        public static function getAll($conn)
        {
            $sql = "SELECT * FROM product ORDER BY category";
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        public function uploadImage()
        {
            try{
            switch ($this->imageDetails['error']) {
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
            if($this->imageDetails['size']>4000000)
            {
                throw new RuntimeException('Exceeded File Size Limit');
            }
            $mimeType = ['image/jpeg','image/png','image/gif'];
            $finfo = finfo_open(FILEINFO_MIME_TYPE);
            $mime = finfo_file($finfo,$this->imageDetails['tmp_name']);
            if(!in_array($this->imageDetails['type'],$mimeType))
            {
                throw new RuntimeException('Invalid File Type');
            }

            // rename file to avoid special characters

            $pathInfo = pathinfo($this->imageDetails['name']);
            $base = $pathInfo['filename'];
            $base = preg_replace('/[^a-zA-Z0-9_-]/','_',$base);
            $base = mb_substr($base,0,200);
            $filename = $base . "." . $pathInfo['extension'];

            $designation = "images/$filename";
           

            $i=1;

            while(file_exists($designation))
            {
                echo $designation;
                $filename = $base."-$i.".$pathInfo['extension'];
                $designation = "images/$filename";
                $i++;
            }
            
            echo $designation;
            if(move_uploaded_file($_FILES['productImage']['tmp_name'],$designation))
            {
                $this->productImage = $filename;
                return true;
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
        }
        

    // recommended product

    public static function recommended($conn,$cateId,$productId)
    {
        
        $sql = "SELECT * FROM product
                WHERE category = :cateId and id != :productId";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':cateId',$cateId,PDO::PARAM_INT);
        $stmt->bindValue(':productId',$productId,PDO::PARAM_INT);
        $stmt->execute();
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


}





?>