<?php
    @session_start();
    require_once("dbinfo.php");

    if( isset($_GET['delete-user'])){
        if( $_GET['delete-user'] == "yes"){
            echo "<p> yes </p>";

            echo $_SESSION['id'];

            $db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

            if( mysqli_connect_errno() !=0 ){
                $errors = "<p>Could not connect to database. Please try again later.</p>";
                $_SESSION['errorMessages'] = $errors;
                header("Location: index.php");
                die();
            }

            $query = "DELETE FROM students WHERE id='".$_SESSION['id']."';";

            echo $query;

            $result = $db->query( $query );

            if( $db->affected_rows <= 0){
                $_SESSION['errorMessages'] = "There was a problem deleting the student from the database.";
            } else {
                $success = "<p>Student deleted from the database.</p>";
                $_SESSION['successMessage'] = $success;
            }

            $db->close();

            header("Location: index.php");
            die();

        } else if ($_GET['delete-user'] == "no"){
            echo "<p> no </p>";
            $_SESSION['errorMessages'] = "<p>Record not deleted</p>";
            header("Location: index.php");
            die();
        }
    } else {
        header("Location: index.php");
        die();
    }
?>