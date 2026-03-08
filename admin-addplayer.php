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
        $duplicateMinor = false;
        $duplicateJunior = false;
        $lastname = $_POST['lastname'];
        $firstname = $_POST['firstname'];
        $team = $_POST['team'];
        $major = $_POST['major'];
        $minor1 = $_POST['minor1'];
        $minor2 = $_POST['minor2'];
        $junior1 = $_POST['junior1'];
        $junior2 = $_POST['junior2'];
        if(($minor1 == $minor2 || $junior1 == $junior2)) {
          if($minor1 != "N/A" && $minor2 != "N/A") 
            $duplicateMinor = true;
          else
            $duplicateMinor = false;
          if($junior1 != "N/A" && $junior2 != "N/A")
            $duplicateJunior = true;
          else
            $duplicateJunior = false;
        }
        if($duplicateMinor == false && $duplicateJunior == false) { 
          $getNumber = "select number from playercount";
          $count = mysqli_query($con, $getNumber);
          $number = mysqli_fetch_array($count);
          $actual = $number['number'];
          $addNumber = "update playercount set number=$actual+1";
          $addPlayer = "insert into players values('$actual','$lastname','$firstname','$team','$major','$minor1','$minor2','$junior1','$junior2')";
          mysqli_query($con, $addNumber);
          mysqli_query($con, $addPlayer);
          echo "<script>alert('Player succesfully added!');</script>";
        }else {
          echo "<script>alert('Duplication of Sport!');</script>";
        }
      }
      if(isset($_POST['editSub'])) {
        $duplicateMinor = false;
        $duplicateJunior = false;
        $playerNum = $_POST['playernum'];
        $newLastName = $_POST['lastname'];
        $newFirstName = $_POST['firstname'];
        $newTeam = $_POST['team'];
        $newMajor = $_POST['major'];
        $newMinor1 = $_POST['minor1'];
        $newMinor2 = $_POST['minor2'];
        $newJunior1 = $_POST['junior1'];
        $newJunior2 = $_POST['junior2'];
        if(($newMinor1 == $newMinor2 || $newJunior1 == $newJunior2)) {
          if($newMinor1 != "N/A" && $newMinor2 != "N/A") 
            $duplicateMinor = true;
          else
            $duplicateMinor = false;
          if($newJunior1 != "N/A" && $newJunior2 != "N/A")
            $duplicateJunior = true;
          else
            $duplicateJunior = false;
        }
        if($duplicateMinor == false && $duplicateJunior == false) {
          $update = "update players set lastname='$newLastName', firstname='$newFirstName', team='$newTeam', major='$newMajor', minor='$newMinor1', minor2='$newMinor2', junior='$newJunior1', junior2='$newJunior2' where playernum='$playerNum'";
          mysqli_query($con, $update);
          echo "<script>alert('Player succesfully edited!');</script>";
        }else {
          echo "<script>alert('Duplication of Sport!');</script>";
        }
        

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
                  <h1 class="display-3">Add a New Player.</h1>
                  <p class="lead">Fill in the necessary data below to add a new player to the roster.</p>
                 </div>
                 <form class="form-horizontal" action="" method="post" style="margin-left: 10%; margin-top: 10%;">
                      <?php
                        if(isset($_POST['edit'])) {
                          ?>
                          <input type="hidden" value="<?php echo $_POST['num'];?>" name="playernum"/>
                      <?php
                        }
                      ?>
                      <div class="form-group row">
                        <label class="col-md-3 col-form-label" for="hf-email">Last Name</label>
                        <div class="col-md-9">
                          <input class="form-control" id="hf-email" type="text" name="lastname" placeholder="Enter Last Name.." required value="<?php if(isset($_POST['edit'])) echo $_POST['oldLName'];?>">
                          <span class="help-block">Please enter a player's last name.</span>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-md-3 col-form-label" for="hf-email">First Name</label>
                        <div class="col-md-9">
                          <input class="form-control" id="hf-email" type="text" name="firstname" placeholder="Enter First Name.." required value="<?php if(isset($_POST['edit'])) echo $_POST['oldFName'];?>">
                          <span class="help-block">Please enter a player's first name.</span>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-md-3 col-form-label" for="select1">Player's Team</label>
                        <div class="col-md-9">
                          <select class="form-control" id="select1" name="team" required>
                            <option value="">Please select a team</option>
                            <?php
                              $getTeams = "select name from teams";
                              $teamData = mysqli_query($con, $getTeams);
                              while($data = mysqli_fetch_array($teamData)){
                                $value = $data['name'];
                                if(isset($_POST['edit']) && $value == $_POST['oldTeam']) {
                                  echo "<option selected value='$value'>$value</option>";
                                }
                                else
                                  echo "<option value='$value'>$value</option>";
                              }
                            ?>
                          </select>
                          <span class="help-block">Please select player's team.</span>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-md-3 col-form-label" for="select1">Major Sport</label>
                        <div class="col-md-9">
                          <select class="form-control" id="select1" name="major" required>
                            <option value="N/A">N/A</option>
                            <?php
                              $getSports = "select sport from sports where type='major'";
                              $sportsData = mysqli_query($con, $getSports);
                              while($data = mysqli_fetch_array($sportsData)){
                                $value = $data['sport'];
                                if(isset($_POST['edit']) && $value == $_POST['oldMajor']) {
                                  echo "<option selected value='$value'>$value</option>";
                                }
                                else
                                  echo "<option value='$value'>$value</option>";
                              }
                            ?>
                          </select>
                          <span class="help-block">Please select player's major sport.</span>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-md-3 col-form-label" for="select1">Minor Sport</label>
                        <div class="col-md-9">
                          <select class="form-control" id="select1" name="minor1" required>
                            <option value="N/A">N/A</option>
                            <?php
                              $getSports = "select sport from sports where type='minor'";
                              $sportsData = mysqli_query($con, $getSports);
                              while($data = mysqli_fetch_array($sportsData)){
                                $value = $data['sport'];
                                if(isset($_POST['edit']) && $value == $_POST['oldMinor']) {
                                  echo "<option selected value='$value'>$value</option>";
                                }
                                else
                                  echo "<option value='$value'>$value</option>";
                              }
                            ?>
                          </select>
                          <select class="form-control" id="select1" name="minor2" style="margin-top: 3%;" required>
                            <option value="N/A">N/A</option>
                            <?php
                              $getSports = "select sport from sports where type='minor'";
                              $sportsData = mysqli_query($con, $getSports);
                              while($data = mysqli_fetch_array($sportsData)){
                                $value = $data['sport'];
                                if(isset($_POST['edit']) && $value == $_POST['oldMinor2']) {
                                  echo "<option selected value='$value'>$value</option>";
                                }
                                else
                                  echo "<option value='$value'>$value</option>";
                              }
                            ?>
                          </select>
                          <span class="help-block">Please select player's minor sports (Up to 2).</span>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-md-3 col-form-label" for="select1">Junior Sport</label>
                        <div class="col-md-9">
                          <select class="form-control" id="select1" name="junior1" required>
                            <option value="N/A">N/A</option>
                            <?php
                              $getSports = "select sport from sports where type='junior'";
                              $sportsData = mysqli_query($con, $getSports);
                              while($data = mysqli_fetch_array($sportsData)){
                                $value = $data['sport'];
                                if(isset($_POST['edit']) && $value == $_POST['oldJunior']) {
                                  echo "<option selected value='$value'>$value</option>";
                                }
                                else
                                  echo "<option value='$value'>$value</option>";
                              }
                            ?>
                          </select>
                          <select class="form-control" id="select1" name="junior2" style="margin-top: 3%;" required>
                            <option value="N/A">N/A</option>
                            <?php
                              $getSports = "select sport from sports where type='junior'";
                              $sportsData = mysqli_query($con, $getSports);
                              while($data = mysqli_fetch_array($sportsData)){
                                $value = $data['sport'];
                                if(isset($_POST['edit']) && $value == $_POST['oldJunior2']) {
                                  echo "<option selected value='$value'>$value</option>";
                                }
                                else
                                  echo "<option value='$value'>$value</option>";
                              }
                            ?>
                          </select>
                          <span class="help-block">Please select player's junior sports (Up to 2).</span>
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