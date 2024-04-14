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
<title>Document Page</title>
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

<!-- Navbar -->
<div class="w3-top">
  <div class="w3-bar w3-purple w3-card w3-left-align w3-large">
    <a class="w3-bar-item w3-button w3-hide-medium w3-hide-large w3-right w3-padding-large w3-hover-white w3-large w3-purple" href="javascript:void(0);" onclick="myFunction()" title="Toggle Navigation Menu"><i class="fa fa-bars"></i></a>
    <a href="staff.php" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white">Home</a>
    <div class="dropdown">
      <button class="dropbtn">Client
        <i class="fa fa-caret-down"></i>
      </button>
      <div class="dropdown-content">
        <a href="client_info.php">Manage Client</a>
        <a href="add_client.php">Add Client</a>
        <a href="search_client.php">Search Client</a>
      </div>
    </div> 
    <div class="dropdown">
      <button class="dropbtn">Document
        <i class="fa fa-caret-down"></i>
      </button>
      <div class="dropdown-content">
        <a href="document_info.php">Manage Document</a>
        <a href="add_document.php">Add Documentt</a>
        <a href="search_document.php">Search Document</a>
      </div>
    </div> 
    <a href="admin.php" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white">Admin</a>
  </div>

  <!-- Navbar on small screens -->
  <div id="navDemo" class="w3-bar-block w3-white w3-hide w3-hide-large w3-hide-medium w3-large">
    <a href="staff.html" class="w3-bar-item w3-button w3-padding-large">Home</a>
    <a href="client_info.html" class="w3-bar-item w3-button w3-padding-large">Client Info</a>
    <a href="#" class="w3-bar-item w3-button w3-padding-large">Admin</a>
  </div>
</div>

<?php
    include 'config.php';
?>

<!-- First Grid -->
<?php

  $q = "SELECT document.docId, document.docTitle, document.companyId, document.status, document.dateAdd, client.companyName
  from document
  INNER JOIN client ON client.companyId = document.companyId
  ORDER BY docId";

  //run the query and assign it to the variable $result
  $result = @mysqli_query($db, $q);

  if ($result)
  {
    echo 
          '<div>
            <h1>Documents</h1>
             <table width="90%" class="tableInfo" style="margin-left: auto; margin-right: auto; text-align: center;">
              <tr>
                <th width="15%">ID</th>
                <th width="20%">Title</th>
                <th width="20%">Company Name</th>
                <th width="15%">Date Added</th>
                <th width="10%">Status</th>
                <th width="10%">Update</th>
              </tr>';

                //Fetch and print all the records
                while ($row=mysqli_fetch_array($result, MYSQLI_ASSOC))
                {
                  echo '<tr>
                  <td>'.$row['docId'].'</td>
                  <td>'.$row['docTitle'].'</td>
                  <td>'.$row['companyName'].'</td>
                  <td>'.$row['dateAdd'].'</td>
                  <td>'.$row['status'].'</td>
                  <td align="center"><a href="document_update.php?id='.$row['docId'].'">Update</a></td>
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