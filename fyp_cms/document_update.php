<html>
<head>
    <title>Update Document</title>
</head> 
<body>
    <?php
        //call file to connect server eleave
        include 'config.php';
    ?>

    <h2>Edit Document Record</h2>

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
        

        //look for userEmail
        if (empty ($_POST ['status']))
        {
            $error [] = 'You forgot to enter the status.';
        }
        else
        {
            $status = mysqli_real_escape_string($db, trim ($_POST['status']));
        }

        //look for userPhoneNo
        if (empty ($_POST ['docTitle']))
        {
            $error [] = 'You forgot to enter the document title.';
        }
        else
        {
            $sname = mysqli_real_escape_string($db, trim ($_POST['docTitle']));
        }

        $date = date('Y-m-d');

        //if no problem occured
        if (empty($error))
        {
            $q = "SELECT docId FROM document WHERE docTitle ='$sname' AND docId != $sid";

            $result = @mysqli_query ($db, $q); //run the query

            if (mysqli_num_rows($result)==0)
            {
                $q ="UPDATE document SET document.status='$status'
                 WHERE docId ='$sid'";

                $result = @mysqli_query ($db, $q); //run the query

                if (mysqli_affected_rows($db)== 1)
                {
                    echo '<script>alert("The document has been updated");
                    window.location.href="document_info.php";</script>';
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

    $q = "SELECT docId, docTitle, document.status from document WHERE docId =$sid";

    $result = @mysqli_query($db, $q);//run the query

    if (mysqli_num_rows($result)==1)
    {
        //get admin information
        $row =mysqli_fetch_array($result, MYSQLI_NUM);

        //create the form
        echo '
        <p><label class ="label"> '.$row[1].'</label></p>
        <form action="document_update.php" method ="post">
        <p>
        <label class ="label" for="status">Status :</label></td>
        <select name="status" id="status">
            <option value="Returned">Returned</option>
            <option value="Not Returned">Not Returned</option>
        </select></p>

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