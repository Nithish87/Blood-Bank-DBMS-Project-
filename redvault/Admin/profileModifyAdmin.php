<html>
	<head>
		<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
	</head>
</html>


<?php
session_start();
$emailID=$_SESSION['email'];

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

	$gender=$_POST['gender'];

	$phone=$_POST['phone'];

	
	$password = $_POST['password'];
	$password_repeat =$_POST['password-repeat'];
	
	$sql_query ="UPDATE admin set FirstName='$FName', LastName='$LName',Gender='$gender', Phone='$phone',Password='$password' WHERE Email='$emailID'";

	//$exists = mysqli_query($conn,"SELECT Email FROM user WHERE email = '$email'");

	//if(mysqli_num_rows($exists)==0){
		if($password===$password_repeat){
			//If password and confirm password are same
			if(mysqli_query($conn,$sql_query))
			{//echo "Login";
				//Updation successful, redirect to login
			?>
				<script type="text/javascript">
					/*alert( "Profile updated successfully !");
					window.location.href="loginAdmin.html";*/
					swal({
                    	title: "Profile updated successfully!",
                    	icon: "success",
                    	button: "Login",
                	})
                    .then((value) => {
                        window.location.href="loginAdmin.html";
                	});
				</script>
			<?php
			}
			else
			{
				echo "Error: " . $sql_query . "" . mysqli_error($conn);
			}
			mysqli_close($conn);
		}
		else{//echo "profile";
		?>
			<script type="text/javascript">
				/*alert("Password didn't match");
				window.location.href="profileAdmin.php";*/
				swal({
                    	title: "Passwords didn't match",
                    	icon: "error",
                    	button: "Retry",
                })
                    .then((value) => {
                        window.location.href="profileAdmin.php";
                });
			</script>
		<?php
		}
	/*}
	else{
		?>
		<script type="text/javascript">
				alert("Email already exists. ");
				window.location.href="login.html";
		</script>
		<?php
	}*/
}
?>