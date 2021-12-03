<?php include 'class.php' ?>
<?php include 'db.php' ?>
<?php $p = new USER($user);?>


<!DOCTYPE html PUBLIC>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="scss/style-db.scss">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<!-- <link rel="stylesheet" href="" type="text/css"  /> -->
<title>Dashboard</title>
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
                <p class="lead"></p>
                <?php
                $p->getFloorPlan();
                ?>
    </div>
</body>
</html>