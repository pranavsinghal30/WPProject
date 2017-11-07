<?php
    session_start();
    if($_SESSION['authorize']!=1)
    {
        echo $_SESSION['un'];
        echo "You aren't allowed here";
        exit;
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <title>
            Home Page
            <?php
                $db=mysql_connect("localhost","root","") or die ("error");
                $db=mysql_select_db("project1",$db) or die ("error with project1");
                $query="SELECT Name from project1.userprofile1 where UserName='".$_SESSION['un']."';";
                $result=mysql_query($query);
                $row=mysql_fetch_assoc($result);
                if($_SESSION['authorize']==1) echo '- '.$row['Name'];//$_SESSION['un'];
            ?>
        </title>
        <link rel="stylesheet" type="text/css" href="StyleHomePageFFF.css" />
        <link rel="stylesheet" type="text/css" href="CommonStyle.css" />
        <style>
            @import url('https://fonts.googleapis.com/css?family=Cabin+Condensed');
        </style>
    </head>

    <body>
        <!-- Header -->
        <div class="toolbar">
            <div id="welcome">  <!-- Prints Welcome, Name  The database is selected over here-->
                <?php           //Database is selected over here
                    $db= mysql_connect("localhost","root","","project1");
                    $uname=$_SESSION['un'];
                    $query="SELECT Name FROM project1.userprofile1 WHERE UserName='$uname'";
                    $result=mysql_query($query);
                    if(!$result)
                    {
                        print "oops";
                        exit;
                    }
                    $row=mysql_fetch_assoc($result);
                    $name=$row['Name'];
                    echo "Welcome, ".$name;
                ?>
            </div>
            <h1>
                Website Name
            </h1>
            <!-- The navigation links -->
            <nav>
                <ul>
                    <li id="current">
                        <?php
                        echo "<a href='homepage.php'>";    //?uname=$una' >";
                        echo "Home</a>";
                        ?>
                    </li>
                    <li>
                        <?php
                        echo "<a href='UserPage FFF.php'>";     //?uname=$una' >";
                        echo "Dashboard</a>";
                        ?>
                    </li>
                    <li style="float:right; margin-right:10px;">
                        <?php
                            echo "<a href='logout.php' >Sign Out</a>";
                        ?>
                    </li>
                </ul>
            </nav>
        </div>
         
        <!-- Search Box -->
        <div id="search">
            <form action="homepage.php" method= "POST">
                <p>
                    <label>
                        Search: <input id="sea" name="searc" type="text" />
                    </label>
                    <input type="submit" id="sec" value="Search" />
                </p>
            </form>
        </div>
        
        <!-- ALl the COurses -->
            <div class="courses">
                <?php
                    $db=mysql_connect("localhost","root","") or die ("error");
                    $db=mysql_select_db("project1",$db) or die ("error with project1");
                    $a=array();
                    $error="";

                    if($_SERVER['REQUEST_METHOD']=='POST')
                    {
                        $searc=strtolower($_POST["searc"]);
                        $searc=preg_replace('/\s+/','',$searc);
                        
                        if($searc!=NULL)
                        {
                            if($searc[strlen($searc)-1]=='s')
                                $searc=substr($searc,0,strlen($searc)-1);
                            $query="select * from coursedetail left join coursesearch on coursedetail.CourseId=coursesearch.CourseId where Tag1='$searc' or Tag2='$searc';";
                        } 
                        else
                            $query="select * from coursedetail order by Level; ";
                        $result=mysql_query($query);
                        if(!$result)
                        {
                            print "Something wrong";
                            exit;
                        }
                        //$a=array();
                        $row=mysql_fetch_assoc($result);
                        $num_rows=mysql_num_rows($result);
                        for($i=0;$i<$num_rows;$i++)
                        {
                            $a[]=$row['CourseId'];
                            $row=mysql_fetch_assoc($result);
                        }
                        
                        $query="select Tag2 from coursesearch where Tag1='$searc';";
                        $result=mysql_query($query);
                        $num_rows=mysql_num_rows($result);
                        for($i=0;$i<$num_rows;$i++)
                        {
                            $row=mysql_fetch_assoc($result);
                            $s=$row['Tag2'];
                            $q="select * from coursedetail left join coursesearch on coursedetail.CourseId=coursesearch.CourseId where Tag2='$s'";
                            $result1=mysql_query($q);
                            $n=mysql_num_rows($result1);
                            for($j=0;$j<$n;$j++)
                            {
                                $row1=mysql_fetch_assoc($result1);
                                $a[]=$row1['CourseId'];
                            }
                        }
                        $a=array_unique($a);
                        if(count($a)==0)
                            $error="Couldn't find any courses. Please try changing your entry";
                    }
                    if(count($a)<=0)
                    {
                        $query="SELECT * from coursedetail order by Level;";
                        $result=mysql_query($query);
                        if(!$result)
                        {
                            print "Something wrong";
                            exit;
                        }
                        $row=mysql_fetch_assoc($result);
                        $num=mysql_num_rows($result);
                        for($i=1;$i<=$num;$i++)
                        {
                            $a[]=$row['CourseId'];
                            $row=mysql_fetch_assoc($result);
                        }
                    }
                    echo '<p>'.$error.'</p>';
                    foreach($a as $p=>$id)
                    {
                        $query2="select * from coursedetail where CourseId='$id'";
                        $result=mysql_query($query2);
                        $row=mysql_fetch_assoc($result);
                        echo '<a href='.$row['Link'].'>';
                        echo '<div class="cards">'.$row['CourseName'].'</br>';
                        echo '<span style="font-size:0.7em">'.$row['Institution'].'</br>'.$row['Website'].'</br>'.$row['Difficulty'].'</br>';
                        echo '</span></div>';
                        echo '</a>';
                    }
                ?>
                <!--div class="cards">
                      Courses 1
                </div>
                <div class="cards">
                        Courses 2
                </div-->
            </div>            
    </body>            
</html>