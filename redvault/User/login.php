

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <title>Document</title>
</head>
<body>
    
<?php
//include('C:\xampp\htdocs\redvault\node_modules\sweetalert\dist\sweetalert.min.js');

$host="localhost";
$user="root";
$password="";
$db="redvault";
//echo "Hello";
try{
    $conn=mysqli_connect($host, $user, $password, $db);
} 
catch(mysqli_sql_exception $e){
    echo 'Message: ' .$e->getMessage();
}
    
//echo "Checking connection";
{
    if(!$conn)
    {
        die("connection failed".mysqli_connect_error());
    }

}

//echo "Successful connection, intaking values";
if(isset($_POST['save']))
echo " Recieved";
    {
        $email=$_POST['emailID'];
        //echo " Recieved Email";
        $password=$_POST['password'];
        //echo " Recieved password";
        $sql="select * from user where Email='".$email."'AND Password='".$password."'limit 1";

        //Creating session to send user email to home page
        session_start();
        $_SESSION['email']=$email;

        $result=mysqli_query($conn,$sql);
        if(mysqli_num_rows($result)==1)
        {
            //If user authentication is successful, redirect to home page
            ?>
            <script type="text/javascript">
			   /* alert("You have successfully logged in");
               window.location.href="homepage.php";*/
               swal({
                    title: "Login successful!!",
                    icon: "success",
                    button: "Of course",
                })
                    .then((value) => {
                        window.location.href="homepage.php";
                });
			</script>
            <?php
        }
        else
        {
            //If user info is wrong
            ?>
            <script type="text/javascript">
			    /*alert("You have entered incorrect email or password");
			    window.location.href="login.html";*/
                swal({
                    title: "Incorrect email or password",
                    icon: "error",
                    button: "Retry",
                })
                    .then((value) => {
                        window.location.href="login.html";
                });
			</script>
            <?php
        }
    }?>
</body>
</html>