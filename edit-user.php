<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/style.css">
    <title>Final Project</title>
</head>
<body>
    <header>
        <h1>Edit User</h1>
    </header>
        <?php
        @session_start();
        require_once("dbinfo.php");

        $id = "";
        $firstname = "";
        $lastname = "";
        $errorMessages = array();
	        
        if( isset($_GET['id']) ){

            $db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

            if( mysqli_connect_errno() !=0 ){
                $errors = "<p>Could not connect to database. Please try again later.</p>";
                $_SESSION['errorMessages'] = $errors;
                header("Location: index.php");
                die();
            }

            $id = $db->real_escape_string($_GET['id']);
            $query = "SELECT id, firstname, lastname FROM students WHERE id='".$id."';";
            $result = $db->query($query);
            while(   $record = $result->fetch_assoc() ){
                $firstname = $record["firstname"];
                $lastname = $record["lastname"];
            }
            $_SESSION['id'] = $id;
            
            $db->close();
        } else {
            header("location: index.php");
            die();
        }

	        if( isset($_SESSION['errorMessages']) ){
		        $errorMessages = $_SESSION['errorMessages'];
	        }
            foreach($errorMessages as $error){
                echo "<p>$error</p>";
            }
	        
	        unset($_SESSION['errorMessages']);
        ?>
        <form method="GET" action="edit-user-processing.php">
            <div>
                <label for="id">Id:</label>
                <input type="text" name="id" id="id" value="<?php echo $id ?>" >
            </div>
            <div>
                <label for="firstname">First Name:</label>
                <input type="text" name="firstname" id="firstname" value="<?php echo $firstname ?>" >
            </div>
            <div>
                <label for="lastname">Last Name:</label>
                <input type="text" name="lastname" id="lastname" value="<?php echo $lastname ?>" >
            </div>
            <input type="submit" /><br />
        </form>
</body>
</html>