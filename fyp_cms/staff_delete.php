<html>
<head>
    <title>Delete Staff</title>
</head> 
<body>
    <?php
        //call file to connect server eleave
        include 'config.php';
    ?>

    <h2>Delete Staff Record</h2>

    <?php
    //look for a valid user id, either through GET or POST
    if((isset ($_GET['id'])) && (is_numeric($_GET['id'])))
    {
        $sid = $_GET['id'];
    }
    else if ((isset ($_POST['id'])) && (is_numeric($_POST['id'])))
    {
        $sid = $_POST['id'];
    }
    else
    {
        echo '<p class ="error">This page has been accessed in error.</p>';
        exit();
    }

    if ($_SERVER['REQUEST_METHOD']== 'POST')
    {
        if ($_POST['sure'] == 'Yes')//Delete the record
        {
            //make the query
            $q= "DELETE FROM staff WHERE staffId =$sid ";
            $result = @mysqli_query ($db, $q);//run the query

            if (mysqli_affected_rows($db) == 1)//if there was a problem
            //display message
            {
                echo '<script>alert("The staff has been deleted");
                window.location.href="staff_info.php";</script>';
            }
            else
            {
                //display error message
                echo '<p class ="error"> The record could not be deleted.<br>
                Probably because it does not exist or due to the system error.</p>';
            }
        }
        else
        {
            echo '<script>alert("The staff has NOT been deleted");
            window.location.href="staff_info.php";</script>';
        }
    }
    else
    {
        //display the form
        //retrieve the member's data

        $q= "SELECT staffId, staffName FROM staff WHERE staffId = $sid";
        $result= @mysqli_query ($db, $q); //run the query

        if (mysqli_num_rows($result) ==1)
        {
            //get admin information
            $row = mysqli_fetch_array($result, MYSQLI_NUM);
            echo "<h3>Are you sure want to permanently delete $row[1]? </h3>";
            echo '<form action="staff_delete.php" method="post">
            <input id="submit-no" type="submit" name="sure" value="Yes">
            <input id="submit-no" type="submit" name="sure" value="No">
            <input type="hidden" name="id" value="'.$sid.'">
            </form>';
        }
        else
        {
            //if it didn't run
            //message
            echo '<p class ="error">This page has been accessed in error<p>';
            echo '<p>&nbsp;</p>';
        }//end of it (result)
    }
    mysqli_close($db); //close the database connection_aborted
    ?>
</body>
</html>