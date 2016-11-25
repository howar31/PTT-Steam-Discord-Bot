<?
require_once(dirname(__FILE__).'/config.php');
require_once(dirname(dirname(__FILE__)).'/phpdiscordwebhooks/DiscordWebhooks.php');

$discord = new DiscordWebhooks();

$input = array(
	'content' => "",
	'username' => "",
	'avatar_url' => ""
);

// var_dump($discord->execute($input));

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<meta property="og:title" content="PTT Steam Discord Bot" />

	<title>PTT Steam Discord Bot</title>

	<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="css/index.css">

	<script src="bootstrap/js/bootstrap.min.js"></script>
	<script src="js/jquery-3.1.1.min.js"></script>
	<script src="js/index.js"></script>

    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
	<div class="container">
		<h1>PTT Steam Discord Bot</h1>
		<br>
		<form role="form" action="index.php" method="POST">
			<div class="form-group">
				<label for="content">Message</label>
				<textarea class="form-control" name="content"></textarea>
			</div>
			<div class="form-group">
				<input id="submit" name="submit" type="submit" value="Send" class="btn btn-primary">
			</div>
		</form>
	</div>
</body>
</html>