

<?php

error_reporting(0);
session_start();
include_once 'oesdb.php';

if(isset($_REQUEST['stdsubmit']))
{
     $result=executeQuery("select max(stdid) as std from student");
     $r=mysql_fetch_array($result);
     if(is_null($r['std']))
     $newstd=1;
     else
     $newstd=$r['std']+1;

     $result=executeQuery("select stdname as std from student where stdname='".htmlspecialchars($_REQUEST['cname'],ENT_QUOTES)."';");
	 $res=executeQuery("select emailid from student where emailid='".htmlspecialchars($_REQUEST['email'],ENT_QUOTES)."';");

    // $_GLOBALS['message']=$newstd;
    if(empty($_REQUEST['cname'])||empty ($_REQUEST['password'])||empty ($_REQUEST['email']))
    {
         $_GLOBALS['message']="All Fields Are Required.";
    }else if(mysql_num_rows($result)>0)
    {
        $_GLOBALS['message']="Username Already Exists.";
    }else if(strlen($_REQUEST['contactno'])!=10)
	{
		 $_GLOBALS['message']="Invalid Mobile No.";
		}
		else if(mysql_num_rows($res)>0)
		{
			$_GLOBALS['message']="Email already used.";
		}
		else if(strlen($_REQUEST['pin'])!=6)
	{
		 $_GLOBALS['message']="Invalid Pincode.";
		}
	
    else
    {
     $query="insert into student values($newstd,'".htmlspecialchars($_REQUEST['cname'],ENT_QUOTES)."',ENCODE('".htmlspecialchars($_REQUEST['password'],ENT_QUOTES)."','oespass'),'".htmlspecialchars($_REQUEST['email'],ENT_QUOTES)."','".htmlspecialchars($_REQUEST['contactno'],ENT_QUOTES)."','".htmlspecialchars($_REQUEST['address'],ENT_QUOTES)."','".htmlspecialchars($_REQUEST['city'],ENT_QUOTES)."','".htmlspecialchars($_REQUEST['pin'],ENT_QUOTES)."','pending')";
     if(!@executeQuery($query))
                $_GLOBALS['message']=mysql_error();
     else
     {
        $success=true;
        $_GLOBALS['message']="Successfully Your Account is Created.Click <a href=\"index.php\">Here</a> to LogIn";
       // header('Location: index.php');
     }
    }
    closedb();
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
  <head>
    <title>OES-Registration</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
	<link rel="shortcut icon" href="images/logo1.png"  ></link>
    <link rel="stylesheet" type="text/css" href="oes.css"/>
    <script type="text/javascript" src="validate.js" ></script>
    </head>
  <body >
  <div id="container">
    <div class="header">
                <img style="margin:10px 2px 2px 20px;float:left;" height="80" width="80" src="images/test.png" alt="OES"/><h3 class="headtext" style="text-shadow: 2px 4px 2px #000; letter-spacing:0.1px;font-size:35px;font-family:"Times New Roman", Times, serif"> &nbsp;Online Examination System </h3><h4 style="color:#ffffff;text-align:center;margin:0 0 5px 5px;"><i>Dear stress,Let's breakup!</i></h4>
            </div>
          <div class="menubar">
             
           <ul id="menu">
            <lt><div class="aclass"><a href="index.php" title="Go Back To Homepage">Back</a></div></lt>
                    <?php if(!$success): ?>

             
             
                      <!--  <li><input type="submit" value="Register" name="register" class="subbtn" title="Register"/></li>-->
          
                      <?php endif; ?>   
        </ul>
                      
        </ul>
          </div>
      <div class="page">
          <?php
          if($success)
          {
                echo "<h2 style=\"text-align:center;color:#0000ff;\">Thank You For Registering with Online Examination System.<br/><a href=\"index.php\">Login Now</a></h2>";
          }
          else
          {
          ?>
          <form id="admloginform"  action="register.php" method="post" onsubmit="return validateform('admloginform');">
                   <table class="regtab"cellpadding="25" cellspacing="18" style="text-align:left;margin-left:25em" ><tr><td colspan="2"> <?php

        if($_GLOBALS['message']) {
            echo "<div class=\"mesg\">".$_GLOBALS['message']."</div>";
        }
        ?></td></tr>
              <tr>
                  <td width="109"><font style="font-family:cursive;" >User Name</font></td>
                  <td width="229"><input style="border-radius:4px;width:220px;height:20px;" type="text" name="cname" value="<?php if(isset($_POST['cname'])){echo htmlentities($_POST['cname']);}?>" size="16" placeholder="Your Username." onkeyup="isalpha(this)"/>
                 </td>

              </tr>

                      <tr>
                  <td><font style="font-family:cursive;" >Password</font></td>
                  <td><input style="border-radius:4px;width:220px;height:20px;" type="password" name="password" value="<?php if(isset($_POST['password'])){echo htmlentities($_POST['password']);}?>" size="16" placeholder="Your Password." onkeyup="isalphanum(this)" /></td>

              </tr>
                      <tr>
                  <td><font style="font-family:cursive;" >Retype Password</font></td>
                  <td><input style="border-radius:4px;width:220px;height:20px;" type="password" name="repass" value="<?php if(isset($_POST['repass'])){echo htmlentities($_POST['repass']);}?>" size="16" placeholder="Confirm Password." onkeyup="isalphanum(this)" /></td>

              </tr>
              <tr>
                  <td><font style="font-family:cursive;" >E-mail ID</font></td>
                  <td><input style="border-radius:4px;width:220px;height:20px;" type="text" name="email" value="<?php if(isset($_POST['email'])){echo htmlentities($_POST['email']);}?>" size="16" placeholder="Your Email." /></td>
              </tr>
                       <tr>
                  <td><font style="font-family:cursive;" >Contact No</font></td>
                  <td><input style="border-radius:4px;width:220px;height:20px;" type="text" name="contactno" value="<?php if(isset($_POST['contactno'])){echo htmlentities($_POST['contactno']);}?>" size="16"placeholder="Your Mobile No." onkeyup="isnum(this)"/></td>
              </tr>

                  <tr>
                  <td><font style="font-family:cursive;" >Address</font></td>
                  <td><textarea style="border-radius:4px;width:220px;height:40px;" placeholder="Your Address" name="address" cols="20" rows="3"><?php if(isset($_POST['address'])){echo htmlentities($_POST['address']);}?></textarea></td>
              </tr>
                       <tr>
                  <td><font style="font-family:cursive;" >City</font></td>
                  <td><input style="border-radius:4px;width:220px;height:20px;" type="text" name="city" value="<?php if(isset($_POST['city'])){echo htmlentities($_POST['city']);}?>" size="16" placeholder="Your City." onkeyup="isalpha(this)"/></td>
              </tr>
                       <tr>
                  <td><font style="font-family:cursive;" >PIN Code</font></td>
                  <td><input style="border-radius:4px;width:220px;height:20px;" type="text" name="pin" value="<?php if(isset($_POST['pin'])){echo htmlentities($_POST['pin']);}?>" size="16" placeholder="Your Pincode." onkeyup="isnum(this)" /></td>
              </tr>
                       <tr style="margin-left:100px;">
                           <td  style="text-align:right;"></td>
                           <td style="text-align:center;"><input type="submit" name="stdsubmit" value="Register" class="subbtn" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="reset" name="reset" value="Reset" class="subbtn" /></td>
                
              </tr>
              <tr> <td colspan="2" ><font color="#FF0000">*</font> <font style="font-style:italic" size="-1">All Fields are Mandatory</font></td>
              </tr>
            </table>
        </form>
       <?php } ?>
      </div>
<div id="footer">
           <p style="font-size:70%;color:#ffffff;"> Developed By-<b>CSDT Students</b><br/> </p><p>Copyright 2016 <a href="https://www.csdtitsolution.in">csdtitsolution.in</a></p>   
    </div>
  </body>
</html>

