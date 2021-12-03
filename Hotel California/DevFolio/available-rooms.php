<?php 
    include 'class.php';
    include 'db.php';

    $p = new USER($user);



    if(!empty($_POST['btnUP']) || !empty($_POST['btnDOWN'])) {
        //        echo "<pre>",print_r($_POST, true), "</pre>";
        foreach($_POST as $k => $v) $$k = $v; // de dubbele $ is geen typfout!
    
        if(isset($btnUP))
            $p->doUpdateCategoryCount($btnUP, 1); // up
        else
            $p->doUpdateCategoryCount($btnDOWN, 2); // down
    }
?>
<!DOCTYPE html PUBLIC>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" href="scss/style-db.scss">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">    
    <title>available-rooms</title>
    <style>
        .hoewilikdatmijntabeleruitziet {
            background-color: #ccffe2;
        }

    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">Dashboard</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarText">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="dashboard.php">Home <span class="sr-only"></span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="available-rooms.php">Available Rooms</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="roomplan.php">Room plan</a>
                </li>
            </ul>
            <span class="navbar-text">
                <a href="index.php"> Logout </a>
            </span>
        </div>
    </nav>

    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <p class="lead">The amount of rooms is limited to 10. <br>
                 The current availability of all room types is:</p>
                <?php
                    echo $p->getCategoryCount();
                ?>
            </div>
        </div>
    </div>
</body>

</html>
