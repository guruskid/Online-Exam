

<?php


error_reporting(0);
session_start();
        if(!isset($_SESSION['stdname'])){
            $_GLOBALS['message']="Session Timeout.Click here to <a href=\"index.php\">Re-LogIn</a>";
        }
        else if(isset($_REQUEST['logout'])){
                unset($_SESSION['stdname']);
            $_GLOBALS['message']="You are Loggged Out Successfully.";
            header('Location: index.php');
        }
?>
<html>
    <head>
        <title>OES-DashBoard</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
		<link rel="shortcut icon" href="images/logo1.png"  ></link>
        <link rel="stylesheet" type="text/css" href="oes.css"/>
    </head>
    <body>
        <?php
       
        if($_GLOBALS['message']) {
            echo "<div class=\"message\">".$_GLOBALS['message']."</div>";
        }
        ?>
        <div id="container">
           <div class="header">
                <img style="margin:10px 2px 2px 20px;float:left;" height="80" width="80" src="images/test.png" alt="OES"/><h3 class="headtext" style="text-shadow: 2px 4px 2px #000; letter-spacing:0.1px;font-size:35px;font-family:"Times New Roman", Times, serif"> &nbsp;Online Examination System </h3><h4 style="color:#ffffff;text-align:center;margin:0 0 5px 5px;"><i>Dear stress,Let's breakup!</i></h4>
            </div>
            <div class="menubar">

                <form name="stdwelcome" action="stdwelcome.php" method="post">
                    <ul id="menu">
                        <?php if(isset($_SESSION['stdname'])){ ?>
                        <li><input type="submit" value="LogOut" name="logout" class="subbtn" title="Log Out"/></li>
                        <?php } ?>
                    </ul>
                </form>
            </div>
            <div class="stdpage">
                <?php if(isset($_SESSION['stdname'])){ ?>

        
                <img height="600" width="100%" alt="back" src="images/trans.png" class="btmimg" />
                <div class="topimg">
                    <p><img height="500" width="600" style="border:none;"  src="images/stdwelcome.jpg" alt="image"  usemap="#oesnav" /></p>

                    <map name="oesnav">
                        <area shape="circle" coords="155,124,55" href="viewresult.php" alt="View Results" title="Click to View Results" />
                        <area shape="circle" coords="457,118,55" href="stdtest.php" alt="Take a New Test" title="Take a New Test" />
                        <area shape="circle" coords="303,251,55" href="editprofile.php?edit=edit" alt="Edit Your Profile" title="Click this to Edit Your Profile." />
                        <area shape="circle" coords="150,379,62" href="practicetest.php" alt="Practice Test" title="Click to take a Practice Test" />
                        <area shape="circle" coords="451,376,61" href="resumetest.php" alt="Resume Test" title="Click this to Resume Your Pending Tests." />
                    </map>
                </div>
                <?php }?>

            </div>

           <div id="footer">
           <p style="font-size:70%;color:#ffffff;"> Developed By-<b>CSDT Students</b><br/> </p><p>Copyright 2016 <a href="https://www.csdtitsolution.in">csdtitsolution.in</a></p>   
    </div>
  </body>
</html>
