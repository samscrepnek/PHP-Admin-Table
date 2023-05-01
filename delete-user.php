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
        <h1>Delete Student</h1>
    </header>
    <main>
        <?php
        @session_start();
        require_once("dbinfo.php");

        $id = "";
    
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
                echo "<p>" .$record["id"]. " " .$record["firstname"]. " " .$record["lastname"]. "</p>" ;
            }
            $_SESSION['id'] = $id;

            $db->close();
        } else {
            header("location: index.php");
            die();
        }
        ?>
        <form method="GET" action="delete-user-processing.php">
            <input type="radio" id="yes" name="delete-user" value="yes" checked>
            <label for="yes">Yes</label><br>
            <input type="radio" id="no" name="delete-user" value="no">
            <label for="no">No</label><br>
        <input type="submit" /><br />
        </form>
    </main>
    <footer></footer>
</body>
</html>