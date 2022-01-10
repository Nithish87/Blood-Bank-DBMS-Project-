<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
	<script type="text/javascript" src="scriptsignup.js"></script>
</head>
<body>
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
			?>
			<script type="text/javascript">
				alert( "New Details entry inserted successfully !");
				window.location.href="login.html";
			</script>
			<?php
		}
		else
		{
			echo "Error: " . $sql_query . "" . mysqli_error($conn);
		}
		mysqli_close($conn);
	}
	else{
	?>
		<script type="text/javascript">
			alert("Password didn't match");
			window.location.href="signup.html";
		</script>
		<?php
	
	}
}
?>
</body>

</html>