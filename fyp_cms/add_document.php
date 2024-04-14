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
        if (empty ($_POST ['docId']))
        {
            $error[] ='You forgot to enter the document ID.';
        }
        else
        {
            $did =mysqli_real_escape_string($db, trim($_POST['docId']));
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
                <table class="tableAdd" width="350" >
                    <form method="post" action="#">
                        <tr><td><label for="staffId">Document ID : </label></td>
                        <td width="150"><input type="text" id="docId" name="docId" value="<?php if (isset($_POST['docId'])) echo $_POST ['docId'];?>"></td></tr>
                        <tr><td><label for="docTitle">Document Title : </label></td>
                        <td width="150"><input type="text" id="docTitle" name="docTitle" value="<?php if (isset($_POST['docTitle'])) echo $_POST ['docTitle'];?>"></td></tr>
                        <tr><td><label for="companyName">Company Name : </label></td>
                        <td>
                        <select name="companyName">
                        <?php
                            $comName = mysqli_query($db, "SELECT * FROM client");
                            while($c = mysqli_fetch_array($comName)){
                        ?>
                        <option value="<?php echo $c['companyId']?>"><?php echo $c['companyName'] ?></option>
                        <?php } ?></td></tr>
                        <tr><td><label class ="label" for="status">Status :</label></td>
                        <td><select name="status" id="status">
                            <option value="Returned">Returned</option>
                            <option value="Not Returned">Not Returned</option>
                        </select></td></tr>
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