<?php
    session_start();
 
    if (!isset($_SESSION['username'])) {
        header("Location: login.php");
        exit(); // Terminate script execution after the redirect
    }
    
    include 'config.php';

    if ($_SERVER['REQUEST_METHOD']== 'POST')
    {
        $error = array(); //initialize an error array

        //check for staff id
        if (empty ($_POST ['staffId']))
        {
            $error[] ='You forgot to enter the Staff ID.';
        }
        else
        {
            $sid =mysqli_real_escape_string($db, trim($_POST['staffId']));
        }

        //check for staff name
        if (empty ($_POST ['staffName']))
        {
            $error[] ='You forgot to enter the staff name.';
        }
        else
        {
            $sname =mysqli_real_escape_string($db, trim($_POST['staffName']));
        }
        
        //check for staff age
        if (empty ($_POST ['staffAge']))
        {
            $error [] = 'You forgot to enter the staff age.';
        }
        else
        {
            $sage = mysqli_real_escape_string($db, trim ($_POST['staffAge']));
        }

        //check for staff phone
        if (empty ($_POST ['staffPhone']))
        {
            $error [] = 'You forgot to enter the staff phone no.';
        }
        else
        {
            $sphone = mysqli_real_escape_string($db, trim ($_POST['staffPhone']));
        }

        //check for staff password
        if (empty ($_POST ['password']))
        {
            $error [] = 'You forgot to enter the staff password.';
        }
        else
        {
            $spassword = hash('sha256', trim ($_POST['password']));
        }

        //check for staff username
        if (empty ($_POST ['username']))
        {
            $error [] = 'You forgot to enter the staff username.';
        }
        else
        {
            $susername = mysqli_real_escape_string($db, trim ($_POST['username']));
        }


        //register the user in the database
        //make the query:
        $q = "INSERT INTO staff (staffId, staffName, staffAge, staffPhone, password, username)
        VALUES ('$sid', '$sname', '$sage', '$sphone', '$spassword', '$susername')";
        $result = @mysqli_query ($db, $q);//run the query
        if ($result)//if it runs
        {
            echo '<script>alert("The staff has been added");
            window.location.href="staff_info.php";</script>';
        
        }
        else
        {//if it didn't run
            //message
            echo '<h1>System error</h1>';

        //debugging message
        echo '<p>' .mysqli_error($db). '<br><br>Query: '.$q. '</p>';
        }//end of it (result)
        mysqli_close($db); //close the database connection_aborted
        exit();
    }//end of the main submit conditional
?>
<html>
    <head>
        <title>Admin Page</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="staff2.css">
        <style>
        body,h1,h2,h3,h4,h5,h6 {font-family: "Lato", sans-serif}
        .w3-bar,h1,button {font-family: "Montserrat", sans-serif}
        .content {text-align: center; padding-left: 40%; padding-top: 3%;}
        .tableAdd,th,td {border-style: hidden;}
        </style>
    </head>
    <body>
        <?php
        include 'admin_header.php'
        ?>

        <!-- First Grid -->
        <div class="w3-row-padding w3-padding-64 w3-container">
            <div class="content">
                <table class="tableAdd" width="350" >
                    <form method="post" action="#">
                        <tr><td><label for="staffId">Staff ID : </label></td>
                        <td width="150"><input type="text" id="staffId" name="staffId" value="<?php if (isset($_POST['staffId'])) echo $_POST ['staffId'];?>"></td></tr>
                        <tr><td><label for="staffName">Staff Name : </label></td>
                        <td width="150"><input type="text" id="staffName" name="staffName" value="<?php if (isset($_POST['staffName'])) echo $_POST ['staffName'];?>"></td></tr>
                        <tr><td><label for="staffAge">Staff Age : </label></td>
                        <td><input type="text" id="staffAge" name="staffAge" value="<?php if (isset($_POST['staffAge'])) echo $_POST ['staffAge'];?>"></td></tr>
                        <tr><td><label for="staffPhone">Staff Phone No. : </label></td>
                        <td><input type="text" id="staffPhone" name="staffPhone" value="<?php if (isset($_POST['staffPhone'])) echo $_POST ['staffPhone'];?>"></td></tr>
                        <tr><td><label for="username">Username : </label></td>
                        <td><input type="text" id="username" name="username" value="<?php if (isset($_POST['username'])) echo $_POST ['username'];?>"></td></tr>
                        <tr><td><label for="password">Password : </label></td>
                        <td><input type="text" id="password" name="password" value="<?php if (isset($_POST['password'])) echo $_POST ['password'];?>"></td></tr>
                        <tr><td colspan="2">&nbsp;</td></tr>
                        <tr><td><button type="reset">Reset</button></td>
                        <td><button type="submit">Submit</button></td></tr>
                    </form>
                </table>
            </div>
        </div>



<script>
// Used to toggle the menu on small screens when clicking on the menu button
function myFunction() {
  var x = document.getElementById("navDemo");
  if (x.className.indexOf("w3-show") == -1) {
    x.className += " w3-show";
  } else { 
    x.className = x.className.replace(" w3-show", "");
  }
}
</script>
        
    </body>
</html>