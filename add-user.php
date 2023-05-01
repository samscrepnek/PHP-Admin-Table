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
        <h1>Add a User</h1>
    </header>
    <main>
        <?php
            $errorMessages	= array();
	        @session_start();
	        if( isset($_SESSION['errorMessages']) ){
		        $errorMessages = $_SESSION['errorMessages'];
	        }
            foreach($errorMessages as $error){
                echo "<p>$error</p>";
            }
	        
	        
	        unset($_SESSION['errorMessages']);
        ?>
        <form method="GET" action="add-user-processing.php">
            <div>
                <label for="id">Id:</label>
                <input type="text" name="id" id="id" >
            </div>
            <div>
                <label for="firstname">First Name:</label>
                <input type="text" name="firstname" id="firstname" >
            </div>
            <div>
                <label for="lastname">Last Name:</label>
                <input type="text" name="lastname" id="lastname" >
            </div>
            <input type="submit" /><br />
        </form>
    </main>
</body>
</html>