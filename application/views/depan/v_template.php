
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo $title; ?></title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <meta name="description" content="<?php echo $description; ?>">
	<meta name="keyword" content="<?php echo $keyword; ?>">
	<meta name="author" content="<?php echo $description; ?>">
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url() ?>assets/images/<?php echo $x_icon; ?>">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?php echo base_url()?>assets/vendor/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url()?>assets/vendor/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?php echo base_url()?>assets/vendor/Ionicons/css/ionicons.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="<?php echo base_url()?>assets/vendor/datatables.net-bs/css/dataTables.bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url()?>assets/dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?php echo base_url()?>assets/dist/css/skins/_all-skins.min.css">
	  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="<?php echo base_url()?>assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

		
<!-- jQuery 3 -->
<script src="<?php echo base_url()?>assets/vendor/jquery/dist/jquery.min.js"></script>

    <style>

        #myBtn {
            display: none;
            position: fixed;
            bottom: 20px;
            right: 30px;
            z-index: 99;
            font-size: 18px;
            border: none;
            outline: none;
            background-color: black;
            color: white;
            cursor: pointer;
            padding: 15px;
            border-radius: 4px;
            opacity: 0.5;
            filter: alpha(opacity=50); /* For IE8 and earlier */
        }

        #myBtn:hover {
            background-color: #555;
            opacity: 100;
            filter: 100; /* For IE8 and earlier */
        }

    </style>

</head>
<body class="hold-transition skin-black sidebar-mini sidebar-collapse fixed">
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="#" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>B</b>UAT</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Bahaso</b>UAT</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- Tasks: style can be found in dropdown.less -->
       
			 <?php if(!$this->session->has_userdata('userid')) { ?>
		
			<?php
			 }
			?>
	   <?php if($this->session->has_userdata('userid')) { ?>
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="<?php echo base_url()?>assets/images/<?php echo $x_icon?>" class="user-image" alt="User Image">
              <span class="hidden-xs">Bahaso UAT</span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="<?php echo base_url()?>assets/images/<?php echo $x_icon?>" class="img-circle" alt="User Image">

                <p>
                <?php echo ucwords($name); ?>
                  <small>-</small>
                </p>
              </li>
             
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="<?php echo base_url()?>/akun/profile" class="btn btn-default btn-flat">Profile</a>
                </div>
                <div class="pull-right">
                  <a href="<?php echo base_url()?>/akun/signout" class="btn btn-default btn-flat">Sign out</a>
                </div>
              </li>
            </ul>
          </li>
	   <?php } ?>
         <!-- end for user -->
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
          <img src="<?php echo base_url()?>assets/images/<?php echo $x_icon?>" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
			 <?php if(!$this->session->has_userdata('userid')) { 
				echo "<p> Users </p>";
				}
				else
				{
				echo "<p>". ucwords($name) ."</p>";	
				}
			?>

		

		
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>

          <?php if($this->session->has_userdata('userid')) {
              if($this->session->userdata('userid')==1){
              ?>
          <li class="<?php echo $menu_user_active; ?>">
              <a href="<?php echo base_url()."users";?>">
                  <i class="fa fa-users"></i> <span>Users</span>

              </a>
          </li>
          <?php }
          } ?>

        <li class="treeview <?php echo $menu_projek_active; ?>">
          <a href="#">
            <i class="fa fa-dashboard"></i> <span>UAT Project</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?php echo base_url()."project";?>"><i class="fa fa-circle-o"></i> List Project</a></li>
			<li><a href="<?php echo base_url()."project/result";?>"><i class="fa fa-circle-o"></i>Result Project</a></li>
			
          </ul>
        </li>
		<!--
        <li class="treeview <?php echo $menu_testing_active; ?>">
          <a href="#">
            <i class="fa fa-files-o"></i>
            <span>Hasil Testing</span>
            <span class="pull-right-container">
              <span class="label label-primary pull-right">4</span>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="#"><i class="fa fa-circle-o"></i> List Hasil Testing</a></li>
          </ul>
        </li>
		
		
		 <li class="treeview <?php echo $menu_user_active; ?>">
          <a href="#">
            <i class="fa fa-users"></i> <span>User</span>
            <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="#"><i class="fa fa-circle-o"></i> Data User</a></li>
          </ul>
        </li>
       -->
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <?php 
	  echo $breadcrumb;
	  ?>
    </section>

    <!-- Main content -->
    <section class="content">
      <?php
	  echo $content;
	  ?>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>bahaso.com</b> 
    </div>
    <strong>Copyright &copy; 2018 <a href="https://www.bahaso.com">bahaso.com</a>.</strong> All rights
    reserved.
  </footer>

 
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->


<!-- Bootstrap 3.3.7 -->
<script src="<?php echo base_url()?>assets/vendor/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- DataTables -->
<script src="<?php echo base_url()?>assets/vendor/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url()?>assets/vendor/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="<?php echo base_url()?>assets/vendor/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="<?php echo base_url()?>assets/vendor/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url()?>assets/dist/js/adminlte.min.js"></script>

<!-- notify -->
<script src="<?php echo base_url()?>assets/plugins/notify/notify.js"></script>

<!-- page script -->
<script>
  $(function () {
    $('#example1').DataTable();
	
	$('.table-responsive').on('show.bs.dropdown', function () {
     $('.table-responsive').css( "overflow", "inherit" );
	});

	$('.table-responsive').on('hide.bs.dropdown', function () {
     $('.table-responsive').css( "overflow", "auto" );
	});
	
	 table = $('#table_project').DataTable({ 
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.

        // Load data for the table's content from an Ajax source
        "ajax": {
			<?php 
			if($this->uri->segment(2)=='result')$url=base_url()."project/api_project_result";
			else
				$url=base_url()."project/api_project_coming";
			?>
            "url": "<?php echo $url;?>",
            "type": "POST",
            "data": function ( data ) {
				data.<?php echo $this->security->get_csrf_token_name() ?>	= '<?php echo $this->security->get_csrf_hash(); ?>';
            },
			success : console.log("success"),
			error: console.log("gagal"),
        },

        //Set column definition initialisation properties.
        "columnDefs": [
        { 
            "targets": [ 0 ], //first column / numbering column
            "orderable": false, //set not orderable
        },
        ],

    });
	
	
	

	
	window.setTimeout(function() { $(".alert").fadeTo(1500, 300).slideUp(500)}, 1500);
	/*
	$( ".note" ).focus(function() {
		$(this ).animate({
		width: "110%",
		fontSize: "1.1em",
		}, 1000 );
		
		//$.notify("Hello World","success");
	});
	
	$( ".note" ).blur(function() {
		$(this ).animate({
		width: "100%",
		fontSize: "1em",
		}, 100 );
	});
	*/
 $('[data-toggle="tooltip"]').tooltip();
  })
</script>

<script src="<?php echo base_url() ?>assets/plugins/ckeditor/ckeditor.js"></script>
<script>
  $(function () {
    // Replace the <textarea id="editor1"> with a CKEditor
    // instance, using default configuration.
    CKEDITOR.replace('editor1',{
	height: '100px',
	});
	CKEDITOR.replace('editor2',{
	height: '100px',
	})
	CKEDITOR.replace('editor3',{
	height: '100px',
	})
	CKEDITOR.replace('editor4',{
	height: '100px',
	})
  })
</script>

   <?php if($this->session->has_userdata('userid')) { ?>
<script>
function kirimdata(formObj)
{
	$.ajax({
        url: '<?php echo base_url()."listcase/saveresult";?>',
       /* beforeSend: function(){
            $(responseDIV).html(image_load);
        },*/ 
        data: $('#'+formObj).serialize(), 
        type: "post", 
        dataType: "html",
		success: function(response){		
		//	$(responseDIV).html(response); //tempat klo sukses
			if(response=='berhasil')
			{
			$.notify("Data saved", "success");
			}
			else
			{
			$.notify("Error!", "error");
			}
        },
        error: function(){
			alert("Terjadi kesalahan!");
		},
	});
    return false;
}


function changeStatus(formObj)
{
	$.ajax({
        url: '<?php echo base_url()."project/status";?>',
        data: $('#'+formObj).serialize(), 
        type: "post", 
        dataType: "html",
		success: function(response){		
			if(response=='berhasil')
			{
			$.notify("Data saved", "success");
			}
			else
			{
			$.notify("Error!", "error");
			}
        },
        error: function(){
			alert("Terjadi kesalahan!");
		},
	});
    return false;
}
</script>
   <?php } ?>


<script>
    // When the user scrolls down 20px from the top of the document, show the button
    window.onscroll = function() {scrollFunction()};

    function scrollFunction() {
        if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
            document.getElementById("myBtn").style.display = "block";
        } else {
            document.getElementById("myBtn").style.display = "none";
        }
    }

    // When the user clicks on the button, scroll to the top of the document
    function topFunction() {
        document.body.scrollTop = 0;
        document.documentElement.scrollTop = 0;
    }

    function bottomFunction()
    {
        window.scrollTo(0, document.body.scrollHeight);
    }
</script>

</body>
</html>
