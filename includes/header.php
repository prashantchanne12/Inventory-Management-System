<?php require_once 'php_action/core.php'; ?>

<!DOCTYPE html>
<html>

<head>

  <title>Stock Management System</title>

  <!-- font awesome -->
  <link rel="stylesheet" href="assests/font-awesome/css/font-awesome.min.css">

  <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">


  <!-- custom css -->
  <link rel="stylesheet" href="custom/css/global.css">
  <link rel="stylesheet" href="custom/css/navbar.css">

  <!-- DataTables -->
  <link rel="stylesheet" href="assests/plugins/datatables/jquery.dataTables.min.css">

  <!-- file input -->
  <link rel="stylesheet" href="assests/plugins/fileinput/css/fileinput.min.css">


  <!-- jquery -->
  <script src="assests/jquery/jquery.min.js"></script>
  <!-- jquery ui -->
  <link rel="stylesheet" href="assests/jquery-ui/jquery-ui.min.css">
  <script src="assests/jquery-ui/jquery-ui.min.js"></script>

</head>

<style>
  body {
    font-family: 'Montserrat', sans-serif;
  }

  .navbar {
    background-color: #0984e3;
    color: #fff;
    width: 100%;
    height: 60px;
  }

  .navbar .container .navbar-links {
    display: flex;
  }

  .navbar .container .navbar-links li {
    display: flex;
    list-style: none;
    position: relative;
  }


  .navbar .container .navbar-links li a {
    display: block;
    color: #fff;
    font-size: 1rem;
    text-decoration: none;
    padding: 22px 14px;
  }

  .navbar .container .navbar-links li ul {
    display: none;
    list-style: none;
    margin-top: 3.7rem;
    border: 1px solid #0985e367;
    position: absolute;
    background-color: #fff;
    padding: 0.75rem;
  }

  .navbar .container .navbar-links li:hover ul {
    display: block;
  }

  .navbar .container .navbar-links li ul li {
    width: 170px;
  }

  .navbar .container .navbar-links li ul li a {
    padding: 10px 7px;
    color: #333;

  }

  .navbar .container .navbar-links li ul li:hover {
    background-color: #f3f3f3;
    border-radius: 4px;
  }
</style>

<body>


  <nav class="navbar">
    <div class="container">
      <ul class="navbar-links">

        <li id="navDashboard"><a href="index.php"><i class="glyphicon glyphicon-list-alt"></i> Dashboard</a></li>
        <?php if(isset($_SESSION['userId']) && $_SESSION['userId']==1) { ?>
        <li id="navBrand"><a href="brand.php"><i class="glyphicon glyphicon-btc"></i> Brand</a></li>
        <?php } ?>
        <?php if(isset($_SESSION['userId']) && $_SESSION['userId']==1) { ?>
        <li id="navCategories"><a href="categories.php"> <i class="glyphicon glyphicon-th-list"></i> Category</a></li>
        <?php } ?>
        <?php if(isset($_SESSION['userId']) && $_SESSION['userId']==1) { ?>
        <li id="navProduct"><a href="product.php"> <i class="glyphicon glyphicon-ruble"></i> Product </a></li>
        <?php } ?>

        <li class="dropdown" id="navOrder">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
            aria-expanded="false"> <i class="glyphicon glyphicon-shopping-cart"></i> Orders <span
              class="caret"></span></a>
          <ul class="dropdown-menu">
            <li id="topNavAddOrder"><a href="orders.php?o=add"> <i class="glyphicon glyphicon-plus"></i> Add Orders</a>
            </li>
            <li id="topNavManageOrder"><a href="orders.php?o=manord"> <i class="glyphicon glyphicon-edit"></i> Manage
                Orders</a></li>
          </ul>
        </li>

        <?php  if(isset($_SESSION['userId']) && $_SESSION['userId']==1) { ?>
        <li id="navReport"><a href="report.php"> <i class="glyphicon glyphicon-check"></i> Report </a></li>
        <?php } ?>
        <li class="dropdown" id="navSetting">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
            aria-expanded="false"> User <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <?php if(isset($_SESSION['userId']) && $_SESSION['userId']==1) { ?>
            <li id="topNavSetting"><a href="setting.php"> <i class="glyphicon glyphicon-wrench"></i> Setting</a></li>
            <li id="topNavUser"><a href="user.php"> <i class="glyphicon glyphicon-wrench"></i> Add User</a></li>
            <?php } ?>
            <li id="topNavLogout"><a href="logout.php"> <i class="glyphicon glyphicon-log-out"></i> Logout</a></li>
          </ul>
        </li>

      </ul>
    </div><!-- /.container-fluid -->
  </nav>

  <div class="container">