<?php
    session_start();
    $AdminID=$_SESSION['Admin'];

    $_SESSION['Admin']=$AdminID;
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>

    <link rel="stylesheet" type="text/css" href="stylecreate.css">
    <script type="text/javascript" src="scriptsignup.js"></script>
</head>
<body>
    
    <form action="createCamp.php" method="post" style="border:1px solid #ccc">
        <div class="container">
            <h1 style="color: white;">Camp Creation</h1>
            <p style="color: white;">Please fill the camp details</p>
            <br>
            
            <label for="Location"><b>Location:</b></label>
            <br>
            <!-- required-> compulsorily should be filed-->
            <input  type="text" id="Location" name="Location" placeholder="Gotham" required>

            <br>
            <label for="CampDate"><b>Camp Date:</b></label>
            <br>
            <input type="date" id="CampDate" name="CampDate" required>

            <br><br>
            <label for="DueDate"><b>Due Registration Date:</b></label>
            <br>
            <input type="date" id="DueDate" name="DueDate" required>

            <br><br>
            <div class="clearfix">
                <!--<button type="button" class="cancelbtn">Cancel</button>-->
                <button type="submit" class="createButton">Create Camp</button>
            </div>
            <br>
        </div>
    </form>
</body>
</html>
