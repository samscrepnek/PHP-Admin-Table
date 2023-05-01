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
        <h1>Final Project</h1>
    </header>
    <main>
        <p><a href="add-user.php">Add a User</a></p>
        <section>
        <?php
            require_once("dbinfo.php");
            @session_start();

            $errorMessages	= "";
            $successMessage = "";
	        
	        if( isset($_SESSION['errorMessages']) ){
		        $errorMessages = $_SESSION['errorMessages'];
	        }
	        echo $errorMessages;
	        unset($_SESSION['errorMessages']);

            if( isset($_SESSION['successMessage']) ){
		        $successMessage = $_SESSION['successMessage'];
	        }
	        echo $successMessage;
	        unset($_SESSION['successMessage']);


            $db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

            if(  mysqli_connect_errno() != 0   ){
                die("<p>uh oh, couldnt connect to db</p>");
            }

            $query 	= "SELECT id, firstname, lastname FROM students;";

            $results 	= $db->query($query);

            echo "<table>";
                $arrayOfFieldObjects = $results->fetch_fields();
                echo "<tr>";
                    foreach($arrayOfFieldObjects as $fieldObject){
                        echo "<th>".ucwords($fieldObject->name)."</th>";
                    }
                    echo "<th>Update User</th>";
                    echo "<th>Delete User</th>";
                echo "</tr>";
            
                while( $record = $results->fetch_assoc() ){
                echo "<tr>";
                    echo "<td>" . $record["id"] . "</td>" ;
                    echo "<td>" . $record["firstname"] . "</td>" ;
                    echo "<td>" . $record["lastname"] . "</td>" ;
                    echo "<td><a href='edit-user.php?id=".$record["id"]."'>Update</a></td>";
                    echo "<td><a href='delete-user.php?id=".$record["id"]."'>Delete</a></td>";
                echo "</tr>";
                }
            echo "</table>";
        ?>
        </section>
    </main>
    <footer></footer>
</body>
</html>