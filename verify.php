<?php
    session_start();
    $_SESSION['un']=$_POST['u_name'];
    $_SESSION['pw']=$_POST['p_word'];
?>
<html>
<head>
</head>
<body>
<?php
$db= mysql_connect("localhost","root","","project1");
if(!$db)
{
    echo "Unsuccesful";
    exit(0);
}

$uname=$_POST["u_name"];
$pwrd=$_POST["p_word"];

$q="SELECT Password FROM `project1`.`userinfo1` WHERE UserName='$uname'";

$result=mysql_query($q);
if(!$result)
{
    print "lol";
    exit;
}

$row=mysql_fetch_assoc($result);
$value=$row['Password'];
if($pwrd==$value)
{
    echo "Welcome ".$uname."<br/>";
    $un=urlencode($uname);
    echo "<a href='home page FFF.php?uname=$un'> Let's Go!</a>";
}
else
{
    echo "Incorrect Password or username<br/>Try again!";
}
    //echo "User Name: ". $row["UserName"]."<br/>";
//$row=mysql_fetch_array($q);
//echo "$row['Password']";
?>
<p>
sup</p>
</body>
</html>