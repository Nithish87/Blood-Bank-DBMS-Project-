<html>
	<head>
		<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
	</head>
</html>


<?php

	session_start();
	$AdminID=$_SESSION['Admin'];
	$_SESSION['email']=$AdminID;

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

//Receive donation info
if(isset($_POST['submit']))
echo "In Submit";
{
	$CampID=$_POST['CampID'];

	$UserID=$_POST['UserID'];

	$Quantity=$_POST['Quantity'];

    //session_start();
    $AdminID=$_SESSION['Admin'];
	
	//Query to insert donation into table
	$sql_query ="INSERT INTO `donated`(`CampID`, `UserID`,`Quantity`)
	    VALUES ('$CampID','$UserID','$Quantity')";

	//Query to get the blood type of the donar
	$userquery="SELECT BloodType FROM user WHERE Email='$UserID'";
	$connection=mysqli_query($conn,$userquery);
	$rows = mysqli_fetch_assoc($connection);

	$type=$rows['BloodType'];
	//Query to get the total quantity of user's type blood donated
	$quantityquery="SELECT Quantity FROM blood WHERE Name='$type'";
	$connection=mysqli_query($conn,$quantityquery);
	$row = mysqli_fetch_assoc($connection);

	$quan=$row['Quantity'];
	//Converting mL to L
	$Quantity=$Quantity/1000;
	//Query to update total donations
	$updatequery="UPDATE blood SET Quantity='$quan'+'$Quantity' WHERE Name='$type'";

	//Query to detele registration for the donation
    $deletequery="DELETE from register WHERE CampID='$CampID'";


	if(mysqli_query($conn,$sql_query))
	{
		//Insert successful
        if(mysqli_query($conn,$deletequery)){
			//Deletion successful
			if(mysqli_query($conn,$updatequery)){
				//Updation successful
	    	?>
			<script type="text/javascript">
				/*alert( "Donation successful !");
				window.location.href="adminhome.php";*/
				swal({
                    title: "Donation successful!!",
                    icon: "success",
                    button: "Good",
                })
                    .then((value) => {
                        window.location.href="adminhome.php";
                });
			</script>
			<?php
			}
        }
	}
	else
	{
		echo "Error: " . $sql_query . "" . mysqli_error($conn);
	}
	mysqli_close($conn);
}
?>    