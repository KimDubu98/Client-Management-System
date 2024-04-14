<html>
<head>
    <title>Update staff</title>
</head> 
<body>
    <?php
        //call file to connect server eleave
        include 'config.php';
    ?>

    <h2>Edit Staff Record</h2>

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
        if (empty ($_POST ['staffName']))
        {
            $error [] = 'You forgot to enter the staff name.';
        }
        else
        {
            $sname = mysqli_real_escape_string($db, trim ($_POST['staffName']));
        }

        //look for userEmail
        if (empty ($_POST ['staffAge']))
        {
            $error [] = 'You forgot to enter the staff age.';
        }
        else
        {
            $sage = mysqli_real_escape_string($db, trim ($_POST['staffAge']));
        }

        //look for userEmail
        if (empty ($_POST ['staffPhone']))
        {
            $error [] = 'You forgot to enter the staff phone No.';
        }
        else
        {
            $sphone = mysqli_real_escape_string($db, trim ($_POST['staffPhone']));
        }


        //if no problem occured
        if (empty($error))
        {
            $q = "SELECT staffId FROM staff WHERE staffName ='$sname' AND staffId != $sid";

            $result = @mysqli_query ($db, $q); //run the query

            if (mysqli_num_rows($result)==0)
            {
                $q ="UPDATE staff SET staffName ='$sname', staffAge ='$sage', staffphone ='$sphone'
                 WHERE staffId ='$sid'";

                $result = @mysqli_query ($db, $q); //run the query

                if (mysqli_affected_rows($db)== 1)
                {
                    echo '<script>alert("The staff has been edited");
                    window.location.href="staff_info.php";</script>';
                }
                else
                {
                    echo '<p class ="error"> The user had not been edited due to the system error.
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

    $q = "SELECT staffId, staffName, staffAge, staffPhone from staff WHERE staffId =$sid";

    $result = @mysqli_query($db, $q);//run the query

    if (mysqli_num_rows($result)==1)
    {
        //get admin information
        $row =mysqli_fetch_array($result, MYSQLI_NUM);

        //create the form
        echo '<form action="staff_update.php" method ="post">
        <p><label class ="label" for="staffName">Staff Name*:</label>
        <input type="text" id="staffName" name="staffName" size="30"
        maxlength ="50" value="'.$row[1].'"></p>
        
        <p><br><label class ="label" for="staffAge">Staff Age*:</label>
        <input type ="number" id="staffAge" name="staffAge" size="30" maxlength="50"
        value="'.$row[2].'"></p>

        <p><br><label class ="label" for="staffPhone">Staff Phone No.*:</label>
        <input type="number" id="staffPhone" name="staffPhone" size="15" maxlength="20"
        value="'.$row[3].'"></p>

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