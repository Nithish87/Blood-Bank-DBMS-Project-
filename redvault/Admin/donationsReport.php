<?php
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

    if(isset($_POST['submit']))
echo "In Submit";
{
	$CampID=$_POST['CampID'];

	$UserID=$_POST['UserID'];

	$Quantity=$_POST['Quantity'];

    session_start();
    $AdminID=$_SESSION['Admin'];
	
	$sql_query ="INSERT INTO `donated`(`CampID`, `UserID`,`Quantity`)
	    VALUES ('$CampID','$UserID','$Quantity')";

	$userquery="SELECT BloodType FROM user WHERE Email='$UserID'";
	$connection=mysqli_query($conn,$userquery);
	$rows = mysqli_fetch_assoc($connection);

	$type=$rows['BloodType'];
	$quantityquery="SELECT Quantity FROM blood WHERE Name='$type'";
	$connection=mysqli_query($conn,$quantityquery);
	$row = mysqli_fetch_assoc($connection);

	$quan=$row['Quantity'];
	$updatequery="UPDATE blood SET Quantity='$quan'+'$Quantity' WHERE Name='$type'";

    $deletequery="DELETE from register WHERE CampID='$CampID'";


	if(mysqli_query($conn,$sql_query))
	{
        if(mysqli_query($conn,$deletequery)){
			if(mysqli_query($conn,$updatequery)){
	    	?>
			<script type="text/javascript">
				alert( "Donation successful !");
				window.location.href="adminhome.php";
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