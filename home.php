<!DOCTYPE html>
<?php 

/*
Name: Shashwat Kumar
Student No.: 000790494
I certify that this is my original work.

This php file is the home page when the user logs in, it displays users weight goal, users current weight, no of days left to acheive that goal
It also displays dropdowns for the user to select their food which they ate and its quantity. It has a graph too.
*/

    session_start();
    $access = isset($_SESSION["userid"]);
    //include "header.php";
    include "connect.php";

    $email = filter_input(INPUT_GET,"email",FILTER_SANITIZE_SPECIAL_CHARS);
   
    $getName = "SELECT * from users where Email = ?";
    $stmt = $dbh->prepare($getName);
    $param = [$email];
    $success = $stmt->execute($param);

    if($success && $row=$stmt->fetch()){
        $name = $row["Username"];
        $weight_goal = $row["WeightGoal"];
        $deadline = $row["Deadline"];
        $deadline = date("m/d/Y", strtotime($deadline));
        $current_weight = $row["Userweight"];
        $height = $row["Userheight"];
        $age = $row["Userage"];
    }

    $foodlist = [];
    $foodqry = "SELECT * from food";
    $stmt1 = $dbh->prepare($foodqry);
    $success1 = $stmt1->execute();

    while($success1 && $row1 = $stmt1->fetch()){
        $foodname = $row1["FoodName"];
        array_push($foodlist,$foodname);
    }

    $cal_required = 66 + (6.3 * $current_weight) + (12.9 * $height) - (6.8 * $age);

    
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="./css/home.css">
    <style>
    .navbar {
        overflow: hidden;
        background-color: #333;
    }

    .navbar a {
        float: left;
        font-size: 16px;
        color: white;
        text-align: center;
        padding: 14px 16px;
        text-decoration: none;
    }

    .dropdown {
        float: right;
        overflow: hidden;
    }

    .dropdown .dropbtn {
        font-size: 16px;  
        border: none;
        outline: none;
        color: white;
        padding: 14px 16px;
        background-color: inherit;
        font-family: inherit;
        margin: 0;
    }

    .navbar a:hover, .dropdown:hover .dropbtn {
        background-color: #000;
    }

    .active {
        background-color: #4CAF50;
    }

    .dropdown-content {
        display: none;
        position: absolute;
        background-color: #f9f9f9;
        min-width: 120px;
        box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
        z-index: 1;
    }

    .dropdown-content a {
        float: none;
        color: black;
        padding: 12px 16px;
        text-decoration: none;
        display: block;
        text-align: left;
    }

    .dropdown-content a:hover {
        background-color: #ddd;
    }

    .dropdown:hover .dropdown-content {
        display: block;
    }
</style>
</head>
<body>
<?php 
    if($access){
?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<!-- <link rel="stylesheet" href="css/header.css"> -->
<header>
<img style="width:100%" src="images/navbar5.jpg" alt="">
<div class="navbar">
  <a class="active" href="#"><i class="fa fa-fw fa-home"></i> Home</a>
  <a href="#"><i class="fa fa-fw fa-gift"></i> Food Suggestion</a>
  <a href="#"><i class="fa fa-fw fa-heart"></i> Healthy Recipe</a>
  <a href="#"><i class="fa fa-fw fa-forumbee"></i> Discussion Forum</a>
  <div class="dropdown">
    <button class="dropbtn"><i class="fa fa-fw fa-smile-o"></i>Hi <?= $name?>! 
      <i class="fa fa-caret-down"></i>
    </button>
    <div class="dropdown-content">
      <a href="logout.php">Logout</a>
    </div>
  </div> 
</div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="js/navbar.js"></script>
</header>
<div class = section>
    <div class = "graph">
        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
        
        <div id="curve_chart" style="width: 350px; height: 350px"></div>
        
    </div>
    <div class = "content">
        <input type="hidden" id="height" value=<?= $height?>>
        <input type="hidden" id="age" value=<?= $age?>>
        <h3>Calorie Intake: <span id = "calcount">0</span>/<span id = "calreq"><?= $cal_required ?></span></h3>
        
        <div class ="meal">
            <div id = breakfast>
                <p>Breakfast</p>
                <label for="">Time</label>
                <select>
                    <?php
                        for($i=0;$i<8;$i++)
                        {
                            if($i < 6) {?>
                                <option value=<?= $i+6 ?>"am"><?= $i + 6 ?> AM</option>
                            <?php }
                            elseif($i == 6) {?>
                                <option value=<?= $i+6 ?>"pm"><?= $i + 6 ?> PM</option>
                        <?php } 
                        else {?>
                                <option value=<?= $i-6 ?>"pm"><?= $i - 6 ?> PM</option>
                        <?php } 
                        } 
                    ?>    
                </select>

                <label for="">Food</label>  
                <select id = "bcalories">
                    <?php
                        for($i=0;$i<count($foodlist);$i++)
                        {?>
                            <option value=<?= $foodlist[$i] ?>><?= $foodlist[$i] ?></option>
                        <?php } 
                    ?>    
                </select>
   
                <label for="">Qty</label>
                <select id = "bqtyselect">
                    <?php
                        for($i=0;$i<10;$i++)
                        {?>
                            <option value=<?= $i+1?>><?= $i+1?></option>
                        <?php }
                    ?>
                </select>

                <label for=""> = <span id = "bnumbercalories" class = "numbercalories">155</span> Calories</label>
                <input type="button" value="Add" id = "badd">
            </div>

            <div id = lunch>
                <p>Lunch</p>
                <label for="">Time</label>
                <select>
                    <?php
                        for($i=0;$i<8;$i++)
                        {?>
                            <option value=<?= $i+2 ?>"pm"><?= $i + 2 ?> PM</option>
                        <?php }
                    ?>
                </select>

                <label for="">Food</label>
                <select id="lcalories">
                    <?php
                        for($i=0;$i<count($foodlist);$i++)
                        {?>
                            <option value=<?= $foodlist[$i] ?>><?= $foodlist[$i] ?></option>
                        <?php } 
                    ?>    
                </select>

                <label for="">Qty</label>
                <select id = "lqtyselect">
                    <?php
                        for($i=0;$i<10;$i++)
                        {?>
                            <option value=<?= $i+1?>><?= $i+1?></option>
                        <?php }
                    ?>
                </select>

                <label for=""> = <span id = "lnumbercalories" class = "numbercalories">155</span> Calories</label>
                <input type="button" value="Add" id = "ladd">
            </div>

            <div id = dinner>
                <p>Dinner</p>
                <label for="">Time</label>
                <select>
                    <?php
                        for($i=0;$i<8;$i++)
                        {
                            if($i < 2) {?>
                                <option value=<?= $i+10 ?>"pm"><?= $i + 10 ?> PM</option>
                            <?php }
                            elseif($i == 2) {?>
                                <option value=<?= $i+10 ?>"am"><?= $i + 10 ?> AM</option>
                        <?php } 
                        else {?>
                                <option value=<?= $i-2 ?>"am"><?= $i - 2 ?> AM</option>
                        <?php } 
                        } 
                    ?>    
                </select>

                <label for="">Food</label>
                <select id = "dcalories">
                    <?php
                        for($i=0;$i<count($foodlist);$i++)
                        {?>
                            <option value=<?= $foodlist[$i] ?>><?= $foodlist[$i] ?></option>
                        <?php } 
                    ?>    
                </select>

                <label for="">Qty</label>
                <select id = "dqtyselect">
                    <?php
                        for($i=0;$i<10;$i++)
                        {?>
                            <option value=<?= $i+1?>><?= $i+1?></option>
                        <?php }
                    ?>
                </select>

                <label for=""> = <span id = "dnumbercalories" class = "numbercalories">155</span> Calories</label>
                <input type="button" value="Add" id = "dadd" >
            </div>
        </div>
    </div>
    <div class = "date">
        <?php 
            
            echo "<br>Today is " . date("l"). "<br> <br>";

            $d1=strtotime($deadline);
            $d2=abs(ceil(($d1 -time())/60/60/24));
            echo "You've got <span id = 'deadline'>$d2</span> days to achieve your goal"."<br>"."<br>";

            echo "Current Weight: <span id = 'changetxtbox'>$current_weight</span> kgs"."<br>";
            echo "&nbsp<input type = 'button' value='Edit' id = 'editbtn' class = 'weightBtn'>&nbsp<input type = 'button' value='Update' id = 'updatebtn' class = 'weightBtn'>"."<br>"."<br>";
           
            echo "Goal: $weight_goal kgs";

            

        ?>
    </div>
</div>
    <footer>
        <p>Copyright &copy; 2019 All Rights Reserved by Food Tracker.</p>
    </footer>
    
<?php 
    }
    else {
        echo "<h1>Not Logged in. Access denied.</h1>";
    }
?>

<script src="js/weight_edit.js"></script>
<script src="js/calorie.js"></script>
<script src="js/totalcalorie.js"></script>
<script src="js/graph.js"></script>
</body>
</html>

