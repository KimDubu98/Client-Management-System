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
.content {text-align: center; padding-left: 40%; padding-top: 3%;}
.tableAdd,th,td {border-style: hidden;}
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
    <a href="document.html" class="w3-bar-item w3-button w3-padding-large">Documents</a>
    <a href="#" class="w3-bar-item w3-button w3-padding-large">Admin</a>
  </div>
</div>


<!-- First Grid -->
<div class="w3-row-padding w3-padding-64 w3-container">
  <div class="content">
    <table class="tableAdd" width="350" >
    <form method="post" action="client_add.php">
        <tr><td><label for="companyId">Company ID : </label></td>
        <td width="150"><input type="text" id="companyId" name="companyId" value="<?php if (isset($_POST['companyId'])) echo $_POST ['companyId'];?>"></td></tr>
        <tr><td><label for="companyName">Company name : </label></td>
        <td width="150"><input type="text" id="companyName" name="companyName" value="<?php if (isset($_POST['companyName'])) echo $_POST ['companyName'];?>"></td></tr>
        <tr><td><label for="companyAddress">Address : </label></td>
        <td><input type="text" id="companyAddress" name="companyAddress" value="<?php if (isset($_POST['companyAddress'])) echo $_POST ['companyAddress'];?>"></td></tr>
        <tr><td><label for="companyEmail">Company Email : </label></td>
        <td><input type="text" id="companyEmail" name="companyEmail" value="<?php if (isset($_POST['companyEmail'])) echo $_POST ['companyEmail'];?>"></td></tr>
        <tr><td><label for="companyPhone">Phone number : </label></td>
        <td><input type="text" id="companyPhone" name="companyPhone" value="<?php if (isset($_POST['companyPhone'])) echo $_POST ['companyPhone'];?>"></td></tr>
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