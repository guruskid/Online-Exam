


<?php

error_reporting(0);
session_start();
include_once '../oesdb.php';

if(!isset($_SESSION['tcname'])) {
    $_GLOBALS['message']="Session Timeout.Click here to <a href=\"index.php\">Re-LogIn</a>";
}
else if(isset($_REQUEST['logout']))
{
   
    unset($_SESSION['tcname']);
    header('Location: index.php');

}
else if(isset($_REQUEST['dashboard'])){
    
       
     header('Location: tcwelcome.php');

    }else if(isset($_REQUEST['savem']))
{
     
        
   $res=executeQuery("select emailid from testconductor where emailid='".htmlspecialchars($_REQUEST['email'],ENT_QUOTES)."';");
    if(empty ($_REQUEST['password'])||empty ($_REQUEST['email'])||empty ($_REQUEST['city'])||empty ($_REQUEST['address'])||empty ($_REQUEST['pin']))
    {
         $_GLOBALS['message']="All Fields Are Required.";
    }
	/*else if((strcmp(htmlspecialchars_decode($r['stdname'],ENT_QUOTES),(htmlspecialchars($_REQUEST['cname'],ENT_QUOTES)))!=0) && (mysql_num_rows($result)>0))
    {
        $_GLOBALS['message']="Username Already Exists.";
    }*/
	
	//else if(mysql_num_rows($result)!1
	else if(strlen($_REQUEST['contactno'])!=10)
	{
		 $_GLOBALS['message']="Invalid Mobile No.";
		}
		
		else if(strlen($_REQUEST['pin'])!=6)
	{
		 $_GLOBALS['message']="Invalid Pincode.";
		}
	
    else
    {
     $query="update testconductor set  tcpassword=ENCODE('".htmlspecialchars($_REQUEST['password'],ENT_QUOTES)."','oespass'),emailid='".htmlspecialchars($_REQUEST['email'],ENT_QUOTES)."',contactno='".htmlspecialchars($_REQUEST['contactno'],ENT_QUOTES)."',address='".htmlspecialchars($_REQUEST['address'],ENT_QUOTES)."',city='".htmlspecialchars($_REQUEST['city'],ENT_QUOTES)."',pincode='".htmlspecialchars($_REQUEST['pin'],ENT_QUOTES)."' where tcid='".$_REQUEST['tc']."';";
     if(!@executeQuery($query))
	 {
		 
		  if(mysql_num_rows($res)>0)
		  {
			   $_GLOBALS['message']="Email Already Exists.";
		  }
			  
		else	  
        $_GLOBALS['message']=mysql_error();
	 }
     else
        $_GLOBALS['message']="Your Profile is Successfully Updated.";
    }
    closedb();

}


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
  <head>
    <title>OES-Edit Profile</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
	<link rel="shortcut icon" href="logo1.png"  ></link>
    <link rel="stylesheet" type="text/css" href="../oes.css"/>
    <script type="text/javascript" src="../validate.js" ></script>
    </head>
  <body >
     
      <div id="container">
     <div class="header">
                <img style="margin:10px 2px 2px 20px;float:left;" height="80" width="80" src="test.png" alt="OES"/><h3 class="headtext" style="text-shadow: 2px 4px 2px #000; letter-spacing:0.1px;font-size:35px;font-family:"Times New Roman", Times, serif"> &nbsp;Online Examination System </h3><h4 style="color:#ffffff;text-align:center;margin:0 0 5px 5px;"><i>Dear stress,Let's breakup!</i></h4>
            </div>
           <form id="editprofile" action="editprofile.php" method="post">
          <div class="menubar">
               <ul id="menu">
                        <?php if(isset($_SESSION['tcname'])) {
                         // Navigations
                         ?>
                        <li><input type="submit" value="LogOut" name="logout" class="subbtn" title="Log Out"/></li>
                        <li><input type="submit" value="DashBoard" name="dashboard" class="subbtn" title="Dash Board"/></li>
                        <li><input type="submit" value="Save" name="savem" class="subbtn" onclick="validateform('editprofile')" title="Save the changes"/></li>
                     
               </ul>
          </div>
      <div class="page">
          <?php
                       
 
                        $result=executeQuery("select tcid,tcname,DECODE(tcpassword,'oespass') as tcpass ,emailid,contactno,address,city,pincode from testconductor where tcname='".$_SESSION['tcname']."';");
                        if(mysql_num_rows($result)==0) {
                           header('Location: tcwelcome.php');
                        }
                        else if($r=mysql_fetch_array($result))
                        {
                          
                 ?>
           <table class="tablog"cellpadding="20" cellspacing="20" style="text-align:left;margin-left:25em" ><tr><td colspan="2">
           <?php

        if($_GLOBALS['message']) {
            echo "<div class=\"meesg\">".$_GLOBALS['message']."</div>";
        }
        ?></td></tr>
              <tr>
                  <td><font style="font-family:cursive;" >User Name</font></td>
                  <td><input style="border-radius:4px;width:220px;height:20px;" type="text" name="cname" value="<?php echo htmlspecialchars_decode($r['tcname'],ENT_QUOTES); ?>" size="16" onkeyup="isalphanum(this)"disabled/></td>

              </tr>

                      <tr>
                  <td><font style="font-family:cursive;" >Password</font></td>
                  <td><input style="border-radius:4px;width:220px;height:20px;" type="password" name="password" value="<?php echo htmlspecialchars_decode($r['tcpass'],ENT_QUOTES); ?>" size="16" onkeyup="isalphanum(this)" /></td>
                 
              </tr>

              <tr>
                  <td><font style="font-family:cursive;" >E-mail ID</font></td>
                  <td><input style="border-radius:4px;width:220px;height:20px;" type="text" name="email" value="<?php echo htmlspecialchars_decode($r['emailid'],ENT_QUOTES); ?>" size="16" /></td>
              </tr>
                       <tr>
                  <td><font style="font-family:cursive;" >Contact No</font></td>
                  <td><input style="border-radius:4px;width:220px;height:20px;" type="text" name="contactno" value="<?php echo htmlspecialchars_decode($r['contactno'],ENT_QUOTES); ?>" size="16" onkeyup="isnum(this)"/></td>
              </tr>

                  <tr>
                  <td><font style="font-family:cursive;" >Address</font></td>
                  <td><textarea style="border-radius:4px;width:220px;height:60px;" name="address" cols="20" rows="4"><?php echo htmlspecialchars_decode($r['address'],ENT_QUOTES); ?></textarea></td>
              </tr>
                       <tr>
                  <td><font style="font-family:cursive;" >City</font></td>
                  <td><input style="border-radius:4px;width:220px;height:20px;" type="text" name="city" value="<?php echo htmlspecialchars_decode($r['city'],ENT_QUOTES); ?>" size="16" onkeyup="isalpha(this)"/></td>
              </tr>
                       <tr>
                  <td><font style="font-family:cursive;" >PIN Code</font></td>
                  <td><input style="border-radius:4px;width:220px;height:20px;" type="hidden" name="tc" value="<?php echo $r['tcid']; ?>"/><input style="border-radius:4px;width:220px;height:20px;" type="text" name="pin" value="<?php echo htmlspecialchars_decode($r['pincode'],ENT_QUOTES); ?>" size="16" onkeyup="isnum(this)" /></td>
              </tr>

            </table>
<?php
                        closedb();
                        }
                        
                        }
  ?>
      </div>

           </form>
      <div id="footer">
           <p style="font-size:70%;color:#ffffff;"> Developed By-<b>CSDT Students</b><br/> </p><p>Copyright 2016 <a href="https://www.csdtitsolution.in">csdtitsolution.in</a></p>   
    </div>
      </div>
  </body>
</html>

