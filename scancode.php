<html>
<head>
  <title>Scanner</title>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="css/bootstrap.min.css" />
  <link rel="stylesheet" href="css/style.css" />
  <link rel="stylesheet" href="css/bootstrap-responsive.min.css" />
  
  <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,800' rel='stylesheet' type='text/css'>
  
  <script type="text/javascript" src="js/jquery-3.0.0.min.js"></script>
  <script type="text/javascript" src="js/zxing.js"></script>
  <script type="text/javascript" src="js/camera.js"></script>
  <script type="text/javascript" src="js/qr.js"></script>
  <script type="text/javascript" src="js/material.min.js"></script>
  <script type="text/javascript" src="js/clipboard.min.js"></script>
  <script type="text/javascript" src="js/store.min.js"></script>
  <script type="text/javascript" src="js/visibility.min.js"></script>
  <script type="text/javascript" src="js/FileSaver.min.js"></script>
  <script type="text/javascript" src="js/vue.min.js"></script>
  <style>
        
        body{
            background-color: blue;
        }
        td{
            background-color: graytext;
        }
        
    </style>
</head>
<body id="app">
<div id="logo">
    <a class="navbar-brand" href="#"><h2><font color="blue"> Online</font><font color="gold">Attendance</h2></font></font></a>
    <ul class="nav navbar-nav container-fluid">
      <div class="btn-group" id="menu1">
        <button class="btn">Menu</button>
        <button data-toggle="dropdown" class="btn dropdown-toggle"><span class="caret"></span></button>
        <ul class="dropdown-menu">
              <li><a href="scanhistory">Scan History</a></li>
              <li><a href="setscantime.php">Scan Time</a></li>
              <li><a href="individualreport.php">Individual Report</a></li>
              <li><a href="Groupreport.php">Group Report</a></li>
              <li><a href="initialization.php">Task Initializations</a></li>
              <li class="active"><a href="managedatabase.php">Manage Data</a></li>
              <li class="divider"></li>
              <li><a href="frofile.php">Manage Profile</a></li>
              <li><a href="logout.php">Logout</a></li>
        </ul>
      </div>
   </ul>
</div>
<nav id="menu" class="navbar navbar-default " >
    <ul class="nav navbar-nav container-fluid">
    </ul>
</nav>
        <form>
            <table align="center" class="table table-bordered data-table table-striped">
              <tr>
			  <th>
			     <div class="checkbox switch">
                  <label for="play-audio">
                    <input class="access-hide" id="play-audio" name="play-audio" type="checkbox" v-model="playAudio"><span class="switch-toggle"></span>
                    Afer Scan Aleart
                  </label>
                </div>
			  </th>
			  <th>
			     <div class="checkbox switch">
                  <label for="http-action">
                    <input class="access-hide" id="http-action" name="http-action" type="checkbox" v-model="httpAction.enabled"><span class="switch-toggle"></span>
                    Auto Process
                  </label>
                  
                </div>
			  </th>
			  <th>
			     <div class="radiobtn radiobtn-adv">
                  <label for="link-new-tab">
                    <input class="access-hide" id="link-new-tab" name="link" type="radio" value="new-tab" v-model="linkAction">
                    New Tab
                    <span class="radiobtn-circle"></span><span class="radiobtn-circle-check"></span>
                  </label>
                </div>
			  </th>
			  <th>
			     <div class="radiobtn radiobtn-adv">
                  <label for="link-current-tab">
                    <input class="access-hide" id="link-current-tab" name="link" type="radio" value="current-tab" v-model="linkAction">
                   Current Tab
                    <span class="radiobtn-circle"></span><span class="radiobtn-circle-check"></span>
                  </label>
                </div>
			  </th>
			  </tr>
              <tr>
			  <td colspan="4"><center><div id="camera"/></div></center></td>
			  </tr>
			  <tr>
			  <td colspan="4"><center><h5>Place Yor Code Inside The Box</h5></center></td>
			  </tr>
              </table>
          </form>
      <script type="text/javascript" src="js/app.js"></script>
</body>
</html>
