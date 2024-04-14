<?php
  session_start();
 
  if (!isset($_SESSION['username'])) {
      header("Location: login.php");
      exit(); // Terminate script execution after the redirect
  }

  if ($_SERVER['REQUEST_METHOD']== 'POST')
  {
      $error = array(); //initialize an error array

      //check for staff id
      if (empty ($_POST ['id']))
      {
          $error[] ='You forgot to enter the payment ID.';
      }
      else
      {
          $did =mysqli_real_escape_string($db, trim($_POST['id']));
      }

      //check for staff name
      if (empty ($_POST ['docTitle']))
      {
          $error[] ='You forgot to enter the document title.';
      }
      else
      {
          $dname =mysqli_real_escape_string($db, trim($_POST['docTitle']));
      }
      
      //check for staff age
      if (empty ($_POST ['companyName']))
      {
          $error [] = 'You forgot to enter the company name.';
      }
      else
      {
          $cname = mysqli_real_escape_string($db, trim ($_POST['companyName']));
      }

      //check for staff phone
      if (empty ($_POST ['status']))
      {
          $error [] = 'You forgot to enter the status';
      }
      else
      {
          $status = mysqli_real_escape_string($db, trim ($_POST['status']));
      }

      $date = date('Y-m-d');

      //register the user in the database
      //make the query:
      $q = "INSERT INTO document (docId, docTitle, companyId, dateAdd, status)
      VALUES ('$did', '$dname', '$cname', '$date', '$status')";
      $result = @mysqli_query ($db, $q);//run the query
      if ($result)//if it runs
      {
          echo '<script>alert("The document has been added");
          window.location.href="document_info.php";</script>';
      
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
?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>Client Audit Fees Page</title>
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

  