

 <?php

      error_reporting(0);
      session_start();
      include_once '../oesdb.php';

      if(isset($_REQUEST['admsubmit']))
      {
          
          $result=executeQuery("select * from adminlogin where admname='".htmlspecialchars($_REQUEST['name'],ENT_QUOTES)."' and admpassword='".md5(htmlspecialchars($_REQUEST['password'],ENT_QUOTES))."'");
        
         // $result=mysql_query("select * from adminlogin where admname='".htmlspecialchars($_REQUEST['name'])."' and admpassword='".md5(htmlspecialchars($_REQUEST['password']))."'");
          if(mysql_num_rows($result)>0)
          {
              
              $r=mysql_fetch_array($result);
              if(strcmp($r['admpassword'],md5(htmlspecialchars($_REQUEST['password'],ENT_QUOTES)))==0)
              {
                  $_SESSION['admname']=htmlspecialchars_decode($r['admname'],ENT_QUOTES);
                  unset($_GLOBALS['message']);
                  header('Location: admwelcome.php');
              }else
          {
             $_GLOBALS['message']="Check Your user name and Password.";
                 
          }

          }
          else
          {
              $_GLOBALS['message']="Check Your user name and Password.";
              
          }
          closedb();
      }
 ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
  <head>
    <title>Administrator Login</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
	<link rel="shortcut icon" href="logo1.png"  ></link>
    <link rel="stylesheet" type="text/css" href="../oes.css"/>
  </head>
  <body>
<!--
*********************** Step 1 ****************************
-->
<div id="container">
          <div class="header">
                <img style="margin:10px 2px 2px 20px;float:left;" height="80" width="80" src="test.png" alt="OES"/><h3 class="headtext" style="text-shadow: 2px 4px 2px #000; letter-spacing:0.1px;font-size:35px;font-family:"Times New Roman", Times, serif"> &nbsp;Online Examination System </h3><h4 style="color:#ffffff;text-align:center;margin:0 0 5px 5px;"><i>Dear stress,Let's breakup!</i></h4>
            </div>
      <div class="menubar">
        &nbsp;
      </div>
      <div class="page">
              <form id="indexform" action="index.php" method="post">
              <table class="logtab"cellpadding="30" cellspacing="10">
              <tr>
                <td colspan="4"> <img src="ad.png" alt="OES" width="95" height="92" align="absmiddle"  /></td> 
      </tr>
              <tr>
                  <td><font style="font-family:cursive;" >Admin Name</font></td>
                  <td><input style="border-radius:4px;width:150px;height:20px;" type="text" name="name" value="" size="16" /></td>

              </tr>
              <tr>
                  <td><font style="font-family:cursive;" > Password</font></td>
                  <td><input style="border-radius:4px;width:150px;height:20px;" type="password" name="password" value="" size="16" /></td>
              </tr>

              <tr>
                  <td colspan="2">
                      <p>
                        <input style="margin-left:200px" type="submit" value="Log In" name="admsubmit" class="subbtn" />
                      </p>
                      <?php
      
        if(isset($_GLOBALS['message']))
        {
         echo "<div class=\"msg\">".$_GLOBALS['message']."</div>";
        }
      ?>
                  </td><td></td>
              </tr>
            </table>

        </form>

      </div>

      <div id="footer">
           <p style="font-size:70%;color:#ffffff;"> Developed By-<b>CSDT Students</b><br/> </p><p>Copyright 2016 <a href="https://www.csdtitsolution.in">csdtitsolution.in</a></p>   
    </div>
  </body>
</html>
