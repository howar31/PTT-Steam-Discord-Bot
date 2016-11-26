<?php
require_once(dirname(__FILE__)."/view.php");
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta property="og:title" content="PTT Steam @Discord" />

	<title>PTT Steam @Discord</title>

	<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="bootstrap/css/bootstrap-flex.min.css">
	<link rel="stylesheet" href="bootstrap/css/bootstrap-grid.min.css">
	<link rel="stylesheet" href="bootstrap/css/bootstrap-reboot.min.css">
	<link rel="stylesheet" href="css/index.css">

	<script src="js/jquery-3.1.1.min.js"></script>
	<script src="bootstrap/js/tether.min.js"></script>
	<script src="bootstrap/js/bootstrap.min.js"></script>
	<script src="js/index.js"></script>

	<!--[if lt IE 9]>
	  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
	  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
</head>
<body>
	<div class="container">
		<div class="section">
			<div class="row">
				<div id="siteTitle" class="col-md-12"><h1>PTT Steam @Discord</h1></div>
			</div>
		</div>
		<?php
		if ((isset($_POST['loginPW']) && (USER_PASSWORD === $_POST['loginPW'])) ||
			(isset($_POST['loginPW']) && (ADMIN_PASSWORD === $_POST['loginPW']))
		) {
			$isAdmin = (isset($_POST['loginPW']) && (ADMIN_PASSWORD === $_POST['loginPW']));
			require_once(dirname(__FILE__)."/template/anonymous_message.php");
			if ($isAdmin)
			{
				require_once(dirname(__FILE__)."/template/anonymous_log.php");
			}
		} else {
			$isLogin = isset($_POST['loginPW']);
			require_once(dirname(__FILE__)."/template/login.php");
		}
		?>
	</div>
</body>
</html>