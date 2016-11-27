<?php
require_once(dirname(__FILE__)."/view.php");
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

switch ($action) {
	case 'execute':
		$name = trim($_POST['name']);
		if(!isset($name) || empty($name)) {
			$return['error'] = 'name empty';
			goto END;
		}

		$roles = model::getJsonFile('roles');
		$username = $roles[$name][0]['display_name'];
		$avatar = $roles[$name][0]['avatar_url'][$_POST['avatar']];
		if (empty($avatar))
		{
			$return['error'] = 'avatar fetch failed.';
			goto END;
		}
		$avatar_url = (((isset($_SERVER['HTTPS']) && 'on' == $_SERVER['HTTPS'])) ? 'https://' : 'http://').$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF']).'/'.$avatar;

		$content = trim($_POST['content']);
		if(!isset($content) || empty($content)) {
			$return['error'] = 'content empty';
			goto END;
		}

		$discord = new DiscordWebhooks();
		$input = array(
			'content' => $content,
			'username' => $username,
			'avatar_url' => $avatar_url
			);

		$return[$action] = $discord->execute($input);
		model::setLogFile($input);
		break;
	case 'getlogfile':
		$filename = trim($_POST['filename']);
		$log = array_reverse(model::getJsonFile('PTT_Steam_Log_'.$filename, 'log'));

		$return[$action] = $log;
		break;
	case 'getavatar':
		$name = trim($_POST['name']);
		if(!isset($name) || empty($name)) {
			$return['error'] = 'name empty';
			goto END;
		}
		$currentIndex = trim($_POST['currentIndex']);
		if(!isset($currentIndex) || 0 > $currentIndex) {
			$randomAvatar = view::getAvatar($name);
		} else {
			$randomAvatar = view::getAvatar($name, $currentIndex);
		}


		$return[$action] = $randomAvatar;
		break;
	default:
		break;
}

END:
$return['success'] = empty($return['error']) ? true : false;
echo json_encode($return);
?>