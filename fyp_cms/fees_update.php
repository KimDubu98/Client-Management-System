<html>
<head>
    <title>Update Time Taken</title>
</head> 
<body>
    <?php
        //call file to connect server 
        include 'config.php';
    ?>

    <h2>Edit Time Taken Record</h2>

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
        $error = array(); //initialize an error array
        

        //look for userPhoneNo
        if (empty ($_POST ['timeAdd']))
        {
            $error [] = 'You forgot to enter the added time.';
        }
        else
        {
            $timeAdd = mysqli_real_escape_string($db, trim ($_POST['timeAdd']));
        }


        //if no problem occured
        if (empty($error))
        {
            $q = "SELECT timeAdd FROM auditfees WHERE  staffId != $sid";

            $result = @mysqli_query ($db, $q); //run the query
            if (mysqli_num_rows($result)==0)
            {   
                $q ="UPDATE auditfees SET timeAdd='$timeAdd'
                 WHERE staffId ='$sid'";

                $result = @mysqli_query ($db, $q); //run the query
                
                if (mysqli_affected_rows($db)== 1)
                {
                    echo '<script>alert("The time taken has been edited");
                    window.location.href="staff.php";</script>';
                }
                else
                {
                    echo '<p class ="error"> The time taken had not been edited due to the system error.
                    We apologize for any inconvenience.</p>';
                    echo '<p>'.mysqli_error($db).'</br> query:'.$q.'</p>';
                }
            }
            else
            {
                echo '<p class = "error">The id had been registered </p>';
            }
        }
        else
        {
            echo '<p class ="error">The following error (s) occured: </br>';
            foreach ($error as $msg)
            {
                echo "-msg<br>\n";
            }
            echo '<p><p>Please try again.<p>';
        }
    }

    $q = "SELECT staffId, timeTaken, timeAdd, feesRate from auditfees WHERE staffId =$sid";

    $result = @mysqli_query($db, $q);//run the query

    if (mysqli_num_rows($result)==1)
    {
        //get admin information
        $row =mysqli_fetch_array($result, MYSQLI_NUM);

        //create the form
        echo
        '<p><label class ="label">Time Taken: '.$row[1].' hours</label></p>
        <form action="fees_update.php" method ="post">
        
        <p><br><label class ="label" for="timeAdd">Added Time:</label>
        <select name="timeAdd" id="timeAdd">
        <option value="2">2 hours</option>
        <option value="4">4 hours</option>
        <option value="6">6 hours</option>
        </select>

        <br><p><input id ="submit" type="submit" name="submit" value="Update"></p>
        <br><input type="hidden" name="id" value="'.$sid.'"/>
        </form>';
    }
    else
    {
        //if it didn't run
        //message
        echo '<p class ="error">This page has been accessed in error<p>';
    }//end of it (result)
    mysqli_close($db); //close the database connection_aborted
    ?>
</body>
</html>