
<!DOCTYPE html>


<html>
  <head>
    
    <title>Scanner</title>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="css/bootstrap.min.css" />
  <link rel="stylesheet" href="css/style.css" />
  <link rel="stylesheet" href="css/bootstrap-responsive.min.css" />
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,800' rel='stylesheet' type='text/css'>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/webrtc-adapter/3.3.3/adapter.min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.1.10/vue.min.js"></script>
   <script type="text/javascript" src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>
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
  
  
  </head>
  <body class="app header-fixed sidebar-fixed aside-menu-fixed sidebar-lg-show">
    <header class="app-header navbar">
       <a href="#"><h2><font color="blue"> Online</font><font color="gold">Attendance</h2></font></font></a>
    </header>
    <div class="app-body">
      <div class="sidebar">
        <nav class="sidebar-nav">
          <ul class="nav">
		  <?php
		 session_start();
		  if(isset($_SESSION['adminstrative'])){
			  
				?>	
          <li class="nav-item  btn-primary"><a class="nav-link" href="admin/admin_home.php"><i class="fa fa-home"></i> <span>Dashboard Scanning</span></a></li>
            <?php 
		  }			
			if(isset($_SESSION['employee'])){
				?>
				<li class="nav-item  btn-primary"><a class="nav-link" href="supervisor/supervisor_home.php"><i class="fa fa-home"></i> <span>Dashboard Scanning</span></a></li>
			<?php
			}
				?>	
          </ul>
        </nav>  
      </div>
      <main class="main">
          <ol class="breadcrumb">
              
          <li class="breadcrumb-item">
              <strong></strong>
          </li>
          
          </ol>
          
        <div class="container-fluid">
          <div class="animated fadeIn">
              
                 <form>
            <table align="center" class="table table-bordered data-table table-striped">
              <tr>
			  <th>
			     <div class="checkbox switch">
                  <label for="play-audio">
                     Alert<input class="access-hide" id="play-audio" name="play-audio" type="checkbox" v-model="playAudio">
                   
                  </label>
                </div>
			  </th>
			  <th>
			     <div class="checkbox switch">
                  <label for="http-action">
                    Process<input class="access-hide" id="http-action" name="http-action" type="checkbox" v-model="httpAction.enabled">
                    
                  </label>
                  
                </div>
			  </th>
			  <th>
			     <div class="radiobtn radiobtn-adv">
                  <label for="link-new-tab">
                    New Tab<input class="access-hide" id="link-new-tab" name="link" type="radio" value="new-tab" v-model="linkAction">
                    
                    
                  </label>
                </div>
			  </th>
			  <th>
			     <div class="radiobtn radiobtn-adv">
                  <label for="link-current-tab">
                   Current Tab <input class="access-hide" id="link-current-tab" name="link" type="radio" value="current-tab" v-model="linkAction">
                   
                    
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
              
          </div>
        </div>
        
        
      </main>
      
    </div>
    
    </body>
</html>


