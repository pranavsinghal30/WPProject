<?php
    $db= mysql_connect("localhost","root","","project1");
?>
<!DOCTYPE html>
<html>
    <head>
        <title>
            home page
        </title>
        <link rel="stylesheet" type="text/css" href="StyleHomePageFFF.css" />
            <style>
                @import url('https://fonts.googleapis.com/css?family=Cabin+Condensed');
             </style>
        </title>
    </head>

    <body>
            <div class="toolbar">
                <div id="welcome">
                    <?php
                         $una=$_GET['uname'];
                         //$db= mysql_connect("localhost","root","","project1");
                         $query="SELECT Name FROM `project1`.`userprofile1` WHERE UserName='$una'";
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
                <nav>
                    <ul>
                        <li id="current">
                            <?php
                            echo "<a href='home page FFF.php?uname=$una' >";
                            echo "Home";
                            ?>
                            </a>
                            <!--a href="c:\xampp\htdocs\Project\home page FFF.html" >Home</a-->
                        </li>
                        <li>
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

            <div id="search">
                <form>
                    <p>
                        <label>
                            Search: <input type="text" />
                        </label>
                    </p>
                </form>
            </div>

            <div class="out">
            
                <div class="cardsize1">
                      Courses 1
                </div>
            
                <div class="cardsize1">
                        Courses 2
                </div>

                <div class="cardsize1">
                        Courses 3
                </div>
            
                <div class="cardsize1">
                      Courses 4
                </div>
                
                <div class="cardsize1">
                        Courses 5
                </div>

                <div class="cardsize1">
                        Courses 6
                </div>
  
                <div class="cardsize1">
                    Courses 7
                </div>
                <div class="cardsize1">
                        Courses 8
                </div>
                <div class="cardsize1">
                        Courses 8
                </div>
                <div class="cardsize1">
                        Courses 9
                </div>
            </div>            
    </body>            
</html>
