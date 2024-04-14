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
  ?>

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
    <form action ="search_client.php" method="post">
    <h1>Search client record</h1>
    <p><label class="label" for="companyName">Company Name:</label>
    <input id="companyName" type="text" name="companyName" size="30" 
    maxlength="50" value="<?php if (isset($_POST['companyName']))
    echo $_POST ['companyName']; ?>"/></p>

    <input id="submit" type="submit" name="submit" value="search"/></p>
    </form>

    <h2> Search Result </h2>

    <?php
    $in= $_POST['companyName'];
    $in= mysqli_real_escape_string($db, $in);

    //make the query
    $q = "SELECT companyId, companyName, companyAddress, companyEmail, companyPhone, staffId
    FROM client WHERE companyName like '%$in%' ORDER BY companyId";

    //run the query and assign it to the variable $result
    $result = @mysqli_query ($db, $q);
    
    if ($result)
    {
        //Table heading
        echo  '<table width="100%" class="tableInfo">
        <tr>
          <th width="10%">Company ID</th>
          <th width="20%">Company Name</th>
          <th width="25%">Address</th>
          <th width="15%">Email</th>
          <th width="10%">Phone no.</th>
          <th width="10%">Staff Assigned</th>
          <th width="5%">Update</th>
        </tr>';
        //Fetch and print all the records
        while ($row=mysqli_fetch_array($result, MYSQLI_ASSOC))
        {
          echo '<tr>
          <td>'.$row['companyId'].'</td>
          <td>'.$row['companyName'].'</td>
          <td>'.$row['companyAddress'].'</td>
          <td>'.$row['companyEmail'].'</td>
          <td>'.$row['companyPhone'].'</td>
          <td>'.$row['staffId'].'</td>
          <td align="center"><a href="clientUpdate.php?id='.$row['companyId'].'">Update</a></td>
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
        echo '<p class ="error"> If no record is shown, this is because
        you had incorrect or misssing entry in search form.<br>
        Click the back button on the browser and try again.</p>';

        //debugging message
        echo '<p>'.mysqli_error ($db).'<br></br>Query:'.$q.'</p>';
    }//end of if ($result)
    //close the database connection
    mysqli_close($db);
?>

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