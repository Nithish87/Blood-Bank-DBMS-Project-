<html>
	<head>
		<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
	</head>
</html>

<?php
session_start();
$campID=$_SESSION['CampID'];
$userID=$_SESSION['UserID'];

$conn = mysqli_connect("localhost","root","","redvault");

//Query to insert registration into register table
$query="INSERT INTO register(CampID,UserID) VALUES('$campID','$userID')";
$connect=mysqli_query($conn,$query);

if($connect)
{
?>
    <script type="text/javascript">
		/*alert("Registration Successful");
		window.location.href="homepage.php";*/
		swal({
            title: "Registration Successful",
            icon: "success",
            button: "Yess!!",
        })
        .then((value) => {
            window.location.href="homepage.php";;
         });
	</script>
<?php
}else{
    ?>
    <script type="text/javascript">
		alert("Cannot Register");
		window.location.href="homepage.php";
	</script>
<?php
}
?>