<?php
    session_start();
 
    if (!isset($_SESSION['username'])) {
        header("Location: login.php");
        exit(); // Terminate script execution after the redirect
    }
?>

<html>
<head>
 <title>Login Page</title>
 <style>
    body {
        text-align: center;
    }
 </style>
</head>
<body>
    <br><br>
 <form action="loginAuto.php" method="post">
 <table align="center">
 <tr>
 <td colspan="3" align="center"><b>Admin Login</b></td>
 </tr>
 <tr>
 <td>Username</td>
 <td>:</td>
 <td><input name="myusername" type="text"/></td>
 </tr>
 <tr>
 <td>Password</td>
 <td>:</td>
 <td><input name="mypassword" type="password"/></td>
 </tr>
 <tr><td colspan="3">&nbsp</td></tr>
 <tr>
 <td>&nbsp;</td>
 <td>&nbsp;</td>
 <td><input name="Submit" type="submit" value="Login" /></td>
 </tr>
 </table>
 </form>
 <br><br>
 <a href="staff.php"><button>Back to Home Page</button></a>
</body>
</html>