<?php
include 'config.php';
session_start();
 
if (isset($_SESSION['username'])) {
    header("Location: staff.php");
    exit();
}
 
if (isset($_POST['submit'])) {
    $username = mysqli_real_escape_string($db, $_POST['username']);
    $password = hash('sha256', $_POST['password']); // Hash the input password using SHA-256
 
    $sql = "SELECT * FROM staff WHERE username='$username' AND password='$password'";
    $result = mysqli_query($db, $sql);
 
    if ($result->num_rows > 0) {
        $row = mysqli_fetch_assoc($result);
        $_SESSION['username'] = $row['username'];
        header("Location: staff.php");
        exit();
    } else {
        echo "<script>alert('Wrong username or password!')</script>";
    }
}
?>

<html>
    <head>
        <title>Login Page</title>
        <link rel="stylesheet" href="login.css">
    </head>
    <body>
        <div class="container">
            <div class="screen">
                <div class="screen__content">
                    <h3><strong>CLIENT MANAGEMENT SYSTEM</strong></h3>
                    
                    <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post" class="login">
                        <div class="login__field">
                            <i class="login__icon fas fa-user"></i>
                            <input type="text" class="login__input"  placeholder="Username" name="username" required>
                        </div>
                        <div class="login__field">
                            <i class="login__icon fas fa-lock"></i>
                            <input type="password" class="login__input" placeholder="Password" name="password" required>
                        </div>
                        <button class="button login__submit" name="submit">
                            <span class="button__text">Log In Now</span>
                            <i class="button__icon fas fa-chevron-right"></i>
                        </button>				
                    </form>
                    <div>
                        <br><br><br><br>
                        <h2><a style="padding-left:45%;" href="faq.html">FAQ</a></h2>
                    </div>
                    <div style = "font-size:11px; color:#cc0000; margin-top:10px"></div>
                </div>
                <div class="screen__background">
                    <span class="screen__background__shape screen__background__shape4"></span>
                    <span class="screen__background__shape screen__background__shape3"></span>		
                    <span class="screen__background__shape screen__background__shape2"></span>
                    <span class="screen__background__shape screen__background__shape1"></span>
                </div>		
            </div>
        </div>
    </body>
</html>