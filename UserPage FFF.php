<?php
    session_start();
    if($_SESSION['authorize']!=1)
    {
        echo "You dont have permission to view this page";
        exit;
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <title>
            Dashboard
            <?php
                $db=mysql_connect("localhost","root","") or die ("error");
                $db=mysql_select_db("project1",$db) or die ("error with project1");
                $query="SELECT Name from project1.userprofile1 where UserName='".$_SESSION['un']."';";
                $result=mysql_query($query);
                $row=mysql_fetch_assoc($result);
                if($_SESSION['authorize']==1) echo '- '.$row['Name'];//$_SESSION['un'];
            ?>
        </title>
        <link rel="stylesheet" type="text/css" href="StyleUserPage FFF.css" />
        <link rel="stylesheet" type="text/css" href="CommonStyle.css" />
        <style>
            @import url('https://fonts.googleapis.com/css?family=Cabin+Condensed');
        </style>
    </head>
    
    <body>
        <!-- Header -->
        <div class="toolbar">
            <div id="welcome">   <!-- Prints Welcome, Name  The database is selected over here-->
                <?php
                    $una=$_SESSION['un'];
                    $db=mysql_connect("localhost","root","") or die ("error");
                    $db=mysql_select_db("project1",$db) or die ("error with project1");
                    $query="SELECT Name FROM project1.userprofile1 WHERE UserName='$una'";
                    $result=mysql_query($query);
                    if(!$result)
                    {
                        print "error in selecting Name";
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
                    <li>
                        <?php
                            echo "<a href='homepage.php'>";     //?uname=$una' >";
                            echo "Home</a>";
                        ?>
                    </li>
                    <li id="current">
                        <?php
                            echo "<a href='UserPage FFF.php'>";      //?uname=$una' >";
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
        
        <!-- User Information -->
        <div id="userstats">
            <ul>
                <?php           //Prints the user info
                    $query="SELECT * FROM userprofile1 WHERE UserName='$una'";
                    $result=mysql_query($query);  //Gives exactly one row
                    if(!$result)
                    {
                        echo "Result Unsuccesful";
                        exit;
                    }
                    $row=mysql_fetch_assoc($result);
                    //echo "<li>Name: ".$row['Name']."</li><li>Branch: ".$row['Branch']."</li><li>".$row['NumOfCourses']." Courses Completed</li><li>".$row['College'];
                    foreach($row as $key=>$value)  //Prints the user info
                    {
                        if($value!=NULL)
                        echo "<li>$key:  $value</li>";
                    }
                ?>
            </ul>
        </div>

        <!-- COURSES TAKEN-->
        <div class="c_taken">
            <h2>
                Courses Taken
            </h2>
            <ul>
                <?php
                    $query="SELECT coursedetail.CourseName,usercourses.Progress,usercourses.CourseId,coursedetail.Link FROM project1.usercourses left join project1.coursedetail on usercourses.CourseId=coursedetail.CourseId WHERE UserName='$una'";
                    $result=mysql_query($query);   //Multiple rows,  each with info about one course taken by the user
                    if(!$result)
                    {
                        echo "Result Unsuccesful";
                        exit;
                    }
                    $num_rows=mysql_num_rows($result);
                    $row=mysql_fetch_assoc($result);
                    for($i=1; $i<=$num_rows; $i++)
                    {
                        echo '<a href='.$row['Link'].'>';
                        echo "<li>".$row['CourseName']."</br>";
                        echo "<span style='font-size:0.7em;'>".$row['Progress']."% completed</span></li>";
                        echo '</a>';
                        $row=mysql_fetch_assoc($result);
                    }
                ?>
            </ul>
        </div>
        <br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
    </body>
</html>

<!--
    SELECT * FROM usercourses left join coursedetail on usercourses.CourseId=coursedetail.CourseId 
    SELECT * FROM coursedetail left join usercourses on usercourses.CourseId=coursedetail.CourseId where UserName='ABC';
    $query="SELECT coursedetail.CourseName,Progress,coursedetail.CourseId FROM `project1`.`usercourses` left join coursedetail on usercourses.CourseId=coursedetail.CourseId WHERE UserName='$una'"; 
-->