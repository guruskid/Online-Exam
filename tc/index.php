



 <?php

 
      error_reporting(0);
      session_start();
      include_once '../oesdb.php';

      if(isset($_REQUEST['tcsubmit']))
      {

          $result=executeQuery("select *,DECODE(tcpassword,'oespass') as tc from testconductor where tcname='".htmlspecialchars($_REQUEST['name'],ENT_QUOTES)."' and tcpassword=ENCODE('".htmlspecialchars($_REQUEST['password'],ENT_QUOTES)."','oespass')");
          if(mysql_num_rows($result)>0)
          {

              $r=mysql_fetch_array($result);
              if(strcmp(htmlspecialchars_decode($r['tc'],ENT_QUOTES),(htmlspecialchars($_REQUEST['password'],ENT_QUOTES)))==0)
              {
                  $_SESSION['tcname']=htmlspecialchars_decode($r['tcname'],ENT_QUOTES);
                  $_SESSION['tcid']=$r['tcid'];
                  unset($_GLOBALS['message']);
                  header('Location: tcwelcome.php');
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
    <title>Online Examination System</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
	<link rel="shortcut icon" href="logo1.png"  ></link>
    <link rel="stylesheet" type="text/css" href="../oes.css"/>
  </head>
  <body>
  <div id="container">
            
           <div class="header">
                <img style="margin:10px 2px 2px 20px;float:left;" height="80" width="80" src="test.png" alt="OES"/><h3 class="headtext" style="text-shadow: 2px 4px 2px #000; letter-spacing:0.1px;font-size:35px;font-family:"Times New Roman", Times, serif"> &nbsp;Online Examination System </h3><h4 style="color:#ffffff;text-align:center;margin:0 0 5px 5px;"><i>Dear stress,Let's breakup!</i></h4>
            </div>
     <form id="tcloginform" action="index.php" method="post">
      <div class="menubar">
       
       <ul id="menu">
                    <?php if(isset($_SESSION['tcname'])){
                          header('Location: tcwelcome.php');}
                         
                        ?>

                      <!--  <li><input type="submit" value="Register" name="register" class="subbtn" title="Register"/></li>-->
           <li></li>
                       
                    </ul>

      </div>
      <div class="page">
              
              <table class="logtab" cellpadding="30"  cellspacing="10">
              <tr>
              <td colspan="4"> <img src="ad.png" alt="OES" width="89" height="80" align="absmiddle"  /></td>
               </tr><tr>
                  <td><font style="font-family:cursive;" >TC Name</font></td>
                  <td><input style="border-radius:4px;width:150px;height:20px;" type="text" tabindex="1" name="name" value="" size="16" /></td>

              </tr>
              <tr>
                  <td><font style="font-family:cursive;" >Password</font></td>
                  <td><input style="border-radius:4px;width:150px;height:20px;" type="password" tabindex="2" name="password" value="" size="16" /></td>
              </tr>

              <tr>
                  <td colspan="2">
                      <p>
                        <input style="margin-left:190px" type="submit" tabindex="3" value="Log In" name="tcsubmit" class="subbtn" />
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


      </div>
       </form>

     <div id="footer">
           <p style="font-size:70%;color:#ffffff;"> Developed By-<b>CSDT Students</b><br/> </p><p>Copyright 2016 <a href="https://www.csdtitsolution.in">csdtitsolution.in</a></p>   
    </div>
      </div>
  </body>
</html>
