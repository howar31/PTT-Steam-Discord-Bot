<?php
require_once(dirname(__FILE__)."/model.php");
require_once(dirname(dirname(__FILE__))."/phpdiscordwebhooks/DiscordWebhooks.php");

	$return = array(
		'success' => false,
		'error' => ''
	);

	$action = trim($_POST['action']);
	if(!isset($action) || empty($action)) {
		$return['error'] = 'action empty';
		goto END;
	}

	$name = trim($_POST['name']);
	if(!isset($name) || empty($name)) {
		$return['error'] = 'name empty';
		goto END;
	}
	$roles = model::getJsonFile('roles');
	$username = $roles[$name][0]['display_name'];
	$avatar_url = $roles[$name][0]['avatar_url'];

	$content = trim($_POST['content']);
	if(!isset($content) || empty($content)) {
		$return['error'] = 'content empty';
		goto END;
	}

	switch ($action) {
		case 'execute':
			$discord = new DiscordWebhooks();
			$input = array(
				'content' => $content,
				'username' => $username,
				'avatar_url' => $avatar_url
			);
			$return['execute'] = $discord->execute($input);
			model::setLogFile($input);
			break;
		default:
			break;
	}

END:
	$return['success'] = empty($return['error']) ? true : false;
	echo json_encode($return);
?>