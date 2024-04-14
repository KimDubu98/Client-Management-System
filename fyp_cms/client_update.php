<html>
<head>
    <title>Update client</title>
</head> 
<body>
    <?php
        //call file to connect server eleave
        include 'config.php';
    ?>

    <h2>Edit Client Record</h2>

    <?php
    //look for a valid user id, either through GET or POST
    if((isset ($_GET['id'])) && (is_numeric($_GET['id'])))
    {
        $id = $_GET['id'];
    }
    else if ((isset ($_POST['id'])) && (is_numeric($_POST['id'])))
    {
        $id = $_POST['id'];
    }
    else
    {
        echo '<p class ="error">This page has been accessed in error.</p>';
        exit();
    }

    if ($_SERVER['REQUEST_METHOD']== 'POST')
    {
        $error = array(); //initialize an error array
        
        //look for userName
        if (empty ($_POST ['companyName']))
        {
            $error [] = 'You forgot to enter the company name.';
        }
        else
        {
            $n = mysqli_real_escape_string($db, trim ($_POST['companyName']));
        }

        //look for userPhoneNo
        if (empty ($_POST ['companyAddress']))
        {
            $error [] = 'You forgot to enter the company address.';
        }
        else
        {
            $ph = mysqli_real_escape_string($db, trim ($_POST['companyAddress']));
        }

        //look for userEmail
        if (empty ($_POST ['companyEmail']))
        {
            $error [] = 'You forgot to enter the company email.';
        }
        else
        {
            $e = mysqli_real_escape_string($db, trim ($_POST['companyEmail']));
        }

        //look for userEmail
        if (empty ($_POST ['companyPhone']))
        {
            $error [] = 'You forgot to enter the company phone No.';
        }
        else
        {
            $ad = mysqli_real_escape_string($db, trim ($_POST['companyPhone']));
        }


        //if no problem occured
        if (empty($error))
        {
            $q = "SELECT companyId FROM client WHERE companyName ='$n' AND companyId != $id";

            $result = @mysqli_query ($db, $q); //run the query

            if (mysqli_num_rows($result)==0)
            {
                $q ="UPDATE client SET companyName ='$n', companyAddress ='$ph', companyEmail ='$e',
                companyPhone ='$ad'
                 WHERE companyId ='$id'";

                $result = @mysqli_query ($db, $q); //run the query

                if (mysqli_affected_rows($db)== 1)
                {
                    echo '<script>alert("The client has been edited");
                    window.location.href="client_info.php";</script>';
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

    $q = "SELECT companyId, companyName, companyAddress, companyEmail, companyPhone from client WHERE companyId =$id";

    $result = @mysqli_query($db, $q);//run the query

    if (mysqli_num_rows($result)==1)
    {
        //get admin information
        $row =mysqli_fetch_array($result, MYSQLI_NUM);

        //create the form
        echo '<form action="client_update.php" method ="post">
        <p><label class ="label" for="companyName">Company Name*:</label>
        <input type="text" id="companyName" name="companyName" size="30"
        maxlength ="50" value="'.$row[1].'"></p>
        
        <p><br><label class ="label" for="companyAddress">Company Address*:</label>
        <input type ="text" id="companyAddress" name="companyAddress" size="30" maxlength="50"
        value="'.$row[2].'"></p>

        <p><br><label class ="label" for="companyEmail">Company Email*:</label>
        <input type ="email" id="companyEmail" name="companyEmail" size="30" maxlength="50"
        pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" required
        value="'.$row[3].'"></p>

        <p><br><label class ="label" for="companyPhone">Company Phone No.*:</label>
        <input type="number" id="companyPhone" name="companyPhone" size="15" maxlength="20"
        value="'.$row[4].'"></p>

        <br><p><input id ="submit" type="submit" name="submit" value="Update"></p>
        <br><input type="hidden" name="id" value="'.$id.'"/>
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