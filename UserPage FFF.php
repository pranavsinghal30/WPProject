<?php
    session_start();
    if(!isset($_SESSION['authorize']) && $_SESSION['authorize']!=1)
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

        <link rel="stylesheet" type="text/css" href="CommonStyle.css" />
        <link rel="stylesheet" type="text/css" href="StyleUserPage FFF.css" />
        <style>
            @import url('https://fonts.googleapis.com/css?family=Cabin+Condensed');
        </style>
        <script type="text/javascript" src="compare.js"></script>
        <!--script type="text/javascript">
            function infoo(id)
            {
                document.getElementById(id).style.visibility="visible";
            }
        </script-->
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

                    echo $name;

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
                            echo "<a href='homepage1.php'>";     //?uname=$una' >";
                            echo "Home</a>";
                        ?>
                    </li>
                    <li id="current">
                        <?php
                            echo "<a href='UserPage FFF.php'>";      //?uname=$una' >";
                            echo "Dashboard</a>";
                        ?>
                    </li>

                    <li style="float:left; position:relative;leFt:980px;">

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

                    $a=array();
                    $count=0;

                    $num_rows=mysql_num_rows($result);
                    $row=mysql_fetch_assoc($result);
                    for($i=1; $i<=$num_rows; $i++)
                    {

                        //echo '<a href='.$row['Link'].'>';
                        //echo "<li>".$row['CourseName']."</br>";
                        //echo "<span style='font-size:0.7em;'>".$row['Progress']."% completed</span></li>";
                        //echo '</a>';
                        $a[]=$row['CourseId'];
                        $row=mysql_fetch_assoc($result);
                    }
                    $a=array_unique($a);
                    $count=count($a);
                    foreach($a as $key=>$id)
                    {
                        $query="SELECT CourseId from coursesearch where Tag2=(SELECT Tag2 from coursesearch where CourseId='$id')";
                        $result=mysql_query($query);
                        $num_rows=mysql_num_rows($result);
                        for($i=0;$i<$num_rows;$i++)
                        {
                            $row=mysql_fetch_assoc($result);
                            $a[]=$row['CourseId'];
                        }
                    }
                    $a=array_unique($a);
                    $i=0;
                    if(count($a)!=0)
                    {
                        //echo '<br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>';
                        echo '<form action="comparison.php" method="POST">';
                        foreach($a as $key=>$id)
                        {   
                            //echo $i;
                            /*
                            $query="SELECT * from coursedetail where CourseId='$id'";
                            $result=mysql_query($query);
                            $row=mysql_fetch_assoc($result);
                            */
                            if($i<$count)
                            {
                                $query="SELECT coursedetail.CourseName,usercourses.Progress,usercourses.CourseId,coursedetail.Link FROM project1.usercourses left join project1.coursedetail on usercourses.CourseId=coursedetail.CourseId WHERE UserName='$una'";
                                $result=mysql_query($query);
                                $row=mysql_fetch_assoc($result);
                                echo '<li id="'.$row["CourseId"].'">'.$row['CourseName'].'</br>';
                                echo "<span style='font-size:0.7em;'>".$row['Progress']."% completed</span></li>";
                            }
                            else if($i==$count)
                            {
                                echo '<br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>';
                                if($count%2!=0 && $count>2)
                                {
                                    for($x=1;$x<=2-$count%2;$x++)
                                    echo '<li style="visibility:hidden;" ></li>';
                                    for($x=1;$x<($count+1)/2;$x++)
                                    echo '<br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>';
                                }
                                echo '<h3>Related Courses</h3>';
                                //print_r($a);
                                //exit;
                            }
                            /*
                            echo "<li>".$row['CourseName']."</br>";
                            echo "<span style='font-size:0.7em;'>".$row['Institution']."</span></li>";
                            */
                            else
                            {
                                $query="SELECT * from coursedetail where CourseId='$id'";
                                $result=mysql_query($query);
                                $row=mysql_fetch_assoc($result);
                                echo '<li id="'.$row["CourseId"].'">';
                                echo $row['CourseName'].'</br>';
                                echo '<span style="font-size:0.7em;">'.$row['Institution'].'</br>';
                                echo '<a href='.$row['Link'].'>';
                                echo $row['Website'];
                                echo '</a>';
                                echo '</br>'.$row['Difficulty'].'</br>';
                                
                                $idofcard="d".$row['CourseId'];
                                $idofbutton="b".$row['CourseId'];
                                //echo $idofcard.'<br/>'.$idofbutton;
                                //echo '<span onclick="info(\''.$idofcard.'\');" >More Info</span>';
                                echo '<span style="text-decoration:underline;color:teal; cursor:pointer;" onclick="infoo(\''.$idofcard.'\');">More Info</span>';
                                echo '<input type="button" id="'.$idofbutton.' "  value="Add to Compare"  name="comp"
                                        style=" background-color: #008080;
                                                position:absolute;
                                                bottom: 0px;        
                                                left: 40px;
                                                color: white;
                                                padding: 14px 20px;
                                                margin: 8px 0;
                                                border: none;
                                                cursor: pointer;
                                                "
                                        onclick="addtocomp('.$row["CourseId"].');"
                                    />';
                                echo '</span></li>';
                                echo ' <div class="cardinfo" id="'.$idofcard.'">
                                            <span onclick=\'document.getElementById("'.$idofcard.'").style.visibility="hidden";\'
                                                style="font-size:0.7em;text-decoration:underline;color:teal; cursor:pointer;position:absolute; top:5px; left:5px;"/>
                                            Back
                                            </span>
                                            <br/>'.$row['CourseName'].
                                            '<br/>'.$row['Info'].'
                                        </div>';
                            }
                            $i++;
                        }
                    }
                    
                ?>
                <div style="visibility:hidden;z-index:-1;position:absolute; top:-200px;">
                                <input type="text" id="one" value="" name="one">
                                <input type="text" id="two" value="" name="two">
                                <input type="text" id="three" value="" name="three">
                            </div>
                            <input class="comparebutton" type="submit" value="Compare" />
                    </form>

            </ul>
        </div>
        <br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
    </body>
</html>

