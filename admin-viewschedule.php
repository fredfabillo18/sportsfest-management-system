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
  }
  else {
     if(isset($_POST['delete'])) {
      $name = $_POST['name'];
      $sql2 = "delete from tblevents where name = '$name' ";
      mysqli_query($con, $sql2); 
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
                  <h1 class="display-3">List of Upcoming Events</h1>
                  <p class="lead"></p>
                 </div>
                 <table>
                  <tr>
                    <th>
                  <form action="<?php $_PHP_SELF; ?>">
                    <button class="btn btn-sm btn-primary" type="submit" name="day1" value = "day1">
                    Day 1</button>
                  </form>
                </th>
                 <th>
                  <form action="<?php $_PHP_SELF; ?>">
                    <button class="btn btn-sm btn-primary" type="submit" name="day2" value = "day2">
                    Day 2</button>
                  </form>
                   </th>
                     <th>
                  <form action="<?php $_PHP_SELF; ?>">
                    <button class="btn btn-sm btn-primary" type="submit" name="day3" value = "day3">
                    Day 3</button>
                  </form>
                   </th>
                     <th>
                  <form action="<?php $_PHP_SELF; ?>">
                    <button class="btn btn-sm btn-primary" type="submit" name="day4" value = "day 4">
                    Day 4</button>
                  </form>
                   </th>
                     <th>
                  <form action="<?php $_PHP_SELF; ?>">
                    <button class="btn btn-sm btn-primary" type="submit" name="day5" value = "day 5">
                    Day 5</button>
                  </form>
                   </th>
                </tr>
                </table> 
        <table cellspacing="0" cellpadding="5" width = "100%">
        <tr style="font-weight: bold; font-size: 1em;">
          <th>Name </th>
          <th>Starting Time </th>
          <th>Ending Time </th>
          <th>Event Location </th>
         
        </tr>
        <?php
         if(isset($_GET['day1'])) {    
        $sql1 = "select * from tblevents where day = 'Day 1' order by name";
        $query = mysqli_query($con, $sql1);
        echo "<br>" ;   
        echo " <h3 class='display-3'>Day 1</h3>";
          while($data = mysqli_fetch_array($query)) {
            echo "<tr>";
            echo "<td>".$data['name']."</td>";
            echo "<td>".$data['startTime']."</td>";
            echo "<td>".$data['endTime']."</td>";
            echo "<td>".$data['location']."</td>";
            echo "<td>";
            ?>
             <br>
        <form action="<?php $_PHP_SELF; ?>" method="POST">
           <input type="hidden" name="name" value="<?php echo $data['name'];?>"/>
            <button class="btn btn-sm btn-primary" type="submit" name="delete" value = "Delete">Delete</button>
        </form>
            <?php
          }
          ?>
          <?php
        }
        else if(isset($_GET['day2'])) {    
        $sql1 = "select * from tblevents where day = 'Day 2' order by name";
        $query = mysqli_query($con, $sql1);  
        echo "<br>" ;
         echo " <h3 class='display-3'>Day 2</h3>"; 
          while($data = mysqli_fetch_array($query)) {
            echo "<tr>";
            echo "<td>".$data['name']."</td>";
            echo "<td>".$data['startTime']."</td>";
            echo "<td>".$data['endTime']."</td>";
            echo "<td>".$data['location']."</td>";
            echo "<td>";
          ?>
             <br>
        <form action="<?php $_PHP_SELF; ?>" method="POST">
          <input type="hidden" name="name" value="<?php echo $data['name'];?>"/>
            <button class="btn btn-sm btn-primary" type="submit" name="delete" value = "Delete">Delete</button>
        </form>
            <?php
          }
          ?>
          <?php
        }
         else if(isset($_GET['day3'])) {    
        $sql1 = "select * from tblevents where day = 'Day 3' order by name";
        $query = mysqli_query($con, $sql1);  
        echo "<br>" ;
         echo " <h3 class='display-3'>Day 3</h3>"; 
          while($data = mysqli_fetch_array($query)  ) {
            echo "<tr>";
            echo "<td>".$data['name']."</td>";
            echo "<td>".$data['startTime']."</td>";
            echo "<td>".$data['endTime']."</td>";
            echo "<td>".$data['location']."</td>";
            echo "<td>";
         ?>
             <br>
        <form action="<?php $_PHP_SELF; ?>" method="POST">
          <input type="hidden" name="name" value="<?php echo $data['name'];?>"/>
            <button class="btn btn-sm btn-primary" type="submit" name="delete" value = "Delete">Delete</button>
        </form>
            <?php
          }
          ?>
          <?php
        }
         else if(isset($_GET['day4'])) {    
        $sql1 = "select * from tblevents where day = 'Day 4' order by name";
        $query = mysqli_query($con, $sql1); 
        echo "<br>";   
         echo " <h3 class='display-3'>Day 4</h3>";
          while($data = mysqli_fetch_array($query)) {
            echo "<tr>";
            echo "<td>".$data['name']."</td>";
            echo "<td>".$data['startTime']."</td>";
            echo "<td>".$data['endTime']."</td>";
            echo "<td>".$data['location']."</td>";
            echo "<td>";
          ?>
             <br>
        <form action="<?php $_PHP_SELF; ?>" method="POST">
          <input type="hidden" name="name" value="<?php echo $data['name'];?>"/>
            <button class="btn btn-sm btn-primary" type="submit" name="delete" value = "Delete">Delete</button>
        </form>
            <?php
          }
          ?>
          <?php
        }
         else if(isset($_GET['day5'])) {    
        $sql1 = "select * from tblevents where day = 'Day 5' order by name";
        $query = mysqli_query($con, $sql1); 
        echo "<br>" ; 
         echo " <h3 class='display-3'>Day 5</h3>"; 
          while($data = mysqli_fetch_array($query)) {
            echo "<tr>";
            echo "<td>".$data['name']."</td>";
            echo "<td>".$data['startTime']."</td>";
            echo "<td>".$data['endTime']."</td>";
            echo "<td>".$data['location']."</td>";
            echo "<td>";
            ?>
            <form action="<?php $_PHP_SELF; ?>" method="POST">
          <input type="hidden" name="name" value="<?php echo $data['name'];?>"/>
            <button class="btn btn-sm btn-primary" type="submit" name="delete" value = "Delete">Delete</button>
        </form>
            <?php
          }
        }

          echo "</td>";
           echo "</tr>";
        ?>
          
             
        <br>
        
        <?php 
         
          

        ?>
      </table>
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