
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>

    <link rel="stylesheet" type="text/css" href="stylesignup.css">
    <script type="text/javascript" src="scriptsignup.js"></script>
</head>
<body>
    
    <form action="test.php" method="post" style="border:1px solid #ccc">
        <div class="container">
            <h1 style="color: white;">Sign Up</h1>
            <p style="color: white;">Please fill in this form to create an account.</p>
            <br>
            
            <label for="FName"><b>First Name:</b></label>
            <!-- required-> compulsorily should be filed-->
            <input type="text" id="FName" name="FName" placeholder="Bruce" required>
        
            <label for="LName"><b>Last Name:</b></label>
            <input type="text" id="LName" name="LName" placeholder="Wayne" required>

            <label for="bDate"><b>Birth Date:</b></label>
            <br>
            <input type="date" id="bDate" name="bDate" required>

            <br>
            <br>
            <!--Gender-->
            <div>
                <label><b>Title:</b></label>
                <br>

                <label for="Male">Male</label>
                <input type="radio" id="Male" name="gender" required>
                
                <label for="Female">Female</label>
                <input type="radio" id="Female" name="gender" required>

                <label for="Other">Other</label>
                <input type="radio" id="Other" name="gender" required>
            </div>
            <br>

            <label for="phone"><b>Phone Number:</b></label>
            <br>
            <input type="tel" id="phone" name="phone" maxlength="10" minlength="10" required>

            <label for="Address"><b>Last Name:</b></label>
            <input type="text" id="Address" name="Address" placeholder="Mangaluru" required>

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

            <label for="email"><b>Email</b></label>
            <input type="text" placeholder="example@mail.com" name="email" required>
      
            <label for="psw"><b>Password</b></label>
            <input class="password" type="password" placeholder="Enter Password" name="password" minlength="8" maxlength="15" required>
      
            <label for="psw-repeat"><b>Repeat Password</b></label>
            <input class="password-repeat" type="password" placeholder="Repeat Password" name="password-repeat" required>
      
            <!--<label>
            <input type="checkbox" checked="checked" name="remember" style="margin-bottom:15px"> Remember me
            </label>
      
            <p>By creating an account you agree to our <a href="#" style="color:dodgerblue">Terms & Privacy</a>.</p>
            -->

            <div class="clearfix">
                <button type="button" class="cancelbtn">Cancel</button>
                <button type="submit" class="signupbtn">Sign Up</button>
            </div>
        </div>
    </form>

    

</body>
</html>
<?php
$invalid=0;
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

//echo "Connection succesful. Intaking values";

if(isset($_POST['submit']))
echo "In Submit";
{
	$FName=$_POST['FName'];

	$LName=$_POST['LName'];

	$bDate=$_POST['bDate'];

	$gender=$_POST['gender'];

	$phone=$_POST['phone'];

	$address=$_POST['Address'];

	$bloodType=$_POST['bloodType'];

    $email = $_POST['email'];
	
	$password = $_POST['password'];
	$password_repeat =$_POST['password-repeat'];
	
	$sql_query ="INSERT INTO `user`(`FirstName`, `LastName`,`DateOfBirth`,`Gender`,`Phone`,`Address`,`BloodType`,`Email`,`Password`)
	 VALUES ('$FName','$LName','$bDate','$gender','$phone','$address','$bloodType','$email','$password')";
	if($password===$password_repeat){
		if(mysqli_query($conn,$sql_query))
		{
			echo "New Details entry inserted successfully !";
		}
		else
		{
			echo "Error: " . $sql_query . "" . mysqli_error($conn);
		}
		mysqli_close($conn);
	}
	else{
		$invalid=1;?>
		<script>
			alert("Password didn't match");
			//swal( <?php echo "Opps!!", "...passwords don't match." ?>);
		</script>
		<?php
		//header('Location: signup.html');
		/*echo '<div class="alert alert-danger alert-dismissible fade show"
	role="alert">
	<strong>Sorry!!</strong> Passwords don\'t match
	<button type="button" class="close" data-dismiss="alert"
	aria-label="Close">
		<span aria-hidden="true">&times;</span>
	</button>
	</div>';*/
	
	}
}



?>