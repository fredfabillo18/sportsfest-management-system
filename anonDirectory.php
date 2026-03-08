<?php
session_start();

$con = mysqli_connect('localhost','root','','sf_dashboard');
if(mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: ".mysqli_connect_error();
}
else{
  if(isset($_POST['displayall'])){
    header('location:anonDirectory.php');
  }
  else if(isset($_POST['search'])){
    $searchedname = $_POST['searched'];
    $sql = "select * from players where lastname='$searchedname'";
  }
  else{
    $sql = "select * from players";
  }
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
    #displayall{
      width: 27%;
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
          <div class="row">
            <div class="animated fadeIn">
              <div class="jumbotron jumbotron-fluid">
              <div class="container">
                <h1 class="display-3">Player Directory</h1>
                <p class="lead">This is the official PSHS-EVC Sportsfest Admin Dashboard for Sportsfest <?php echo date("Y");?>.</p>
                <div class="card">
                  <div class="card-header">
                    <strong>Tools</strong></div>
                  <div class="card-body">
                    <form class="form-horizontal" action="<?php $_PHP_SELF; ?>" method="post">
                      <div class="form-group row">
                        <label class="col-md-3 col-form-label">Search</label>
                        <div class="col-md-9">
                          <input class="form-control" name="searched" value="<?php if(isset($_POST['search'])) echo $_POST['searched']; ?>" placeholder="Enter last name..." required>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-md-3 col-form-label"></label>
                        <div class="col-md-9">
                          <input class="btn btn-sm btn-primary" name="search" value="Search" type="submit">
                            <i class="fa fa-dot-circle-o"></i>
                          <input class="btn btn-sm btn-danger" value="Clear" type="reset">
                        </div>
                      </div>
                    </form>
                    <form action="<?php $_PHP_SELF; ?>">
                      <div class="form-group row">
                        <label class="col-md-3 col-form-label"></label>
                        <div class="col-md-9">
                          <input id="displayall" class="btn btn-sm btn-primary" name="search" value="Display All" type="submit">
                            <i class="fa fa-dot-circle-o"></i>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
                <div class="card">
                  <div class="card-header">
                    <i class="fa fa-align-justify"></i> <strong>Players</strong></div>
                  <div class="card-body">
                    <table class="table table-responsive-sm table-striped" cellpadding="">
                      <thead>
                        <th>Name</th>
                        <th>Team</th>
                        <th>Major Sport</th>
                        <th>Minor Sport</th>
                        <th>Junior Sport</th>
                      </thead>
                      <?php
                        while($data = mysqli_fetch_array($query)){
                          echo "<tr>";
                          echo "<td>".$data['firstname']." ".$data['lastname']."</td>";
                          echo "<td>".$data['team']."</td>";
                          echo "<td>".$data['major']."</td>";
                          if($data['minor']==""||$data['minor2']==""){
                            $decoy=$data['minor'].$data['minor2'];
                            echo "<td>".$decoy."</td>";
                          }
                          else
                            echo "<td>".$data['minor']."<br>".$data['minor2']."</td>"; //insert minor2
                          if($data['junior']==""||$data['junior2']=="") {
                            $decoy=$data['junior'].$data['junior2'];
                            echo "<td>".$decoy."</td>";
                          }
                          else
                            echo "<td>".$data['junior']."<br>".$data['junior2']."</td>"; //insert junior2
                          echo "</tr>";
                        }
                      ?>
                    </table>
                  </div>
                </div>

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
