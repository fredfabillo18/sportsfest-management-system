<?php
session_start();
 $ends = array('th','st','nd','rd','th','th','th','th','th','th');

$con = mysqli_connect('localhost','root','','sf_dashboard');
if(isset($_SESSION['login']))
      unset($_SESSION['login']);
if(mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: ".mysqli_connect_error();
}
else{
  $clearResults = "update teams set score=0";
  mysqli_query($con, $clearResults);
  $count = "select name from teams";
  $countData = mysqli_query($con, $count);
  $numTeams = 0;
  while($data = mysqli_fetch_array($countData)) {
    $numTeams++;
  }
  $places = array();
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
  $getResults = "select * from results";
  $resultsData = mysqli_query($con, $getResults);
  while($data = mysqli_fetch_array($resultsData)) {
    $temp = $numTeams;
    foreach($places as $place) {
      if($data['type'] == "Major") {
        
        $team = $data[$place];
        $type = $data['type'];
        $getOldScore = "select score from teams where name='$team'";
        $scoreData = mysqli_query($con, $getOldScore);
        while($data2 = mysqli_fetch_array($scoreData))
          $score = $data2['score'];
        $score += 50*$temp;
        $updateScore = "update teams set score=$score where name='$team'";
        mysqli_query($con, $updateScore);
        $temp--;
      }
      if($data['type'] == "Minor") {
        
        $team = $data[$place];
        $type = $data['type'];
        $getOldScore = "select score from teams where name='$team'";
        $scoreData = mysqli_query($con, $getOldScore);
        while($data2 = mysqli_fetch_array($scoreData))
          $score = $data2['score'];
        $score += 30*$temp;
        $updateScore = "update teams set score=$score where name='$team'";
        mysqli_query($con, $updateScore);
        $temp--;
      }
      if($data['type'] == "Junior") {
        
        $team = $data[$place];
        $type = $data['type'];
        $getOldScore = "select score from teams where name='$team'";
        $scoreData = mysqli_query($con, $getOldScore);
        while($data2 = mysqli_fetch_array($scoreData))
          $score = $data2['score'];
        $score += 10*$temp;
        $updateScore = "update teams set score=$score where name='$team'";
        mysqli_query($con, $updateScore);
        $temp--;
      }
    }
  }


  $sql = "select * from teams";
  $query = mysqli_query($con, $sql);

 ?>

<!DOCTYPE html>
<!--
* CoreUI - Free Bootstrap Admin Template
* @version v2.1.12
* @link https://coreui.io
* Copyright (c) 2018 creativeLabs Łukasz Holeczek
* Licensed under MIT (https://coreui.io/license)
-->

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
    <style>
    .playerTable{
      margin: auto;
      width: 100%;
    }
    .playerTable tr:nth-child(odd) {
    	  background-color: #f5f5f5;
    }

    /* Background-color of the even rows */
    .playerTable tr:nth-child(even) {
    	  background-color: white;
    }
    </style>
  </head>
  <body class="app header-fixed sidebar-fixed aside-menu-fixed sidebar-lg-show">
    
    <div class="app-body">
      <div class="sidebar">
        <nav class="sidebar-nav">
          <ul class="nav">

            <li class="nav-item">
              <a class="nav-link" href="anonScores.php">
                <i class="nav-icon fa fa-list-alt"></i> Scores</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="anonDirectory.php">
                <i class="nav-icon fa fa-list-alt"></i> Player Directory</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="anon-viewschedule.php">
                <i class="nav-icon fa fa-calendar-week"></i> Schedule</a>
            </li>

            <li class="nav-item">
              <a class="nav-link nav-link-success" href="login.php" target="_top">
                <strong>LOGIN</strong>
              </a>
            </li>
          </ul>
        </nav>

      </div>
      <main class="main">
        <!-- Breadcrumb-->

        <div class="container-fluid">
          <div class="animated fadeIn">
            <div class="row">
              <div class="jumbotron jumbotron-fluid">
              <div class="container">
                <h1 class="display-3">Welcome!</h1>
                <p class="lead">This is the official PSHS-EVC Sportsfest Admin Dashboard for Sportsfest <?php echo date("Y");?>.</p>
                <?php
                  while($data = mysqli_fetch_array($query)){

                ?>
                <div class="col-sm-6 col-md-4">
                  <div class="card">
                    <div class="card-header" style="text-align: ; font-weight: bold; border-left: 30px solid <?php echo $data['color']; ?>;"><?php echo $data['name']; ?></div>
                    <div class="card-body"><h2><?php echo $data['score']; ?><h2></div>
                  </div>
                </div>
                <?php
                  }
                ?>
               </div>
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
