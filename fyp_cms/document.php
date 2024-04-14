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


<!-- First Grid -->
<div class="w3-row-padding w3-padding-64 w3-container">
  <div class="content">
    <div>
      <h1>Documents</h1>
        <table width="100%">
            <tr>
                <th width="35%">Company Name</th>
                <th width="35%">Title</th>
                <th width="15%">Date updated</th>
                <th width="15%"></th>
            </tr>
        </table>
    </div>
  </div>
</div>

<!-- Second Grid -->
<div class="w3-row-padding w3-light-grey w3-padding-64 w3-container">
    <div class="w3-content">
  
      <div class="w3-twothird">
        <h1>Add Document</h1>
        <h5 class="w3-padding-32"></h5>
  
        <p class="w3-text-grey"></p>
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