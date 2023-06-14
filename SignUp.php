<?php require 'includes/Init.php' ?>
<?php require 'includes/Header.php'?>
<?php
    if($_SERVER["REQUEST_METHOD"]=="POST")
    {
        $db = new Database();
        $conn = $db->getConn();

        $user = new User();

        
        
        if($_POST['confirmPassword']==$_POST['password'])
        {
            $type= true;
            $user->password = $_POST['password'];
            $user->username = $_POST['username'];
            $user->email = $_POST['email'];
            if($_SESSION['userType']=='admin'&& $_GET['type']=='editor')
            {
                $user->userType = $_GET['type'];
            }
            elseif($_GET['type']=='normalUser')
            {
                $user->userType = $_GET['type'];
            }
            else
            {
                
                $type=false;
            }

            if($type)
            {
                if($user->registerUser($conn))
                {
                   
                    
                    if($_SESSION['userType']==NULL && User::authentication($conn,$_POST['email'],$_POST['password']))
                    {
                        session_start();
                        session_regenerate_id(true);
                        $_SESSION['isLoggedIn'] = true;
                        header("Location: index.php");
                    }

                }
            }
            else
            {
                echo "Something wrong";
            }
            
            
            
            
        }
        else
        {
            echo "passwords are not matching";
        }

    }
?>
<?php if (! empty($user->errors)) : ?>
    <ul>
        <?php foreach ($user->errors as $error) : ?>
            <li><?= $error ?></li>    
        <?php endforeach; ?>
    </ul>
<?php endif; ?>
<div class="container text-center">
    <div class="">
        <form method="post" >
            <div class="card">
                <div class="mb-3">
                    <label>
                        Username: <input type="text" name="username" class="form-control" value="<?= htmlspecialchars($_POST['username']) ?>" required>
                    </label>
                </div>
                <div class="mb-3">
                    <label>
                        Email: <input type="email" name="email" class="form-control" value="<?= htmlspecialchars($_POST['email']) ?>" required>
                    </label>
                </div>
                <div class="mb-3">
                    <label>
                        Password: <input type="password" name="password" id="" class="form-control" required>
                    </label>
                </div>
                <div class="mb-3">
                    <label>
                        Confirm password: <input type="password" name="confirmPassword" id="" class="form-control" required>
                    </label>
                </div>
                <div class="mb-3">
                    <button class="btn btn-primary">
                        Register
                    </button>
                </div>
                <?php if($_SESSION['userType']<>'admin'):?>
                    <div class="mb-3">
                        <span>
                            Already have an account? <a href="Login.php">Log in</a>
                        </span>
                    </div>
                <?php endif;?>
            </div>
        </form>
    </div>
</div>