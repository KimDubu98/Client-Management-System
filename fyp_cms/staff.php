<?php
session_start();
 
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit(); // Terminate script execution after the redirect
}
include 'config.php';
  $username = $_SESSION['username'];
  $sql = "SELECT staffName FROM staff WHERE username = '$username'";
    $result = $db->query($sql);

    // Check if the query returned any results
    if ($result->num_rows > 0) {
        // Fetch the staff ID from the result
        $row = $result->fetch_assoc();
        $staffName = $row['staffName'];

    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>Staff Page</title>
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
.fa-anchor,.fa-coffee {font-size:200px}
</style>
</head>
<body>

<!-- Navbar -->
<div class="w3-top">
  <div class="w3-bar w3-purple w3-card w3-left-align w3-large">
    <a class="w3-bar-item w3-button w3-hide-medium w3-hide-large w3-right w3-padding-large w3-hover-white w3-large w3-purple" href="javascript:void(0);" onclick="myFunction()" title="Toggle Navigation Menu"><i class="fa fa-bars"></i></a>
    <a href="staff.php" class="w3-bar-item w3-button w3-padding-large w3-white">Home</a>
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
    <a href="client_info.html" class="w3-bar-item w3-button w3-padding-large">Client Info</a>
    <a href="document.html" class="w3-bar-item w3-button w3-padding-large">Documents</a>
    <a href="#" class="w3-bar-item w3-button w3-padding-large">Admin</a>
  </div>
</div>

<!-- Header -->
<div>
<header class="w3-container w3-purple w3-center" style="padding:128px 16px">
  <h1 class="w3-margin w3-jumbo">WELCOME <?php echo $staffName; ?></h1>
  <a href="logout.php"><button class="w3-button w3-black w3-padding-large w3-large w3-margin-top">Log out</button></a>
</header>
</div>

<!-- First Grid -->
<div class="w3-row-padding w3-padding-64 w3-container">
  <div class="content">
  <?php
  
  $username = $_SESSION['username'];
  $sql = "SELECT staffId FROM staff WHERE username = '$username'";
    $result = $db->query($sql);

    // Check if the query returned any results
    if ($result->num_rows > 0) {
        // Fetch the staff ID from the result
        $row = $result->fetch_assoc();
        $staffId = $row['staffId'];

        // Now you have the staff ID, you can use it in your application
        echo "Staff ID: " . $staffId;
    } else {
        echo "No staff found for username: $username";
    }

  $q = "SELECT auditFees.id, auditFees.timeTaken, auditFees.fees, auditFees.staffId, client.companyName
  FROM auditFees 
  INNER JOIN client ON client.companyId = auditFees.companyId
  WHERE auditFees.staffId = $staffId";


//run the query and assign it to the variable $result
$result = @mysqli_query($db, $q);

if ($result)
{
  echo 
        '<div>
          <h1 style="text-align:center;"><strong>Dashboard</strong></h1>
           <table width="80%" class="tableInfo" style="margin-left: auto; margin-right: auto; text-align:center;">
            <tr>
              <th width="15%">ID</th>
              <th width="20%">Company Name</th>
              <th width="10%">Time Taken (hours)</th>
              <th width="10%">Update</th>
            </tr>';

              //Fetch and print all the records
              while ($row=mysqli_fetch_array($result, MYSQLI_ASSOC))
              {
                echo '<tr>
                <td>'.$row['id'].'</td>
                <td>'.$row['companyName'].'</td>
                <td>'.$row['timeTaken'].'</td>
                <td align="center"><a href="fees_update.php?id='.$row['staffId'].'">Update</a></td>
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
          echo '<p class="error">The current data could not be retrieved.
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
