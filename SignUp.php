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
            $user->password = $_POST['password'];
            $user->username = $_POST['username'];
            $user->email = $_POST['email'];
            if($user->registerUser($conn))
            {
                echo "user Registered";

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
                <div class="mb-3">
                    <span>
                        Already have an account? <a href="Login.php">Log in</a>
                    </span>
                </div>
            </div>
        </form>
    </div>
</div>