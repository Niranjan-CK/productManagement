<?php require 'includes/Init.php'?>
<?php require 'includes/Header.php'?>
<?php
    
    
    if($_SERVER["REQUEST_METHOD"]=="POST")
    {
        $db = new Database();
        $conn = $db->getConn();
        $email = $_POST['email'];
        $password = $_POST['password'];
        
        if(User::authentication($conn,$email,$password))
        {
            session_start();
            session_regenerate_id(true);
            $_SESSION['isLoggedIn'] = true;
            header("Location: index.php");
        }
        else
        {
            echo "<script>alert('Invalid username or password')</script>";
        }
    }

    
?>
<?php if(!empty($_SESSION['loginError'])):?>

    <div class="text-danger-emphasis bg-danger-subtle border border-danger-subtle">
        <?= $_SESSION['loginError'] ?>
    </div>
<?php endif ;?>
<form method="POST">
    <div class="text-center mt-5">
        <h1>Login</h1>
        <div class="md-3">
        <label>
            Email: <input type="text" class="form-control"  name="email" required>
        </label>
        </div>
        <div class="mb-3">
            <label>
                Password: <input type="password" name="password"  class="form-control" required>
            </label>
        </div>
        <div class="mb-3">
            <button class="btn btn-primary">
                Login
            </button>
        </div>
        <span>Can't log in? <a href="SignUp.php?type=normalUser">Create Account</a></span>
    </div>
</form>