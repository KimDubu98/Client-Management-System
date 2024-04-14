<?php
    include 'config.php';

    if ($_SERVER['REQUEST_METHOD']== 'POST')
    {
        $error = array(); //initialize an error array

        //check for company id
        if (empty ($_POST ['companyId']))
        {
            $error[] ='You forgot to enter the company ID.';
        }
        else
        {
            $cid =mysqli_real_escape_string($db, trim($_POST['companyId']));
        }

        //check for company name
        if (empty ($_POST ['companyName']))
        {
            $error[] ='You forgot to enter the company name.';
        }
        else
        {
            $cname =mysqli_real_escape_string($db, trim($_POST['companyName']));
        }
        
        //check for company address
        if (empty ($_POST ['companyAddress']))
        {
            $error [] = 'You forgot to enter the company address.';
        }
        else
        {
            $caddress = mysqli_real_escape_string($db, trim ($_POST['companyAddress']));
        }

        //check for company email
        if (empty ($_POST ['companyEmail']))
        {
            $error [] = 'You forgot to enter the company email.';
        }
        else
        {
            $cemail = mysqli_real_escape_string($db, trim ($_POST['companyEmail']));
        }

        //check for company phone
        if (empty ($_POST ['companyPhone']))
        {
            $error [] = 'You forgot to enter the company phone number.';
        }
        else
        {
            $cphone = mysqli_real_escape_string($db, trim ($_POST['companyPhone']));
        }


        //register the user in the database
        //make the query:
        $q = "INSERT INTO client (companyId, companyName, companyAddress, companyEmail, companyPhone)
        VALUES ('$cid', '$cname', '$caddress', '$cemail', '$cphone')";
        $result = @mysqli_query ($db, $q);//run the query
        if ($result)//if it runs
        {
            echo '<script>alert("The client has been added");
            window.location.href="client_info.php";</script>';
        
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