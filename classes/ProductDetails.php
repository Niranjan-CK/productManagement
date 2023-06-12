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
                        (id,productName,description,price,category) 
                        VALUES ( NULL,:name,:desc,:price,:cateId)";
                $stmt = $conn->prepare($sql);

                $stmt->bindValue(':name',$this->productName,PDO::PARAM_STR);
                $stmt->bindValue(':desc',$this->description,PDO::PARAM_STR);
                $stmt->bindValue(':price',$this->productPrice,PDO::PARAM_INT);
                $stmt->bindValue(':cateId',$this->category,PDO::PARAM_INT);
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
                        category = :category
                        WHERE id = :id";
                $stmt = $conn->prepare($sql);
                $stmt->bindValue(':id',$this->productId,PDO::PARAM_INT);
                $stmt->bindValue(':productName',$this->productName,PDO::PARAM_STR);
                $stmt->bindValue(':description',$this->description,PDO::PARAM_STR);
                $stmt->bindValue(':price',$this->productPrice,PDO::PARAM_INT);
                $stmt->bindValue(':category',$this->category,PDO::PARAM_INT);

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
            return $conn->query('SELECT COUNT(*) FROM product')->fetchColumn();
        }

        public static function getPage($conn,$limit,$offset)
        {
            $sql = "SELECT * 
                    FROM product 
                    ORDER BY category
                    LIMIT :limit
                    OFFSET :offset";
            $stmt = $conn->prepare($sql);
            $stmt->bindValue(':limit',$limit,PDO::PARAM_INT);
            $stmt->bindValue(':offset',$offset,PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

    }
?>