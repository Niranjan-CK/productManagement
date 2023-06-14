<?php

    class User{
        public $username;

        public $password;

        public $email;

        public $errors=[];


        public function registerUser($conn){
            try{
                if($this->validate())
                {
                    $sql = "INSERT INTO user (id,username,email,password)
                            VALUES (NULL,:username,:email,:password)";
                    $protectedPass =password_hash($this->password,PASSWORD_DEFAULT);
                    $stmt =  $conn->prepare($sql);
                    $stmt->bindValue(':username',$this->username,PDO::PARAM_STR);
                    $stmt->bindValue(':email',$this->email,PDO::PARAM_STR);
                    $stmt->bindValue(':password',$protectedPass,PDO::PARAM_STR);
                    return $stmt->execute();
                }
                else
                {
                    return false;
                }
            }
            catch(Exception $e)
            {
                echo "Something went worng";
            }

        }

        public static function authentication($conn,$email,$password)
        {
            
            $sql = "SELECT * FROM user WHERE email=:email";
            $stmt = $conn->prepare($sql);
            $stmt->bindValue(':email',$email,PDO::PARAM_STR);
            $stmt->execute();
            $user = $stmt->fetch();
            
            
            if($user)
            {
                $_SESSION['username'] = $user['username'];
                return password_verify($password,$user['password']);
            }

        }

        protected function validate()
        {
            if(empty($this->username))
            {
                array_push($this->errors,"username is required");
            }
            if(empty($this->email))
            {
                array_push($this->errors,"email is required");
            }
            if(empty($this->password))
            {
                array_push($this->errors,"Password is required");
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

    }

?>