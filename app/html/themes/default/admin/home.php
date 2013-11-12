<?php
$dir = APPLICATION_HTML_DIR . DS . DEFAULT_THEME_DIR . DS . ADMIN_DIR . DS . "includes/head.php";
require_once $dir;
?>
</head>
<?php
$devlive_msg_type = (APPLICATION_ENVIRONMENT=="PRODUCTION") ? ' alert-error' : 'alert-warning';
?>
<body class="container">
	<script type="text/javascript">
		$('#Basic-toggle').click(function() {
			$('#Basic-Rights').toggle();
		});
	</script>
<div class="navbar navbar-fixed-top navbar">
	<div class="navbar-inner">
		<div class="container">
			<a class="brand" href="#">Don't Think Know <strong>ADMIN</strong></a>
			<ul class="nav">
				<li class="active"><a href="home.php"><i class="icon-home icon-white"></i> Home</a></li>
			</ul>
		</div>
	</div>
</div>
<div class="row">
	<div class="span12">
		<div class="alert <?=$devlive_msg_type?>">
			<strong>IMPORTANT!</strong> You are on the <strong><?php echo APPLICATION_ENVIRONMENT; ?></strong> site.
			Please, be thoughtful of other visitors while you work.
		</div>
	</div>
</div>

<div class="row">

<h1><?php echo APPLICATION_ENVIRONMENT; ?> Admin</h1>
<blockquote>
	<h3>Welcome <em><? // echo $_SESSION['login']?></em>!</h3>
	<p>This tool allows you to interact with your site's workflow.   Auth only stuff goes here!</p>
	<small>The Asclepius Team</small>
</blockquote>
<div class="alert alert-success">
	<button class="close" data-dismiss="alert">x</button>
	<strong>Well done!</strong> Welcome to your admin area.
</div>

</div>
<?php
	//require_once "includes/frame_bottom.php";;
?>
</body>
</html>