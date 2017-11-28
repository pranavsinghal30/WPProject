<html>
<head>
     <link rel="stylesheet" type="text/css" href="comparison.css"/>

</head>
<body>
     <?php
     $db=mysqli_connect('localhost','root','') or die("not connected");
     mysqli_select_db($db,'project1');// or die(mysql_error($db));
     $query1='SELECT * FROM coursedetail WHERE CourseId='.$_POST["one"];
     $query2='SELECT * FROM coursedetail WHERE CourseId='.$_POST["two"];
     $query3='SELECT * FROM coursedetail WHERE CourseId='.$_POST["three"];
    
     $result1=mysqli_query($db,$query1);// or die (mysql_error($db));
     if(!$result1)
     {
         header("Location: homepage1.php");
     }
     $result3=mysqli_query($db,$query3) ;//or die (mysql_error($db));
     $result2=mysqli_query($db,$query2) ;//or die (mysql_error($db));
     if($result1){$row1=mysqli_fetch_assoc($result1) ;}//die("dude");// (mysql_error($db));
     if($result2){$row2=mysqli_fetch_assoc($result2) ;}//or die (mysql_error($db));
    if($result3) {$row3=mysqli_fetch_assoc($result3) ;}//or die (mysql_error($db));

     echo "<table class='comptable'>";
     foreach ($row1 as $key=>$value)
     //for ($i=0;$i<2;$i++)
     {  
         if($key!='CourseId' && $key!="Level")
         {
     //     foreach ($row as $key=>$value){
          echo "<tr><td class='tdhead'>".$key."</td>";
          echo "<td>".$value."</td><td>";
          if($result2)
          {
            echo $row2[$key]."</td><td>";

          }
          if($result3)
          {
            echo $row3[$key]."</td><td>";

          }

        }

         
     }
     
     echo "</table>";
     //mysqli_query($db,$query) or die(mysqli_error($db));
     ?>
</body>
</html>
