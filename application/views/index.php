<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title><?php echo $this->session->userdata('title').' '.$title; ?></title>
    <link rel="icon" href="<?php echo base_url(); ?>/assets/img/favicon.ico" type="image/x-icon">
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Bootstrap 3.3.4 -->
    <link href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css'); ?>" rel="stylesheet" type="text/css" />    
    <!-- FontAwesome 4.4.0 -->
    <link href="<?php echo base_url('assets/dist/css/font-awesome/css/font-awesome.min.css'); ?>" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="<?php echo base_url('assets/dist/css/AdminLTE.min.css'); ?>" rel="stylesheet" type="text/css" />
    <!-- AdminLTE Skins. Choose a skin from the css/skins 
         folder instead of downloading all of them to reduce the load. -->
    <link href="<?php echo base_url('assets/dist/css/skins/skin-blue.min.css'); ?>" rel="stylesheet" type="text/css" />
    <!-- iCheck -->
    <link href="<?php echo base_url('assets/'); ?>/plugins/iCheck/flat/blue.css" rel="stylesheet" type="text/css" />
    <!-- jvectormap -->
    <link href="<?php echo base_url('assets/'); ?>/plugins/jvectormap/jquery-jvectormap-1.2.2.css" rel="stylesheet" type="text/css" />
    <!-- Date Picker -->
    <link href="<?php echo base_url('assets/'); ?>/plugins/datepicker/datepicker3.css" rel="stylesheet" type="text/css" />
    <!-- Daterange picker -->
    <link href="<?php echo base_url('assets/'); ?>/plugins/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
	
	<!-- jQuery 2.1.4 -->
    <script src="<?php echo base_url('assets/'); ?>/plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- jQuery UI 1.10.3 -->
    <script src="<?php echo base_url('assets/'); ?>/plugins/jQueryUI/jquery-ui-1.10.3.min.js" type="text/javascript"></script>
    <style type="text/css">
      .error-input-msg {
          display: block;
        position: relative;
        top: -4px;
        font: message-box;
        color: #CD141A;
        min-width: 50px;
        max-width: 300px;
        border: solid 1px #CD141A;
        background: #ffffff;
        padding: 8px;
        -webkit-border-radius: 8px;
        -webkit-box-shadow: 4px 4px 4px rgba(100,100,100,0.6),
            inset -2px -2px 1px #d0c4c4,
            inset 2px 2px 1px white;
        line-height: bold;
        z-index: 2147483644;
      }
    </style>
  </head>
  <body class="skin-blue sidebar-mini">
    <div class="wrapper">
      
      <header class="main-header">
        <!-- Logo -->
        <a href="<?php echo site_url(); ?>" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><i class="fa fa-shopping-cart"></i></span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg">MyInventory</span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <!-- User Account: style can be found in dropdown.less -->
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <img src="<?php echo !$this->session->userdata('userfile')? base_url('assets/img/no-avatar.png') : base_url('assets/upload').'/'.$this->session->userdata('username').'/'.$this->session->userdata('userfile'); ?>" class="user-image" alt="User Image"/>
                  <span class="hidden-xs"><?php echo $this->session->userdata('name'); ?></span>
                </a>
                <ul class="dropdown-menu">
                  <!-- User image -->
                  <li class="user-header">
                    <img src="<?php echo !$this->session->userdata('userfile')? base_url('assets/img/no-avatar.png') : base_url('assets/upload').'/'.$this->session->userdata('username').'/'.$this->session->userdata('userfile'); ?>" class="img-circle" alt="User Image" />
                    <p>
                      <?php echo $this->session->userdata('name'); ?>
                    </p>
                  </li>
                  <!-- Menu Footer-->
                  <li class="user-footer">
                    <div class="pull-right">
                      <a href="<?php echo site_url('login/signout') ?>" class="btn btn-default btn-flat">Sign out</a>
                    </div>
                  </li>
                </ul>
              </li>
            </ul>
          </div>
        </nav>
      </header>
      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- Sidebar user panel -->
          <div class="user-panel">
            <div class="pull-left image">
              <img src="<?php echo !$this->session->userdata('userfile')? base_url('assets/img/no-avatar.png') : base_url('assets/upload').'/'.$this->session->userdata('username').'/'.$this->session->userdata('userfile'); ?>" class="img-circle" alt="User Image" />
            </div>
            <div class="pull-left info">
              <p><?php echo $this->session->userdata('name'); ?></p>

              <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
          </div>
		  <!-- Main menu -->
		  <?php $this->load->view('menu') ?>
        </section>
        <!-- /.sidebar -->
      </aside>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
		<?php $this->load->view('header') ?>

        <!-- Main content -->
        <section class="content">
          <!-- Main row -->
		  <?php $this->load->view($content) ?>
          <!-- /.row (main row) -->

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
      <footer class="main-footer">
        <div class="pull-right hidden-xs">
          <b>Version 1.0</b>
        </div>
        <strong>Copyright &copy; 2016 <a href="http://c0jack.id">MyInventory</a>.</strong> All rights reserved.
      </footer>
    </div><!-- ./wrapper -->

    
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
      $.widget.bridge('uibutton', $.ui.button);
    </script>
    <!-- Bootstrap 3.3.2 JS -->
    <script src="<?php echo base_url('assets/'); ?>/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <!-- Sparkline -->
    <script src="<?php echo base_url('assets/'); ?>/plugins/sparkline/jquery.sparkline.min.js" type="text/javascript"></script>
    <!-- jvectormap -->
    <script src="<?php echo base_url('assets/'); ?>/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url('assets/'); ?>/plugins/jvectormap/jquery-jvectormap-world-mill-en.js" type="text/javascript"></script>
    <!-- jQuery Knob Chart -->
    <script src="<?php echo base_url('assets/'); ?>/plugins/knob/jquery.knob.js" type="text/javascript"></script>
    <!-- daterangepicker -->
    <script src="<?php echo base_url('assets/'); ?>/plugins/moment/moment.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url('assets/'); ?>/plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script>
    <!-- datepicker -->
    <script src="<?php echo base_url('assets/'); ?>/plugins/datepicker/bootstrap-datepicker.js" type="text/javascript"></script>
    <!-- Bootstrap WYSIHTML5 -->
    <script src="<?php echo base_url('assets/'); ?>/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js" type="text/javascript"></script>
    <!-- Slimscroll -->
    <script src="<?php echo base_url('assets/'); ?>/plugins/slimScroll/jquery.slimscroll.min.js" type="text/javascript"></script>
    <!-- FastClick -->
    <script src='<?php echo base_url('assets/'); ?>/plugins/fastclick/fastclick.min.js'></script>
	<!-- MaskMoney -->
    <script src='<?php echo base_url('assets/'); ?>/plugins/maskmoney/jquery.maskMoney.min.js'></script>
    <!-- AdminLTE App -->
    <script src="<?php echo base_url('assets/'); ?>/dist/js/app.min.js" type="text/javascript"></script>
  </body>
</html>
<script type="text/javascript">
$(function(){
	$('body').delegate('.delete', 'click', function(event) {
		c = confirm('Are you sure want to delete this data?');
		if(!c){
			return false;
		}
	});
})
</script>