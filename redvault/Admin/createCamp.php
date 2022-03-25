<html>
	<head>
		<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
	</head>
</html>


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

//REceive the camp details
if(isset($_POST['submit']))
echo "In Submit";
{
	$Location=$_POST['Location'];

	$CampDate=$_POST['CampDate'];

	//$DueDate=$_POST['DueDate'];

    session_start();
    $AdminID=$_SESSION['Admin'];
	
	//Query to insert the camp info into the table
	$sql_query ="INSERT INTO `camp`(`Location`, `CampDate`,EmpID)
	 VALUES ('$Location','$CampDate','$AdminID')";


	if(mysqli_query($conn,$sql_query))
	{
		//Confirm the creation and redirect to admin home
	    ?>
		<script type="text/javascript">
			/*alert( "New Camp entry successfully !");
			window.location.href="adminhome.php";*/
			swal({
                title: "New Camp added",
                icon: "success",
                button: "Okay",
            })
            .then((value) => {
                window.location.href="adminhome.php";
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
?>    