<?php
    session_unset();
    $uname = "";
    $pword = "";
    $errorMessage = "";
    if ($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        $db= mysql_connect("localhost","root","","project1");
        $uname=$_POST["user_name"];
        $pwrd=$_POST["user_pass"];
        $email=$_POST["email"];
        $flag=1;
        $q="SELECT EmailId FROM `project1`.`userinfo1` WHERE UserName='$uname'";

        $result=mysql_query($q);
        if(mysql_num_rows($result)==1)
        {
            $flag=0;
            echo "<script type='text/javascript'>alert('User name already exists');</script>";
            //exit;
        }
        /*else
        {
            echo "<script type='text/javascript'>alert('User name available');</script>";
        }
        */
        $q="SELECT EmailId FROM `project1`.`userinfo1` WHERE EmailId='".$_POST['email']."'";
        $result=mysql_query($q);
        if(mysql_num_rows($result)==1)
        {
            $flag=0;
            echo "<script type='text/javascript'>alert('Account for this email Id akready exists');</script>";
            //exit;
        }
        if($_POST['user_pass']!=$_POST['confirm'])
        {
            $flag=0;
            echo "<script type='text/javascript'>alert('The passwords do not match');</script>";
        }
        if($uname=="" || $pwrd=="" || $email=="")
        {
            $flag=0;
        }
        if($flag==1)
        {
            $q="Insert into `project1`.`userinfo1` values('".$uname."', '".$pwrd."', '".$email."');";
            $result=mysql_query($q);
            if(!$result)
            {
                echo '<br/>'.$_POST['user_name']; 
                echo '<br/>'.$_POST['user_pass'];
                echo '<br/>'.$_POST['email'];
                echo "insert error";
                exit;
            }
        }
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <title>
            Sign Up
        </title>
        <link rel="stylesheet" type="text/css" href="StyleSignInFFF1.css" />
        <style>
            @import url('https://fonts.googleapis.com/css?family=Cabin+Condensed');
         </style>
         <script type="text/javascript" src="signup.js">
         </script>
    </head>
    <body class="login">

         <!--script type="text/javascript" >
         function signup()
         {
            alert("hello");
            var dom=document.getElementById("sup").style;
            dom.display="block";
            dom.style.zIndex=10;
         }
         </script-->

        <div class="toolbar">
            <br/>
            <h1> Website Name</h1>
            <br/>
        </div>
        <!--div class="left all">
            About our website
        </div-->
        <!--div class="right all"-->
            <!-- Sign Up-->
            
        <div class="background" id="sup">
             <div class="form">

                  <form action="SignUp.php" method="POST" id='f'>
                       <input type="text" name="user_name" id="user_name" placeholder="User name" size="40" onclick="clear(id)" required/><br><br>
                       <input type="password" name="user_pass" id="user_pass" placeholder="Password" size="40" onclick="clear(id)" required/><br><br>
                       <input type="password" name="confirm" id="confirm" placeholder="Confirm password" size="40" onclick="clear(id)" required/><br><br>
                       <input type="text" name="email" id="email" placeholder="Email@email.com" size="40" onclick="clear(id)"  required /><br><br>
                       <input type="text" name="age" id="age" placeholder="Age" size="40" onclick="clear(id)" /><br><br>
                       <input type="text" name="qual" id="qual" placeholder="Recent completed qualification " size="40" onclick="clear(id)" /><br><br>
                       <input type="text" name="city" id="city" placeholder="City" size="40"/><br><br>
                       <a href="signin1.php">
                       <input type="button" name="cancel" id="cancel" value="Cancel" class="cancelbtn" /> <!--onclick="cancel();" /-->
        </a>
                       <input type="submit" value="Sign Up" class="signupbtn" /><!--onclick="submit()" class="signupbtn"/-->

                  </form>
             </div>
        <!--/div-->
    </body>
</html>
