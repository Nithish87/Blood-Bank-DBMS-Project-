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

$query = "SELECT * FROM `user` WHERE Email='$emailID'";
$connect = mysqli_query($conn,$query);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>

    <link rel="stylesheet" type="text/css" href="styleprofile.css">
    <script type="text/javascript" src="scriptsignup.js"></script>
</head>
<body>
    <?php
          $_SESSION['email']=$emailID;
    ?>
    <form action="profileModify.php" method="post" style="border:1px solid #ccc">
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

            <label for="bDate"><b>Birth Date:</b></label>
            <br>
            <input type="date" id="bDate" name="bDate" value="<?php echo $rows['DateOfBirth'];?>" required>

            <br>
            <br>
            <!--Gender-->
            <div>
                <label><b>Gender:</b></label>
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

            <label for="Address"><b>Address:</b></label>
            <input  type="text" id="Address" name="Address" value="<?php echo $rows['Address'];?>" required>

            <br>
            <br>
            <!-- Blood Drop dowm menu-->
            <div>
                <label for="Blood"><b>Blood Type:</b></label>
                <br>
                <select id="bloodType" name="bloodType" required>
                    <option value="A+">A+</option>
                    <option value="A-">A-</option>
                    <option value="B+">B+</option>
                    <option value="B-">B-</option>
                    <option value="O+">O+</option>
                    <option value="O-">O-</option>
                    <option value="AB+">AB+</option>
                    <option value="AB-">AB-</option>
                </select>
            </div>
            <br>

            <!--<label for="email"><b>Email:</b></label>
            <br>
            <input type="email" value="<?php// echo $rows['Email'];?>" name="email" width="100px" required>
            <br>
            <br>-->

            <label for="psw"><b>New Password:</b></label>
            <input class="password" type="password" placeholder="Enter Password" name="password" minlength="8" maxlength="15" required>
      
            <label for="psw-repeat"><b>Confirm Password:</b></label>
            <input class="password-repeat" type="password" placeholder="Repeat Password" name="password-repeat" required>
      
            <!--<label>
            <input type="checkbox" checked="checked" name="remember" style="margin-bottom:15px"> Remember me
            </label>
      
            <p>By creating an account you agree to our <a href="#" style="color:dodgerblue">Terms & Privacy</a>.</p>
            -->

            <div class="clearfix">
                <!--<button type="button" class="cancelbtn"><a href="home">Cancel</a></button>-->
                <button type="submit" class="signupbtn">Update</button>
            </div>
        </div>
    </form>

    

</body>
</html>