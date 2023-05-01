<?php
    @session_start();
    require_once "dbinfo.php";
    
    $errors = array();
    $id = "";
    $firstname = "";
    $lastname = "";

    if( isset($_GET['id']) && 
    isset($_GET['firstname']) &&
    isset($_GET['lastname'])){

    echo "<p>good input</p>";
    $id = trim($_GET['id']);
    $firstname = trim($_GET['firstname']);
    $lastname = trim($_GET['lastname']);

    if( strlen($id) > 0 ){
        $pattern = "/^a0[0-9]{7}$/i";
        if( !preg_match($pattern, $id) ){
            $errors[] = "Student number pattern should look like 'A0nnnnnnn'";
        } else {
            echo "<p>good id</p>";
        }
    } else {
        $errors[] = "<p>Please fill in the id</p>";
    }

    if( strlen($firstname) > 0 ){
        echo "<p>good first name</p>";
    } else {
        $errors[] = "<p>Please fill in the first name</p>";
    }

    if( strlen($lastname) > 0 ){
        echo "<p>good last name</p>";
    } else {
        $errors[] = "<p>Please fill in the last name</p>";
    }

    } else {
        $errors[] = "<p>Please fill in the form</p>";
    }

    if( count($errors) > 0){
        echo "<p>bad form</p>";
        foreach( $errors as $error){
            echo "<p>$error</p>";
        }
        $_SESSION['errorMessages'] = "<p>Form filled out incorrectly. Please try again.</p>";
        header("Location: index.php");
        die();
    } else {
        echo "<p>good form</p>";

        $db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

        if( mysqli_connect_errno() !=0 ){
            $errors = "<p>Could not connect to database. Please try again later.</p>";
            $_SESSION['errorMessages'] = $errors;
            header("Location: index.php");
            die();
        }

        $id = $db->real_escape_string($id);
        $firstname = $db->real_escape_string($firstname);
        $lastname = $db->real_escape_string($lastname);

        $query = "UPDATE students SET id='".$id."', firstname='".$firstname."', lastname='".$lastname."' WHERE id='".$_SESSION['id']."';";

        $results = $db->query($query);

        if( $db->affected_rows <= 0){
            $errors = "<p>There was a problem editing user in the database. Please try again.</p>";
            $_SESSION['errorMessages'] = $errors;
            header("Location: index.php");
            die();
        } else {
            $success = "<p>Student edited in database.</p>";
            $_SESSION['successMessage'] = $success;
        }
    
        $db->close();
    
        header("Location: index.php");
        die();
    }
?>