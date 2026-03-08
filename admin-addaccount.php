<!DOCTYPE html>
<!--
* CoreUI - Free Bootstrap Admin Template
* @version v2.1.12
* @link https://coreui.io
* Copyright (c) 2018 creativeLabs Łukasz Holeczek
* Licensed under MIT (https://coreui.io/license)
-->
<?php
  session_start();
    if(!isset($_SESSION['login']))
      header('location:login.php');
    $con = mysqli_connect('localhost','root','','sf_dashboard');
    if(mysqli_connect_errno()) {
      echo "Failed to connect to MySQL: ".mysqli_connect_error();
    }else {
      if(isset($_POST['submit'])) {
        $duplicate = false;
        $username = $_POST['username'];
        $password = $_POST['password'];
        $email = $_POST['email'];
        $checkDuplicate = "select username, email from accounts";
        $accountData = mysqli_query($con, $checkDuplicate);
        while($data = mysqli_fetch_array($accountData)) {
          if($data['username'] == $username || $data['email'] == $email) {
            $duplicate = true;
            break;
          }
        }
        if($duplicate == false) {
          $putAccount = "insert into accounts values('$username','$email','$password')";
          mysqli_query($con, $putAccount);
          echo "<script>alert('User Added!')</script>";
        }
        else {
          echo "<script>alert('User already exists. No duplication of email or username.')</script>";
        }
      }
      if(isset($_POST['editSub'])) {
        
      }
?>
<html lang="en">
  <head>
    <base href="./">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta name="description" content="CoreUI - Open Source Bootstrap Admin Template">
    <meta name="author" content="Łukasz Holeczek">
    <meta name="keyword" content="Bootstrap,Admin,Template,Open,Source,jQuery,CSS,HTML,RWD,Dashboard">
    <title>CoreUI Free Bootstrap Admin Template</title>
    <!-- Icons-->
    <link href="fontAwesome/css/all.css" rel="stylesheet">
    <link href="node_modules/@coreui/icons/css/coreui-icons.min.css" rel="stylesheet">
    <link href="node_modules/flag-icon-css/css/flag-icon.min.css" rel="stylesheet">
    <link href="node_modules/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="node_modules/simple-line-icons/css/simple-line-icons.css" rel="stylesheet">
    <!-- Main styles for this application-->
    <link href="css/style.css" rel="stylesheet">
    <link href="vendors/pace-progress/css/pace.min.css" rel="stylesheet">
    <!-- Global site tag (gtag.js) - Google Analytics-->
    <script async="" src="https://www.googletagmanager.com/gtag/js?id=UA-118965717-3"></script>
    <script>
      window.dataLayer = window.dataLayer || [];

      function gtag() {
        dataLayer.push(arguments);
      }
      gtag('js', new Date());
      // Shared ID
      gtag('config', 'UA-118965717-3');
      // Bootstrap ID
      gtag('config', 'UA-118965717-5');
    </script>
  </head>
  <body class="app header-fixed sidebar-fixed aside-menu-fixed sidebar-lg-show">
    <header class="app-header navbar">
      <button class="navbar-toggler sidebar-toggler d-lg-none mr-auto" type="button" data-toggle="sidebar-show">
        <span class="navbar-toggler-icon"></span>
      </button>
    </header>
    <div class="app-body">
      <div class="sidebar">
        <nav class="sidebar-nav">
          <ul class="nav">
            
            <li class="nav-title">Team Management</li>
            <li class="nav-item">
              <a class="nav-link" href="admin-addteam.php">
                <i class="nav-icon fa fa-user-friends"></i> Add Team</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="admin-viewteam.php">
                <i class="nav-icon fa fa-list-alt"></i> View Teams</a>
            </li>
            <li class="nav-title">Sports Management</li>
            <li class="nav-item">
              <a class="nav-link" href="admin-addsport.php">
                <i class="nav-icon fa fa-basketball-ball"></i> Add Sport</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="admin-viewsport.php">
                <i class="nav-icon fa fa-list-alt"></i> View Sports</a>
            </li>
            <li class="nav-title">Player Management</li>
            <li class="nav-item">
              <a class="nav-link" href="admin-addplayer.php">
                <i class="nav-icon fa fa-user-plus"></i> Add Player</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="admin-viewplayer.php">
                <i class="nav-icon fa fa-list-alt"></i> View Directory</a>
            </li>
            <li class="nav-title">Event Management</li>
            <li class="nav-item">
              <a class="nav-link" href="admin-addevent.php">
                <i class="nav-icon fa fa-calendar-plus"></i> Add Event</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="admin-viewschedule.php">
                <i class="nav-icon fa fa-calendar-week"></i> View Schedule</a>
            </li>
            <li class="nav-item">
              <li class="nav-title">Account Management</li>
            <li class="nav-item">
              <a class="nav-link" href="admin-addaccount.php">
                <i class="nav-icon fa fa-user-circle"></i> Add Account</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="admin-viewaccount.php">
                <i class="nav-icon fa fa-calendar-week"></i> View Accounts</a>
            </li>
            <li class="nav-item">
              <li class="nav-title">Results Management</li>
            <li class="nav-item">
              <a class="nav-link" href="admin-addresult.php">
                <i class="nav-icon fa fa-pencil-alt"></i> Add New Results</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="admin-viewresult.php">
                <i class="nav-icon fa fa-th-list"></i> View Results</a>
            </li> 
            <li class="divider"></li>
            
            <li class="nav-item mt-auto">
            </li>
            <li class="nav-item">
              <a class="nav-link nav-link-danger" href="login.php" target="_top">
                <strong>LOGOUT</strong>
              </a>
            </li>
          </ul>
        </nav>
        
      </div>
      <main class="main">
        <!-- Breadcrumb-->
        
        <div class="container-fluid">
          <div class="row">
            <div class="animated fadeIn">
              <div class="jumbotron jumbotron-fluid">
                <div class="container">
                  <h1 class="display-3"><?php if(isset($_POST['edit'])) echo "Edit Account Details."; else echo "Add a New Account."?></h1>
                  <p class="lead">Fill in the necessary data below to <?php if(isset($_POST['edit'])) echo "edit account details."; else echo "add a new account.";?></p>
                 </div>
                 <form class="form-horizontal" action="<?php $_PHP_SELF; ?>" method="post" style="margin-left: 10%; margin-top: 10%;">
                      <div class="form-group row">
                        <label class="col-md-3 col-form-label" for="hf-email">Email</label>
                        <div class="col-md-9">
                          <input class="form-control" id="hf-email" type="email" name="email" placeholder="Enter Email.." required value="<?php if(isset($_POST['edit'])) echo $_POST['oldEmail'];?>">
                          <span class="help-block">Please enter your email</span>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-md-3 col-form-label" for="hf-email">Username</label>
                        <div class="col-md-9">
                          <input class="form-control" id="hf-email" type="text" name="username" placeholder="Enter Username.." required value="<?php if(isset($_POST['edit'])) echo $_POST['oldUsername'];?>">
                          <span class="help-block">Please enter a username</span>
                        </div>
                      </div>

                      <div class="form-group row">
                        <label class="col-md-3 col-form-label" for="hf-password">Password</label>
                        <div class="col-md-9">
                          <input class="form-control" id="hf-password" type="<?php if(isset($_POST['edit'])) echo "text"; else echo "password"; ?>" name="password" placeholder="Enter Password.." required value="<?php if(isset($_POST['edit'])) echo $_POST['oldPassword'];?>">
                          <span class="help-block">Please enter your password</span>
                        </div>
                      </div>
                      <div>
                        <input class="btn btn-sm btn-primary" type="submit" name="<?php if(isset($_POST['edit'])) echo "editSub"; else echo "submit";?>" value="<?php if(isset($_POST['edit'])) echo "Edit"; else echo "Submit";?>"/>
                        <button class="btn btn-sm btn-danger" type="reset">
                          Reset</button>
                      </div>
                    </form>
              </div>



            </div>
          </div>`          
            
    <!-- CoreUI and necessary plugins-->
    <script src="node_modules/jquery/dist/jquery.min.js"></script>
    <script src="node_modules/popper.js/dist/umd/popper.min.js"></script>
    <script src="node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="node_modules/pace-progress/pace.min.js"></script>
    <script src="node_modules/perfect-scrollbar/dist/perfect-scrollbar.min.js"></script>
    <script src="node_modules/@coreui/coreui/dist/js/coreui.min.js"></script>
    <!-- Plugins and scripts required by this view-->
    <script src="node_modules/chart.js/dist/Chart.min.js"></script>
    <script src="node_modules/@coreui/coreui-plugin-chartjs-custom-tooltips/dist/js/custom-tooltips.min.js"></script>
    <script src="js/main.js"></script>
  </body>
</html>
<?php
  }
?>
