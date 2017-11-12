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
        <script type="text/javascript" src="compare.js"></script>

        <!--script type="text/javascript">
            function infoo(id)
            {
                //alert("b"+id);
                document.getElementById(id).style.visibility="visible";
            }
        </script-->

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

                    echo $name;
                    

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
                        echo "<a href='homepage1.php'>";    //?uname=$una' >";
                        echo "Home</a>";
                        ?>
                    </li>
                    <li>
                        <?php
                        echo "<a href='UserPage FFF.php'>";     //?uname=$una' >";
                        echo "Dashboard</a>";
                        ?>
                    </li>

                    <li style="float:left; position:relative; left:980px; top:-96.5px;">
                    <!--li style="position:fixed; right:0px;"-->

                        <?php
                            echo "<a href='logout.php' >Sign Out</a>";
                        ?>
                    </li>
                </ul>
            </nav>
        </div>
         
        <!-- Search Box -->
        <div id="search">
            <form action="homepage1.php" method= "POST">
                <p>
                    <label>

                        <input id="sea" name="searc" type="text" <?php if($_SERVER['REQUEST_METHOD']=='POST') echo 'value="'.$_POST["searc"].'"'; ?> />

                    </label>
                    <input type="submit" id="sec" value="Search" />
                    <br/>
                    <label style="font-size:0.6em;">

                        <input type="radio" name="filter" value="Level"id="l">Filter by Difficulty Level</input>
                    </label>
                    <label style="font-size:0.6em;">
                        <input type="radio" name="filter" value="Duration" id="d">Filter by Duration</input>
                    </label>
                    <label style="font-size:0.6em;">
                        <input type="radio" name="filter" value="AverageRating" id="l">Filter by Average Rating</input>

                    </label>
                </p>
                <p style="font-size:0.8em; text-align:left;">
                <?php 
                    if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['filter']))
                    {
                        echo 'Filtered by: '.$_POST['filter'];
                    }
                ?>
                </p>
            </form>
        </div>
        

        </div>
        <!-- All the COurses -->

            <div class="courses">
                <?php
                    $db=mysql_connect("localhost","root","") or die ("error");
                    $db=mysql_select_db("project1",$db) or die ("error with project1");
                    $a=array();
                    $error="";
                    $qatt="";
                    $count=0;
                    if($_SERVER['REQUEST_METHOD']=='POST')
                    {
                        $searc=strtolower($_POST["searc"]);
                        $searc=preg_replace('/\s+/','',$searc);
                        
                        if(isset($_POST['filter']))
                        {
                            $qatt="order by ".$_POST['filter'];//Level";
                        }
                        if($searc!=NULL)
                        {
                            if($searc[strlen($searc)-1]=='s')
                                $searc=substr($searc,0,strlen($searc)-1);
                            $query="select * from coursedetail left join coursesearch on coursedetail.CourseId=coursesearch.CourseId where Tag1='$searc' or Tag2='$searc' ".$qatt;
                        }
                        else
                            $query="select * from coursedetail ".$qatt;// order by Level; ";
                        $result=mysql_query($query);
                        if(!$result)
                        {
                            echo $query.'<br/>'.$qatt.'<br/>';
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
                        $a=array_unique($a);
                        $count=count($a);
                        $query="select Tag2 from coursesearch where Tag1='$searc'";
                        $result=mysql_query($query);
                        $num_rows=mysql_num_rows($result);
                        for($i=0;$i<$num_rows;$i++)
                        {
                            $row=mysql_fetch_assoc($result);
                            $s=$row['Tag2'];
                            $q="select * from coursedetail left join coursesearch on coursedetail.CourseId=coursesearch.CourseId where Tag2='$s' ".$qatt;
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
                    if(count($a)==0)
                    {
                        $query="SELECT * from coursedetail".$qatt;// order by Level;";
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
                    $i=0;
                ?>
                    <form action="comparison.php" method="POST">

                        <?php
                            foreach($a as $p=>$id)
                            {
                                $query2="select * from coursedetail where CourseId='$id'";
                                $result=mysql_query($query2);
                                $row=mysql_fetch_assoc($result);
                                if($i==$count && $_SERVER['REQUEST_METHOD']=='POST' && $_POST['searc']!=NULL)
                                {
                                    echo '</br/><br/><br/></br/><br/></br/></br/></br/></br/></br/></br/></br/>';
                                    
                                    if($count%3!=0 && $count>3)
                                    {
                                        for($x=1;$x<=3-$count%3;$x++)
                                        echo '<div style="visibility:hidden;" class="cards"></div>';
                                    }
                                    echo '<h3>Related courses</h3>';
                                }
                                $idofcard="d".$row['CourseId'];
                                $idofbutton="b".$row['CourseId'];
                                //echo $idofcard;
                                echo '<div class="cards" id="'.$row["CourseId"].'"   >';
                                echo $row['CourseName'].'</br>';
                                echo '<span style="font-size:0.7em;">'.$row['Institution'].'</br>';
                                echo '<a href='.$row['Link'].'>';
                                echo $row['Website'];
                                echo '</a>';
                                echo '</br>'.$row['Difficulty'].'</br>';
                                //echo '<span onclick="info(\''.$idofcard.'\');" >More Info</span>';
                                echo '<span style="text-decoration:underline;color:teal; cursor:pointer;" onclick="infoo(\''.$idofcard.'\');">More Info</span>';
                                echo '<input id="'.$idofbutton.' "type="button" value="Add to Compare"  name="comp"
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
                                echo '</span></div>';
                                echo ' <div class="cardinfo" id="'.$idofcard.'">
                                        <span onclick=\'document.getElementById("'.$idofcard.'").style.visibility="hidden";\'
                                                style="font-size:0.7em;text-decoration:underline;color:teal; cursor:pointer;position:absolute; top:5px; left:5px;"/>
                                                Back</span>
                                                <br/>'.$row['CourseName'].
                                                '<br/>'.$row['Info'].'
                                        </div>';
                                
                                //echo '</input>";
                                //echo '</a>';
                                $i++;
                            }
                        
                         /* echo  '<!--Pop up detail-->
                                <div id="cardinfo" 
                                style="position: fixed;
                                top: 100px;
                                left: 300px;
                                visibility: hidden;
                                margin: 2%;
                                width:800px;
                                height: 12em;
                                background-color: rgb(255, 255, 255);
                                color:black;
                                box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
                                text-align: center;
                                opacity:1;
                                padding-top: 5%;
                                z-index: 10;">
                                    <form>
                                        <input type="button" value="back" 
                                            onclick="document.getElementById(\'cardinfo\').style.visibility=\'hidden\';"
                                            style="position:absolute; top:5px; left:5px;"    
                                        />'.$row['CourseName'].'
                                    </form></div>'*/;
                            ?>


                            <div style="visibility:hidden;">
                                <input type="text" id="one" value="" name="one">
                                <input type="text" id="two" value="" name="two">
                                <input type="text" id="three" value="" name="three">
                            </div>
                            <input class="comparebutton" type="submit" value="Compare" />
                    </form>
                        

                        
                <!--div class="cards">
                      Courses 1
                </div>
                <div class="cards">
                        Courses 2
                </div-->
            </div>            
    </body>            
</html>