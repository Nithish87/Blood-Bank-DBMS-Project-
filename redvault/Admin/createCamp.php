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
	$Location=$_POST['Location'];

	$CampDate=$_POST['CampDate'];

	$DueDate=$_POST['DueDate'];

    session_start();
    $AdminID=$_SESSION['Admin'];
	
	$sql_query ="INSERT INTO `camp`(`Location`, `CampDate`,`DueRegistration`,EmpID)
	 VALUES ('$Location','$CampDate','$DueDate','$AdminID')";


	if(mysqli_query($conn,$sql_query))
	{
	    ?>
		<script type="text/javascript">
			alert( "New Camp entry successfully !");
			window.location.href="adminhome.php";
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