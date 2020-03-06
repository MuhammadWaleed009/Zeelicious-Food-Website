<?php
include_once 'connection.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Basic -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">

    <!-- Site Metas -->
    <title>Zeeliciousfoods | Easy recipes, food reviews, kitchen tips and tricks and health benefits of foods</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Site Icons -->
    <link rel="shortcut icon" href="images/favicon.png"/>
    <link rel="apple-touch-icon" href="images/favicon.png">

    <link rel="stylesheet" href="css/cstyle.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- Site CSS -->
    <link rel="stylesheet" href="css/style.css">
    <!-- Responsive CSS -->
    <link rel="stylesheet" href="css/responsive.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/custom.css">

    <!-- Modernizer for Portfolio -->
    <script src="js/modernizer.js"></script>


    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>
<body>

<!-- LOADER
<div id="preloader">
    <div class="loader">
        <div class="loader__bar"></div>
        <div class="loader__bar"></div>
        <div class="loader__bar"></div>
        <div class="loader__bar"></div>
        <div class="loader__bar"></div>
        <div class="loader__ball"></div>
    </div>
</div><!-- end loader -->
<!-- END LOADER -->
<?php include 'template/header.php';?>

	
<body>
 <br><br><br><br>   
<div class="container">
    <div class="row">
        <div class="col-sm-3 col-md-3" >
            <h2 style="text-bold:!important">My Account</h2>
            <nav class="text1">
            <ul>
                <li><a style="color:blue!important" href="dashboard.php">Dashboard</a></li>
                <li><a style="color:red!important" href="orders.php">Orders</a></li>
                <li><a style="color:red!important" href="">Downloads</a></li>
                <li><a style="color:red!important" href="address.php">Addresses</a></li>
                <li><a style="color:red!important" href="">Payment Methods</a></li>
                <li><a style="color:red!important" href="">Account Details</a></li>
                <li><a style="color:red!important" href="logout.php">Logout</a></li>
            </ul>   
        </nav>
        </div>
   <div class="col-sm-9 col-md-9" >
    <!--div class=' owl-services owl-carousel owl-theme'-->

<?php
/*CREATE TABLE subscription(
   id int(30) PRIMARY key AUTO_INCREMENT,
   user_id int(30) not null,
   mealplans_id INT(30) NOT NULL,
   weeks int(30) NOT Null
    );*/

if(isset($_SESSION['user'])) {

$uid=$_SESSION['user']['id'];
$sql2 = "SELECT * FROM orders WHERE user_id=".$uid;
$result2 = mysqli_query($conn, $sql2);
 if (mysqli_num_rows($result2)>0) {
     while ($row2 = mysqli_fetch_assoc($result2))
     {

        $oid = $row2['id'];

        $sql1 = "SELECT * FROM order_details WHERE ORDER_ID=".$oid." and mealplans_ID is not null";
        $result1 = mysqli_query($conn, $sql1);
        if (mysqli_num_rows($result1)>0) {

            $row1 = mysqli_fetch_assoc($result1);
            $mp_id = $row1['mealplans_ID'];

            $weeks = $row1['mealplan_QUANTITY'];





/*
CREATE TABLE mealplan_table
(
    id int(30) PRIMARY KEY AUTO_INCREMENT,
    mealplans_id int(30) NOT NULL,
    name varchar(100) NOT NULL,
    week int(30) NOT NULL,
    file varchar(100) NOT NULL
    );
    */

for ($wi=1; $wi <=$weeks ; $wi++)
{ 
    $sql = 'select * from mealplan_table where mealplans_id='.$mp_id.' and week='.$wi.' order by week';
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result)>0) {
           
       
            $row = mysqli_fetch_assoc($result);
            


                 echo '<div class="table-responsive"><h2>Week '.$row['week'].'</h2><br><table class="table table-striped ">
                                <thead>
                                    <tr style="background-color: black">
                                        <th >Time</th>
                                        <th >MONDAY</th>
                                        <th >TUESDAY</th>
                                        <th >WEDNESDAY</th>
                                        <th >THURSDAY</th>
                                        <th >FRIDAY</th>
                                        <th >SATURDAY</th>
                                        <th >SUNDAY</th>
                                    </tr>
                                </thead>';
                $times= array('Before Breakfast','Breakfast','Mid Day Snack','Lunch','Evening Snack','Dinner','Calories' );
                $days= array('d','MONDAY','TUESDAY','WEDNESDAY','THURSDAY','FRIDAY','SATURDAY','SUNDAY' );
                $itr=1;
                
                $array = array();
                $array =array_pad($array,60,"0");

                $array[0]='Before Breakfast';
                $array[8]='Breakfast';
                $array[16]='Mid Day Snack';
                $array[24]='Lunch';
                $array[32]='EveningSnack';
                $array [40]='Dinner';
                $array[48]='Calories';

                
                    while ( $itr<= 7) {
                        
        //Monday
                  $sqlm = 'select * from mealplan_table where mealplans_id='.$mp_id.' and week='.$row['week'].' and day="'.$days[$itr].'";';
                    $resultm = mysqli_query($conn, $sqlm);
                    $rowm = mysqli_fetch_assoc($resultm);

                    
                    $sqlb = 'select * from receipe where title="'.$rowm['breakfast'].'"';
                    $resultb = mysqli_query($conn, $sqlb);
                    $rowb = mysqli_fetch_assoc($resultb);


                    $sqlmi = 'select * from receipe where title="'.$rowm['midDaySnack'].'"';
                    $resultmi = mysqli_query($conn, $sqlmi);
                    $rowmi = mysqli_fetch_assoc($resultmi);

                    $sqll = 'select * from receipe where title="'.$rowm['lunch'].'"';
                    $resultl = mysqli_query($conn, $sqll);
                    $rowl = mysqli_fetch_assoc($resultl);
                    
                    $sqle = 'select * from receipe where title="'.$rowm['eveningSnack'].'"';
                    $resulte = mysqli_query($conn, $sqle);
                    $rowe = mysqli_fetch_assoc($resulte);
                    
                    $sqld = 'select * from receipe where title="'.$rowm['dinner'].'"';
                    $resultd = mysqli_query($conn, $sqld);
                    $rowd = mysqli_fetch_assoc($resultd);

                    //array_push($array, $some_data);

                     $array[$itr+0]=$rowm['beforeBreakfast'];
                    $array[$itr+8]="<a href='showReceipe.php?id=".$rowb['id']."'>".$rowm['breakfast']."</a>";
                    $array[$itr+16]="<a href='showReceipe.php?id=".$rowmi['id']."'>".$rowm['midDaySnack']."</a>";
                    $array[$itr+24]="<a href='showReceipe.php?id=".$rowl['id']."'>".$rowm['lunch']."</a>";
                    $array[$itr+32]="<a href='showReceipe.php?id=".$rowe['id']."'>".$rowm['eveningSnack']."</a>";
                    $array[$itr+40]="<a href='showReceipe.php?id=".$rowd['id']."'>".$rowm['dinner']."</a>";
                    $array[$itr+48]=$rowm['calories'];
                
                    $itr++;

                }
                    
    

                    
                for($tr=0;$tr<56;$tr+=8)
                {
  //                  $tr=0;

                    echo "<tr><td>".$array[$tr]."</td><td>".$array[$tr+1]."</td><td>".$array[$tr+2]."</td><td>".$array[$tr+3]."</td><td>".$array[$tr+4]."</td><td>".$array[$tr+5]."</td><td>".$array[$tr+6]."</td><td>".$array[$tr+7]."</td></tr>";
                     
                }
        echo '</table></div>';


               
             
        }//end if
    }//end for
        }//end if
    }//endwhile
}//end if
}//end if
    
?>

                

     


</div>

</div>

</div>
</body>


	

<?php include 'template/footer.php';?>


<a href="#" id="scroll-to-top" class="dmtop global-radius"><i class="fa fa-angle-up"></i></a>

<!-- ALL JS FILES -->
<script src="js/all.js"></script>
<!-- ALL PLUGINS -->
<script src="js/custom.js"></script>
<script src="js/portfolio.js"></script>
<script src="js/hoverdir.js"></script>

</body>
</html>