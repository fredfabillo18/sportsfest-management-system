<!DOCTYPE html>
<!--
* CoreUI - Free Bootstrap Admin Template
* @version v2.1.12
* @link https://coreui.io
* Copyright (c) 2018 creativeLabs Łukasz Holeczek
* Licensed under MIT (https://coreui.io/license)
-->
<?php
      $con = mysqli_connect('localhost','root','','sf_dashboard');
      session_start();
      $places = array();
      $ends = array('th','st','nd','rd','th','th','th','th','th','th');
      $count = "select name from teams";
      $countData = mysqli_query($con, $count);
      $numTeams = 0;
      while($data = mysqli_fetch_array($countData)) {
        $numTeams++;
      }
      for ($i = 1; $i <= $numTeams; $i++) {   
          if (($i %100) >= 11 && ($i%100) <= 13) {
            $abbreviation = $i. 'th';
            array_push($places, $abbreviation); 
          }
          else {
            $abbreviation = $i. $ends[$i % 10];
            array_push($places, $abbreviation);
          }
      }
    if(!isset($_SESSION['login']))
      header('location:login.php');
    $con = mysqli_connect('localhost','root','','sf_dashboard');
    if(mysqli_connect_errno()) {
      echo "Failed to connect to MySQL: ".mysqli_connect_error();
    }else {
      if(isset($_POST['submit'])) {
        $dupValues = false;
        for($i = 0; $i < $numTeams; $i++) {
          $places[$i] = $_POST[$places[$i]];
        }
        for($i = 0; $i < $numTeams; $i++) {
          for($j = 0; $j < $numTeams; $j++) {
            if($places[$i] == $places[$j] && $i != $j) {
              $dupValues = true;
            }
          }
        }
        if($dupValues==true) {
          echo "<script>alert('Duplicate Values');</script>";
        }else {
            $sport = $_POST['sport'];
            $getType = "select type from sports where sport='$sport'";
            $typeData = mysqli_query($con, $getType);
            while($data = mysqli_fetch_array($typeData)) {
              $type = $data['type'];
            }
            $addResult = "insert into results values('$sport','$type'";
            foreach($places as $team) {
              $addResult = $addResult.",'".$team."'";
            }
            $addResult = $addResult.")";
            mysqli_query($con, $addResult);
             echo "<script>alert('Result succesfully added!');</script>";
             header('location:admin-viewresult.php');
        }

      }
    

      if(isset($_POST['editSub'])) {
        $newName = $_POST['sport'];
        $oldName = $_POST['oldName'];
        $dupValues = false;
        for($i = 0; $i < $numTeams; $i++) {
          $places[$i] = $_POST[$places[$i]];
        }
        for($i = 0; $i < $numTeams; $i++) {
          for($j = 0; $j < $numTeams; $j++) {
            if($places[$i] == $places[$j] && $i != $j) {
              $dupValues = true;
            }
          }
        }
        if($dupValues==true) {
          echo "<script>alert('Duplicate Values');</script>";
        }else {
            $sport = $_POST['sport'];
            $getType = "select type from sports where sport='$sport'";
            $typeData = mysqli_query($con, $getType);
            while($data = mysqli_fetch_array($typeData)) {
              $newType = $data['type'];
            }
            $addResult = "update results set game='$newName', type='$newType'";
            for($i = 1; $i <= $numTeams; $i++) {
              if (($i %100) >= 11 && ($i%100) <= 13) {
                $abbreviation = $i. 'th';
                $addResult = $addResult.", ".$abbreviation."='".$_POST[$abbreviation]."'";
              }
              else {
                $abbreviation = $i. $ends[$i % 10];
                $addResult = $addResult.", ".$abbreviation."='".$_POST[$abbreviation]."'";
              }
            }
            $addResult = $addResult." where game='$oldName'";
            mysqli_query($con, $addResult);
             echo "<script>alert('Result succesfully edited!');</script>";
            header('location:admin-viewresult.php');

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
    <!--<header class="app-header navbar">
      <button class="navbar-toggler sidebar-toggler d-lg-none mr-auto" type="button" data-toggle="sidebar-show">
        <span class="navbar-toggler-icon"></span>
      </button>
    </header>-->
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
              <a class="nav-link nav-link-danger" href="login.php" target="_top">asd
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
                  <h1 class="display-3"><?php if(isset($_POST['edit'])) echo "Edit Results."; else echo"Add Results.";?></h1>
                  <p class="lead">Fill in the necessary data below to <?php if(isset($_POST['edit'])) echo "edit the result."; else echo"add a result to the list.";?></p>
                 </div>
                 <form class="form-horizontal" action="<?php $_PHP_SELF; ?>" method="post" style="margin-left: 10%; margin-top: 10%;">
                      <?php
                        if(isset($_POST['edit'])) {
                          ?>
                          <input type="hidden" value="<?php echo $_POST['name'];?>" name="oldName"/>
                      <?php
                          for ($i = 1; $i <= $numTeams; $i++) {   
                            if (($i %100) >= 11 && ($i%100) <= 13) {
                              $abbreviation = $i. 'th';
                              $val = $_POST[$abbreviation];
                              echo "<input type='hidden' value='$val' name='$abbreviation'/>";
                            }
                            else {
                              $abbreviation = $i. $ends[$i % 10];
                              $val = $_POST[$abbreviation];
                              echo "<input type='hidden' value='$val' name='$abbreviation'/>";
                            }
                          }
                        }
                      ?>

                      <div class="form-group row">
                        <label class="col-md-3 col-form-label" for="hf-email">Sport</label>
                        <div class="col-md-9">
                          <?php
                            if(isset($_POST['edit'])) {
                          ?>
                            <input type="hidden" name="sport" value="<?php echo $_POST['name'];?>"/>
                          <?php
                            }
                          ?>
                          <select class="form-control" id="select1" name="<?php if(isset($_POST['edit'])) echo "new"; else echo "sport"?>" required <?php if(isset($_POST['edit'])) echo "disabled";?>>
                            <option value="">Please select a sport</option>
                            <?php
                              $getSports = "select sport from sports";
                              $getGames = "select game from results";
                              $gameData = mysqli_query($con, $getGames);
                              $sportData = mysqli_query($con, $getSports);
                              $arrayAll = array();
                              $arrayRemove = array();
                              while($data = mysqli_fetch_array($sportData))
                                array_push($arrayAll, $data['sport']);
                              while($data = mysqli_fetch_array($gameData)) {
                                if(isset($_POST['edit']) && $data['game'] == $_POST['name']){
                                }
                                else 
                                  array_push($arrayRemove, $data['game']);
                              }
                              $arrayDisplay = array_diff($arrayAll, $arrayRemove);
                              foreach($arrayDisplay as $value) {
                                if(isset($_POST['edit']) && $value == $_POST['name'])
                                  echo "<option selected value='$value'>$value</option>";
                                else
                                  echo "<option value='$value'>$value</option>";
                              }
                            ?>
                          </select>
                          <span class="help-block">Please enter a sport</span>
                        </div>
                      </div>
                      <?php
                      $ends = array('th','st','nd','rd','th','th','th','th','th','th');
                        for($i = 1; $i <= $numTeams; $i++) {
                      ?>
                          <div class="form-group row">
                            <label class="col-md-3 col-form-label" for="hf-password"><?php if (($i %100) >= 11 && ($i%100) <= 13) {
                            $abbreviation = $i. 'th';
                            echo "<td>".$abbreviation."</td>";
                          }
                          else {
                            $abbreviation = $i. $ends[$i % 10];
                            echo "<td>".$abbreviation."</td>";
                          }?></label>
                            <div class="col-md-9">
                              <select class="form-control" id="select1" name="<?php if (($i %100) >= 11 && ($i%100) <= 13) {
                            $abbreviation = $i. 'th';
                            echo $abbreviation;
                          }
                          else {
                            $abbreviation = $i. $ends[$i % 10];
                            echo $abbreviation;
                          }?>" required>
                                <option value="">Please select a team</option>
                                <?php
                                  $getTeams = "select name from teams";
                                  $teamData = mysqli_query($con, $getTeams);
                                  while($data = mysqli_fetch_array($teamData)){
                                    $value = $data['name'];
                                    if(isset($_POST['edit']) && $value == $_POST[$abbreviation]) {
                                      echo "<option selected value='$value'>$value</option>";
                                    }
                                    else
                                      echo "<option value='$value'>$value</option>";
                                  }
                                ?>
                              </select>
                              <span class="help-block">Please choose a team</span>
                            </div>
                          </div>
                          <div>
                      <?php
                      }
                      ?>
                        <input class="btn btn-sm btn-primary" type="submit" name="<?php if(isset($_POST['edit'])) echo "editSub"; else echo "submit";?>" value="<?php if(isset($_POST['edit'])) echo "Edit"; else echo"Submit";?>"/>
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