<?php
session_start();
$emailID=$_SESSION['email'];
//echo $emailID;

$servername = "localhost";
$username = "root";
$password = "";
$database_name = "redvault";

$conn = mysqli_connect($servername,$username,$password,$database_name);

if(!$conn)
{
	die("connection failed:" . mysqli_connect_error());
}

$query = "SELECT * FROM admin WHERE Email='$emailID'";
$connect = mysqli_query($conn,$query);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>

    <link rel="stylesheet" type="text/css" href="../User/styleprofile.css">
    <script type="text/javascript" src="../User/scriptsignup.js"></script>

    <style>
        body{
            background-image: url(../Images/background13.jpg);
        }
    </style>
</head>
<body>
    <?php
          $_SESSION['email']=$emailID;
    ?>
    <form action="profileModifyAdmin.php" method="post" style="border:1px solid #ccc">
        <div class="container">
            <?php $rows = mysqli_fetch_assoc($connect);?>
            <h1 style="color: white;">Profile</h1>
            <p style="color: white;"></p>
            <br>
            
            <label for="FName"><b>First Name:</b></label>
            <!-- required-> compulsorily should be filed-->
            <input  type="text" id="FName" name="FName" value="<?php echo $rows['FirstName'];?>" required>
        
            <label for="LName"><b>Last Name:</b></label>
            <input   type="text" id="LName" name="LName" value="<?php echo $rows['LastName'];?>" required>

            <br>
            <!--Gender-->
            <div>
                <label><b>Title:</b></label>
                <br>

                <input type="radio" id="Male" name="gender" value="Male" required>
                <label for="Male">Male</label>
                
                <input type="radio" id="Female" name="gender" value="Female" required>
                <label for="Female">Female</label>

                <input type="radio" id="Other" name="gender" value="Other" required>
                <label for="Other">Other</label>
            </div>
            <br>

            <label for="phone"><b>Phone Number:</b></label>
            <br>
            <input type="tel" id="phone" name="phone" maxlength="10" minlength="10" value="<?php echo $rows['Phone'];?>" required>
            <br>
            <br>



            <label for="psw"><b>New Password:</b></label>
            <input class="password" type="password" placeholder="Enter Password" name="password" minlength="8" maxlength="15" required>
      
            <label for="psw-repeat"><b>Confirm Password:</b></label>
            <input class="password-repeat" type="password" placeholder="Repeat Password" name="password-repeat" required>
      

            <div class="clearfix">
                <!--<button type="button" class="cancelbtn"><a href="home">Cancel</a></button>-->
                <button type="submit" class="signupbtn">Update</button>
            </div>
        </div>
    </form>

    

</body>
</html>