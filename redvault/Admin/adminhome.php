<?php
session_start();
//Receive admin email from login page
$emailID=$_SESSION['email'];
//echo $emailID;

date_default_timezone_set('Asia/Kolkata');
$date=date('y-m-d');
//echo $date;

$conn = mysqli_connect("localhost","root","","redvault");


if(!$conn)
{
    echo "Error";
}
/*
if(isset($_GET['CampID'])){
    $CampID=$_GET['CampID'];
}*/

//Query for available camps
$availablequery = "SELECT * FROM `camp` WHERE CampID not in(select CampID from register where UserID='$emailID') AND CampDate>'$date'";
$connect = mysqli_query($conn,$availablequery);

//Query to display today's camps
$todayquery="SELECT * FROM camp where CampDate='$date'";
$connectT = mysqli_query($conn,$todayquery);

//Query for total donations
$donutchartquery="SELECT * FROM blood";
$connectC=mysqli_query($conn,$donutchartquery);

//Query to get first name of admin
$welcomequery="SELECT * FROM admin WHERE Email='$emailID'";
$connectW=mysqli_query($conn,$welcomequery);

?>

<!DOCTYPE html>
<html>
    <head>
        <title> Admin Homepage</title>
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;600&display=swap" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="../User/stylehome.css">
        <script src="https://kit.fontawesome.com/6e9ba28a08.js" crossorigin="anonymous"></script>
        <link href="https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@300&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=PT+Serif:ital,wght@1,700&display=swap" rel="stylesheet">
    
        <!--Donut chart-->
        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
        <script type="text/javascript" src="../User/scripthome.js"></script>

        <style>
            .fa-plus-circle{
                color: white;
                size: 7px;
            }

            .create{
                background-color: darkblue;
                color: white;
                width: 6%;
                padding: 10px;
                border-radius: 20px;
                margin-left: 75%;
            }
            .create:hover{
                background-color: black;
            }
            /*
            .fa-file-medical{
                color: white;
            }
            .report{
                background-color: darkblue;
                color: white;
                width: 10%;
                padding: 10px;
                border-radius: 20px;
                margin-left: 70%;
            }
            .report:hover{
                background-color: black;
            }*/
        </style>
    

    </head>

    <body>
        <div class="header">
            <img src="../Images/blood donation logo.png" height="80" width="100">
            <div class="inner_header">
                <div class="logo_container">
                    <h1>RED<span id="s1">VAULT</span><span id="s2">  Blood Bank</span></h1>
                    
                </div>

                <ul class="navigation">
                  <!--Logout button-->
                  <a href="loginAdmin.html"><li><i class="fas fa-sign-out-alt"></i></li></a>
                  <!--Moves to about us section-->
                  <a href="#about_us"><li>About Us</li></a>  
                </ul>
            </div>
        </div>
        
        <!--Slideshow of images-->
        <div class="slideImages"></div>

        <!--Side bar-->
        <div class="wrapper">
            <div class="sidebar">
                <!--<h2>Menu</h2>-->
                <ul>
                <?php //session_start();
                        $_SESSION['email']=$emailID;
                ?>
                    <!--Goes to admin profile-->
                    <li><a href="profileAdmin.php"><i class="fas fa-user"></i>Profile</a></li>
                    <!--Goes to today's camps table-->
                    <li><a href="#registered_head"><i class="far fa-check-circle"></i> Today's Camps</a></li>
                    <!--Goes to upcoming camps table-->
                    <li><a href="#available_head"><i class="fas fa-door-open"></i>Upcoming Camps</a></li>
                    <!--<li><a href="#past_head"><i class="fas fa-history"></i>Past Donations</a></li>-->
                    <!--Goes to total donations table-->
                    <li><a href="#chart_head"><i class="fas fa-archive"></i>Blood Bank</a></li>
                    <!--Button to page to confirming donations-->
                    <li><a href="donations.php"><i class="fas fa-file-medical"></i>Confirm Donations</a><li>
                </ul>
                
            </div>

            <div class="main_content">
                <!--HEllo-->
                <div class="head"><h4>Hello <?php $rows = mysqli_fetch_assoc($connectW);
                echo $rows['FirstName'];?></h4></div>
                <div class="info">
                    <!--Registered Info to be displayed-->
                    <br>
                    <div id="registered_head" class="registered_head"><h4>Today's Camps</h4></div>
                    <br>
                    <div class="registered_info">
                        <table>
                            <thead>
                                <tr>
                                    <th>CampID</th>
                                    <th>Date</th>
                                    <th>Location</th>
                                    <th>No. of Registrations</th>
                                </tr>
                            </thead>
                            <?php
                                while($rows = mysqli_fetch_assoc($connectT)){
                                    $no=$rows['CampID'];
                            ?>
                            <tbody>
                                <tr>
                                    <td><?php echo $rows['CampID'];   ?></td>
                                    <td><?php echo $rows['CampDate']; ?></td>
                                    <td><?php echo $rows['Location']; ?></td>
                                    <?php
                                        //Query to display the no.of registrations for today's camps
                                        $registrationquery="SELECT count(*) from register WHERE CampID='$no'";
                                        $connectRe=mysqli_query($conn,$registrationquery);
                                        $rowsR = mysqli_fetch_assoc($connectRe);
                                    ?>
                                    <td><?php echo $rowsR['count(*)']; ?></td>
                                </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                            
                        </table>
                    </div>

                    <!--Camps info table-->
                    <br>
                    <div id="available_head" class="available_head"><h4>Upcoming Camps</h4></div>
                    <br>
                    <div class="available_info">
                        <table>
                            <thead>
                                <tr>
                                    <th>CampID</th>
                                    <th>Date</th>
                                    <th>Location</th>
                                    <!--<th>Due for registration</th>-->
                                    <th>No.of Registrations</th>
                                </tr>
                            </thead>
                            <?php
                                while($rows = mysqli_fetch_assoc($connect)){
                                    $no=$rows['CampID'];
                            ?>
                            <tbody>
                                <tr>
                                    <td><?php echo $rows['CampID'];   ?></td>
                                    <td><?php echo $rows['CampDate']; ?></td>
                                    <td><?php echo $rows['Location']; ?></td>
                                    <?php
                                        //Query to dispaly registrations to upcoming camps
                                        $registrationquery="SELECT count(*) from register WHERE CampID='$no'";
                                        $connectRe=mysqli_query($conn,$registrationquery);
                                        $rowsR = mysqli_fetch_assoc($connectRe);
                                    ?>
                                    <td><?php echo $rowsR['count(*)']; ?></td>
                                </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <br>
                <div class="create">
                    <?php
                        $_SESSION['Admin']=$emailID;
                    ?>
                    <!--Button to create camps-->
                    <a href="create.php"><i class="fas fa-plus-circle"></i></a><b> Create</b>
                </div>
                
                <br>
                <!--Total donations-->
                <div class="blood_info">
                <br>
                <div id="chart_head" class="chart_head"><h4>Our Achievements</h4></div>
                <br>
                
                
                    <table>
                        <thead>
                            <tr>
                                <th>Type</th>
                                <th>Quantity(L)</th>
                            </tr>
                        </thead>
                        <?php
                            while($rows = mysqli_fetch_assoc($connectC)){
                        ?>
                        <tbody>
                            <tr>
                                <td><?php echo $rows['Name']; ?></td>
                                <td><?php echo $rows['Quantity']; ?></td>
                            </tr>
                        <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
                <!--<div id="donutchart" style="width: 900px; height: 500px;"></div>-->

            </div>

            
        </div>

        <!--About Section-->
        <br>
        <footer>
            <div id="about_us" class="about_us">
                <h3>About Us</h3>
                <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Ea odit excepturi quidem enim commodi minima tempore, tempora deserunt quos unde natus ducimus cum, ad at pariatur voluptatem? Provident, qui quis.</p>
                <ul class="socials">
                    <li><a href="https://facebook.com"><i class="fab fa-facebook-f"></i></a></li>
                    <li><a href="https://twitter.com"><i class="fab fa-twitter"></i></a></li>
                    <li><a href="https://instagram.com"><i class="fab fa-instagram"></i></a></li>
                </ul>
            </div>
            <div class="footer-bottom">
                <p>copyright &copy;2022 RedVault</p>
            </div>
        </footer>

        
    </body>

</html>                                                                                         
