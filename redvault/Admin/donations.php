<?php
    session_start();
    $AdminID=$_SESSION['email'];

    $_SESSION['Admin']=$AdminID;

    date_default_timezone_set('Asia/Kolkata');
    $date=date('y-m-d');

    $servername = "localhost";
    $username = "root";
    $password = "";
    $database_name = "redvault";
    
    //echo "Hello";
    
    $conn = mysqli_connect($servername,$username,$password,$database_name);
    
    //echo "Now check the connection";
    
    if(!$conn)
    {
        die("connection failed:" . mysqli_connect_error());
    }

    //Query to get today's capm details
    $Campquery="SELECT * from camp where CampDate='$date'";
    $connectC=mysqli_query($conn,$Campquery);

    //Query to select users registrations for today
    $UserQuery="SELECT distinct(UserID) from register where CampID in (SELECT CampID from camp where CampDate='$date')";
    $connectU=mysqli_query($conn,$UserQuery);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirm Donations</title>

    <link rel="stylesheet" type="text/css" href="styledonations.css">
    <script type="text/javascript" src="scriptsignup.js"></script>
</head>
<body>
    
    <!--Form to fill for donation-->
    <form action="donationsReport.php" method="post" style="border:1px solid #ccc">
        <div class="container">
            <h1 style="color: white;">Donation Confirmation</h1>
            <p style="color: white;">Please fill the donation details</p>
            <br>
            
            <!-- CampID Drop dowm menu-->
            <div>
                <label for="CampID"><b>Camp ID:</b></label>
                <br>
                <select id="CampID" name="CampID" required>
                    <?php
                        while($rows = mysqli_fetch_assoc($connectC)){
                    ?>
                        <option value="<?php echo $rows['CampID'];?>"><?php echo $rows['CampID'];?></option>
                    <?php
                        }
                    ?>
                </select>
            </div>

            <br>
            <!-- UserID Drop dowm menu-->
            <div>
                <label for="UserID"><b>User ID:</b></label>
                <br>
                <select id="UserID" name="UserID" required>
                <?php
                        while($rows = mysqli_fetch_assoc($connectU)){
                    ?>
                        <option value="<?php echo $rows['UserID'];?>"><?php echo $rows['UserID'];?></option>
                    <?php
                        }
                ?>
                </select>
            </div>

            <br>
            <!-- CampID Drop dowm menu-->
            <label for="Quantity"><b>Quantity(mL):</b></label>
            <br>
            <input type="number" placeholder="1" name="Quantity" width="40px" required>

            <br><br>
            <div class="clearfix">
                <!--Confirm donations button-->
                <button type="submit" class="createButton">Confirm Donation</button>
            </div>
            <br>
        </div>
    </form>
</body>
</html>
