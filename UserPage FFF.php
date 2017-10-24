<!DOCTYPE html>
<html>
    <head>
        <title>
            Dashboard
        </title>
        <link rel="stylesheet" type="text/css" href="StyleUserPage FFF.css" />
        <style>
            @import url('https://fonts.googleapis.com/css?family=Cabin+Condensed');
        </style>
    </head>
    
    <body>
        <div class="toolbar">
            <div id="welcome">
                <?php
                    $una=$_GET['uname'];
                    //echo $una."<br/>";
                    $db= mysql_connect("localhost","root","","project1");
                    //$conn=mysql_select_db("project1");
                    
                    $query="SELECT Name FROM `project1`.`userprofile1` WHERE UserName='$una'";
                    //$query="SELECT Name FROM `project1`.`userprofile1` WHERE UserName='$una'";
                    $result=mysql_query($query);
                    if(!$result)
                    {
                        print "lol";
                        exit;
                    }
                    $row=mysql_fetch_assoc($result);
                    //exit;
                    $name=$row['Name'];
                    echo "Welcome, ".$name;
                ?>
            </div>
            <h1> Website Name</h1>
            <nav>
                <ul>
                    <li>
                        <?php
                            echo "<a href='home page FFF.php?uname=$una' >";
                            echo "Home";
                        ?>
                        </a>
                        <!--a href="c:\xampp\htdocs\Project\home page FFF.html" >Home</a-->
                    </li>
                    <li id="current">
                        <?php
                            echo "<a href='UserPage FFF.php?uname=$una' >";
                            echo "Dashboard";
                        ?>
                        </a>
                        <!--a href="c:\xampp\htdocs\Project\UserPage FFF.html" >Dashboard</a-->
                    </li>
                    <li style="float:right; margin-right:10px;">
                            <a href="" >Sign Out</a>
                    </li>
                </ul>
            </nav>
        </div>
<!-- UERS STATS-->
        <div id="userstats">
            <ul>
                
                <?php
                    //$db=mysql_connect("localhost","root","","project1");
                    //$conn=mysql_select_db("project1");
                    if(!$db)
                    {
                        echo "unsuccesful";
                        //exiit;
                    }
                    $query="SELECT * FROM `project1`.`userprofile1` WHERE UserName='$una'";
                    $result=mysql_query($query);
                    if(!$result)
                    {
                        echo "Result Unsuccesful";
                        exit;
                    }
                    
                    $num=mysql_num_rows($result);
                    $row=mysql_fetch_assoc($result);
                        echo "<li>Name: ".$row['Name']."</li><li>Branch: ".$row['Branch']."</li><li>".$row['NumOfCourses']." Courses Completed</li><li>".$row['College'];
                    
                ?>
                <!--li>
                    College Name
                </li-->
                <li>
                    Semester
                </li>
                <!--li>
                    Branch
                </li>
                <li>
                    Number of courses taken
                </li>
                <li>
                    Number of courses completed
                </li-->
            </ul>
        </div>
<!-- COURSES TAKEN-->
        <div class="c_taken">
            <h2>
                Courses Taken
            </h2>
            <ul>
                <?php
                    $query="SELECT * FROM `project1`.`usercourses1` WHERE UserName='$una'";
                    $result=mysql_query($query);
                    if(!$result)
                    {
                        echo "Result Unsuccesful";
                        exit;
                    }
                    $num_field=mysql_num_fields($result);
                    $row=mysql_fetch_array($result);
                    for($i=1; $i<$num_field; $i+=1)
                    {
                        if($row[$i]!=NULL)
                        echo "<li>".$row[$i]."</li>";
                    }
                    
                    /*
                    $i=1;
                    $row=mysql_fetch_array($result)
                    while($i<$num_field)
                    {
                        echo "<li>".$row[$i]."</li>";
                        echo "<li>Hello</li>";
                        $i=$i+1;
                    }
                    */
                ?>
                <!--li>

                    Course 1
                </li>
                <li>
                    Course 2
                </li>
                <li>
                    Course 3
                </li>
                <li>
                    Course 4
                </li>
                <li>
                    Course 5
                </li>
                <li>
                    Course 6
                </li>
                <li>
                    Course 7
                </li>
                <li>
                    Course 8
                </li>
                <li>
                    Course 9
                </li>
                <li>
                    Course 10
                </li-->
            </ul>
        </div>

    </body>
</html>