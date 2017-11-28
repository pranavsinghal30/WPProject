<?php
    session_unset();
    $uname = "";
    $pword = "";
    $errorMessage = "";
    if ($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        //$db= mysql_connect("localhost","root","","project1");
        
        $db=mysql_connect("localhost","root","") or die ("error");
        $db=mysql_select_db("project1",$db) or die ("error with project1");
        $uname=$_POST["u_name"];
        $pwrd=$_POST["p_word"];

        $q="SELECT Password FROM `project1`.`userinfo1` WHERE UserName='$uname'";

        $result=mysql_query($q);
        $row=mysql_fetch_assoc($result);
        $value=$row['Password'];
        if(!$result or mysql_num_rows($result)==0 or $pwrd!=$value)
        {
            $errorMessage = "*Incorrect username or password. Try again";
            session_start();
            $_SESSION['authorize'] = 0;
        }
        else if($pwrd==$value)
        {
            session_start();
            $_SESSION['un']=$uname;
            $_SESSION['authorize'] = 1;
            header("Location: homepage1.php");
        }
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <title>
            Sign In
        </title>
        <link rel="stylesheet" type="text/css" href="StyleSignInFFF.css" />
        <style>
            @import url('https://fonts.googleapis.com/css?family=Cabin+Condensed');
         </style>
    </head>
    <body class="login">
        <div class="toolbar">
            <br/>
            <h1> Website Name</h1>
            <br/>
        </div>
        <div class="left all">
            About our website
        </div>
        <div class="right all">
            <!-- Sign In-->
            <form id="f1" action="SignIn1.php" method="POST">
                <div>
                    <ul>
                        <li>
                            Sign In
                        </li>
                        <li>
                            <input type="text" id="user_name" name="u_name" placeholder="User Name" value="<?php print $uname;?>" />
                        </li>
                        <li>
                            <input type="password" id="password" name="p_word" placeholder="Password"  />
                        </li>
                        <?php
                            echo '<li style="text-align:right; font-size:.5em; color:red;">'.$errorMessage.'</li>';
                        ?>
                        <li>
                            <input type="submit" id="sign_in" name="s_in" value="Sign In" />
                        </li>
                        
                    </ul>
                    <br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
                        
                </div>
            </form>
        </div>
    </body>
</html>