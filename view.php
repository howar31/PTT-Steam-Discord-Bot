<?php
require_once(dirname(__FILE__)."/model.php");

class view
{
	public function getRoles()
	{
		return model::getJsonFile('roles');
	}

	public function getLogFileList()
	{
		$logFileList = array();
		if ($handle = opendir(dirname(__FILE__).'/log/')) {
			while (false !== ($entry = readdir($handle))) {
				if ($entry != "." && $entry != "..") {
					preg_match('/PTT_Steam_Log_(.*).json/', $entry, $matches);
					array_push($logFileList, $matches[1]);
				}
			}
			closedir($handle);
		}
		$logFileList = array_reverse($logFileList);
		return $logFileList;
	}
	/**
	 * Get role avatar url and index
	 * @param  string   $roleName  role name
	 * @param  int|null $avatarNum specify avatar to get, if null then get random avatar
	 * @return array               return avatar url and index
	 */
	public function getAvatar(string $roleName, int $avatarNum = NULL)
	{
		$roles = view::getRoles();
		$avatar = array();
		if (empty($avatarNum))
		{
			$randomAvatar = model::getRandomValue($roles[$roleName][0]['avatar_url']);
			$avatar['index'] = $randomAvatar['key'];
			$avatar['url'] = $randomAvatar['value'];
		} else {
			$avatar['index'] = $avatarNum;
			$avatar['url'] = $roles[$roleName][0]['avatar_url'][$avatarNum];
		}
		return $avatar;
	}
}
?>