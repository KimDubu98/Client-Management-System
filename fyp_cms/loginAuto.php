<?php
    $myusername = $_POST['myusername'];
    $mypassword = $_POST['mypassword'];

    $con = new mysqli("localhost","root","","fyp");
    if($con->connect_error) {
        die("Failed to connect : ".$con->connect_error);
    } else {
        $stmt = $con->prepare("select * from admin where myusername = ?");
        $stmt->bind_param("s", $myusername);
        $stmt->execute();
        $stmt_result = $stmt->get_result();
        if($stmt_result->num_rows > 0){
            $data = $stmt_result->fetch_assoc();
            if($data['mypassword'] === $mypassword){
                echo '<script>alert("Admin Login Successful.");
                window.location.href="admin_page.php";</script>';
            }else {
                echo '<script>alert("Invalid username or password.");
                window.location.href="admin.php";</script>';
            }
        } else {
            echo '<script>alert("Invalid username or password.");
            window.location.href="admin.php";</script>';
        }
    }

?>