<?php
  session_start();
 
  if (!isset($_SESSION['username'])) {
      header("Location: login.php");
      exit(); // Terminate script execution after the redirect
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>Client Info Page</title>
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
.content {text-align: center;}
</style>
</head>
<body>
  <?php
    include 'config.php';
    include 'admin_header.php';
  ?>

  <!-- First Grid -->
<div class="w3-row-padding w3-padding-64 w3-container">
  <div class="content">  

<?php

  $q = "SELECT staffId, staffName, staffAge, staffPhone
  from staff
  ORDER BY staffName";

  //run the query and assign it to the variable $result
  $result = @mysqli_query($db, $q);

  if ($result)
  {
    echo 
          '<div>
            <h1>Staff Information</h1>
             <table width="80%" class="tableInfo" style="margin-left: auto; margin-right: auto;">
              <tr>
                <th width="15%">Staff ID</th>
                <th width="20%">Staff Name</th>
                <th width="10%">Staff Age</th>
                <th width="15%">Staff Phone</th>
                <th width="10%">Update</th>
                <th width="10%">Delete</th>
              </tr>';

                //Fetch and print all the records
                while ($row=mysqli_fetch_array($result, MYSQLI_ASSOC))
                {
                  echo '<tr>
                  <td>'.$row['staffId'].'</td>
                  <td>'.$row['staffName'].'</td>
                  <td>'.$row['staffAge'].'</td>
                  <td>'.$row['staffPhone'].'</td>
                  <td align="center"><a href="staff_update.php?id='.$row['staffId'].'">Update</a></td>
                  <td align="center"><a href="staff_delete.php?id='.$row['staffId'].'">Delete</a></td>
                  </tr>';
                }
            //close the table
            echo '</table>';

            //free up the resources
            mysqli_free_result ($result);
            //if failed to run
            }
            else
            {
            //error message
            echo '<p class="error">The current user could not be retrieved.
            We apologize for any inconvenience.</p>';

            //debugging message
            echo '<p>'.mysqli_error ($db).'<br></br>query:'.$q.'</p>';
            }//end of if ($result)
            //close the database connection
             mysqli_close($db);
?>
        </div>
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

